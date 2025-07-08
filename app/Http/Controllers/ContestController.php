<?php

namespace App\Http\Controllers;

use App\Events\ContestSignUp;
use App\Models\Contest;
use App\Models\Pony;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    //
    public function contests()
    {
        $contest = Contest::where('userid', Auth::user()->id)->get();
        $allcontest = Contest::all();

        return view('contest.contesthome', compact('contest', 'allcontest'));
    }

    //ADD CONTEST TO DATABASE.
    public function scheduleContest(Request $request)
    {

        $token = uniqid();
        if ($request->input('adultsplits')) {
            $adults = implode(",", array_filter($request->input('adultsplits')));
        } else if ($request->input('adultunlimit')) {
            $adults = implode(",", array_filter($request->input('adultunlimit')));
        } else {
            $adults = null;
        }

        //HANDLE THE PHOTO
        if ($request->has('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $path = 'uploads/temp';
            $filename = $token . '.' . $extension;
            $file->move($path, $filename);
        } else {
            $filename = null;
        }

        if ($request->has('baby')) {
            $baby = implode(",", array_filter($request->input('baby')));
        } else {
            $baby = null;
        }

        if ($adults && $baby) {
            $contests = $adults . "," . $baby;
        } else if (!$adults && $baby) {
            $contests = $baby;
        } else {
            $contests = $adults;
        }

        Contest::create([
            'userid' => Auth::user()->id,
            'runtime' => $request->input('time'),
            'contest_type' => $contests,
            'token' => $token,
            'title' => $request->input('title'),
            'contest_attribute' => $request->input('contest_attribute'),
            'fee' => $request->input('fee'),
            'banner' => $filename

        ]);
        //SUBTRACT THE CONTEST COST FROM THE USER 
        $newgold = Auth::user()->ponygold - Auth::user()->arena_cost;

        User::where('id', Auth::user()->id)
            ->update([
                'ponygold' =>
                $newgold,
            ]);

        return redirect(route('join.contest', ['token' => $token]))->with('success', 'Your contest is scheduled');
    }

    //POPULATE SINGLE VIEW CONTEST PAGE00
    public function joinContest($token)
    {
        $contest = Contest::where('token', $token)->get();
        $contestArray = explode(",", $contest[0]["contest_type"]);


        $adults = [];
        $babys = [];

        for ($i = 0; $i < count($contestArray); $i++) {
            if (str_contains($contestArray[$i], "baby")) {
                //PUSH TO BABY CONTESTS
                array_push($babys, $contestArray[$i]);
            } else {
                //PUSH TO ADULT CONTESTS
                array_push($adults, $contestArray[$i]);
            }
        }

        //GET THE PONY GROUPING
        $adult1 = Pony::where('contest', $token)
            ->where('age', '>=', 14)
            ->where('contest_group', 1)
            ->get();
        $adult2 = Pony::where('contest', $token)
            ->where('age', '>=', 14)
            ->where('contest_group', 2)
            ->get();
        $adult3 = Pony::where('contest', $token)
            ->where('age', '>=', 14)
            ->where('contest_group', 3)
            ->get();
        $adult4 = Pony::where('contest', $token)
            ->where('age', '>=', 14)
            ->where('contest_group', 4)
            ->get();
        //GET THE PONY GROUPING FOR BABIES
        $baby1 = Pony::where('contest', $token)
            ->where('age', '<', 14)
            ->where('contest_group', 1)
            ->get();
        $baby2 = Pony::where('contest', $token)
            ->where('age', '<', 14)
            ->where('contest_group', 2)
            ->get();
        $baby3 = Pony::where('contest', $token)
            ->where('age', '<', 14)
            ->where('contest_group', 3)
            ->get();
        $baby4 = Pony::where('contest', $token)
            ->where('age', '<', 14)
            ->where('contest_group', 4)
            ->get();

        $adultponys = Pony::where('ownerid', Auth::user()->id)
            ->where('isAlive', 1)
            ->where('stable_assign', '>', 0)
            ->where('age', '>=', 14)
            ->where('nxt_contest', 0)
            ->get();
        $babyponys = Pony::where('ownerid', Auth::user()->id)
            ->where('isAlive', 1)
            ->where('stable_assign', '>', 0)
            ->where('age', '<', 14)
            ->where('nxt_contest', 0)
            ->get();



        return view('contest.contestjoin', compact(
            'contest',
            'token',
            'adults',
            'babys',
            'adultponys',
            'babyponys',
            'adult1',
            'adult2',
            'adult3',
            'adult4',
            'baby1',
            'baby2',
            'baby3',
            'baby4',
        ));
    }

    //ENROLL PONIES IN CONTESTS
    public function signUp($token, Request $request)
    {

        if ($request->has('adults')) {
            //GET THE SIGNUPS FOR ADULT UNLIMITED
            $adultlist = array_unique($request->adults);
        } else {
            $adultlist = null;
        }
        if ($request->has('babys')) {
            //GET THE SIGNUPS FOR BABIES
            $babylist = array_unique($request->babys);
        } else {
            $babylist = null;
        }

        //AN ARRAY OF THE PONIES TO SIGN UP, LISTENER WILL ASSIGN PONIES
        event(new ContestSignUp($adultlist, $babylist, $token));


        $contest = Contest::where('userid', Auth::user()->id)->get();


        return redirect(route('contest.home', ['contest' => $contest]))->with('success', 'Your ponies have entered the contest');
    } //END OF UNLIMITED SIGN UPS

    //DELETE MY SCHEDULED CONTEST
    public function cancelContest($token, Request $request)
    {
        Contest::where('token', $token)
            ->delete();

        $contest = Contest::where('userid', Auth::user()->id)->get();
        return redirect(route('contest.home', ['contest' => $contest]))->with('success', 'You contest has been canceled');
    }
}
