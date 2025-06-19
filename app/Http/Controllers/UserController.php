<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pony;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'birthday' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {
        $credientials = $request->only('name', 'password');
        if (Auth::attempt($credientials)) {
            $user = Auth::user();

            return view('home', compact('user'));
        }
        return redirect('/')->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function myIsland($userID)
    {
        $user = User::where('id', $userID)->get();

        return view('user.userisland', compact('user'));
    }

    public function myStable($userID, $order)
    {
        $user = User::where('id', $userID)->get();
        $ponys = Pony::where('ownerid', $userID)
            ->where('stable_assign', 1)
            ->orderBy('stable_ord')->get();
        return view('user.stable' . $order, compact('user', 'ponys'));
    }

    public function myNursery($userID)
    {
        $user = User::where('id', $userID)->get();
        $ponys = Pony::where('ownerid', $userID)
            ->where('stable_assign', 0)
            ->orderBy('stable_ord')->get();
        return view('user.nursery', compact('user', 'ponys'));
    }

    public function updateStables(Request $request)
    {

        for ($i = 0; $i < count($request["order"]); $i++) {

            $ponyid = $request["order"][$i][0];
            $stable = $request["order"][$i][1];
            Pony::where('ponyid', $ponyid)
                ->update(['stable_ord' => $stable]);
        }
        return "stable order";
    }

    public function inventoryOverlay($userID)
    {
        $inventory = User::where('id', $userID)->get();
        $itemlist = explode(',', $inventory[0]["itemid"]);
        $qtylist = explode(',', $inventory[0]["qty"]);
        $user = $userID;
        $ponys = Pony::where('ownerid', $userID)
            ->where('isAlive', 1)
            ->get();

        $group = Item::wherein('itemid', $itemlist)->get();
        $tags = [];

        for ($i = 0; $i < count($group); $i++) {
            array_push($tags, explode(',', $group[$i]["tags"]));
        }

        return view('user.inventoryoverlay', compact('user', 'group', 'qtylist', 'tags', 'ponys'));
    }
}
