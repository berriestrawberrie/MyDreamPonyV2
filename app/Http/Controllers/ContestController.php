<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    //
    public function contests()
    {
        return view('contest.contesthome');
    }

    public function createContest()
    {
        return view('contest.createcontest');
    }

    public function scheduleContest(Request $request)
    {
        if ($request->input('adultsplits')) {
            $adults = implode(",", $request->input('adultsplits'));
        } else {
            $adults = implode(",", $request->input('adultunlimit'));
        }

        $baby = implode(",", $request->input('baby'));
        $contests = $adults . $baby;

        Contest::create([
            'userid' => Auth::user()->id,
            'runtime' => $request->input('time'),
            'contest_type' => $contests
        ]);

        return view('contest.contesthome')->with('success', 'New contest scheduled!');
    }
}
