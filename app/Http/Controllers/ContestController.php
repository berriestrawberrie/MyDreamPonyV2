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



}
