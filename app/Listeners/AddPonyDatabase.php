<?php

namespace App\Listeners;

use App\Events\NewPony;
use App\Models\BuildPony;
use App\Models\Pony;
use Illuminate\Support\Facades\Auth;

class AddPonyDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewPony $event): void
    {
        switch ($event->newPony[0]["source"]) {
            //IF THE PONY IS GENERATED FROM THE PONY GEN
            case "generator":
                //PULL BUILD PONY STATS
                $stats = BuildPony::where('id', $event->newPony[0]["breedID"])
                    ->get([
                        'charm',
                        'intel',
                        'str',
                        'hp',
                        'affinity'
                    ]);

                //CHECK IF PONY HAS CARRIED GENES
                if (count($event->newPony[0]["genes"]) > 0) {
                    $genes = $event->newPony[0]["genes"];
                } else {
                    $genes = 0;
                }
                $stringGene = implode(",", $event->newPony[0]["genes"]);

                //CHECK IF PONY HAS SPECIAL TRAIT
                if ($event->newPony[0]["babytrait"]) {
                    $babytrait = $event->newPony[0]["babytrait"];
                } else {
                    $babytrait = null;
                }


                /*CREATE THE NEW PONY     */
                Pony::create([
                    'sex' => $event->newPony[0]["sex"],
                    'name' => "Unnamed",
                    'token' => $event->newPony[0]["token"],
                    'age' => 0,
                    'stable_assign' => 0,
                    'created_at' => date("Y/m/d"),
                    'ownerid' => Auth::user()->id,
                    'typeid' => $event->newPony[0]["breedID"],
                    'charm' => $stats[0]["charm"],
                    'intel'  => $stats[0]["intel"],
                    'str'  => $stats[0]["str"],
                    'hp'  => $stats[0]["hp"],
                    'level' => 0,
                    'hunger' => 100,
                    'health'  => 100,
                    'exp' => 0,
                    'genes' => $stringGene,
                    'eyeCol' => $event->newPony[0]["eyes"],
                    'accentCol' => $event->newPony[0]["accent"],
                    'hairCol' => $event->newPony[0]["hair"],
                    'hairCol2' => $event->newPony[0]["hair2"],
                    'baseCol' => $event->newPony[0]["coat"],
                    'accentCol2' => $event->newPony[0]["accent2"],
                    'eyeCol-rgb' => $event->newPony[0]["eyesRGB"],
                    'accentCol-rgb' => $event->newPony[0]["accentRGB"],
                    'hairCol-rgb' => $event->newPony[0]["hairRGB"],
                    'hairCol2-rgb' => $event->newPony[0]["hair2RGB"],
                    'baseCol-rgb' => $event->newPony[0]["coatRGB"],
                    'accentCol2-rgb' => $event->newPony[0]["accent2RGB"],
                    'specialtrait' => $babytrait
                ]);
                break;
                case "birth":

                /*CREATE THE NEW PONY     */
                Pony::create([
                    'sex' => $event->newPony[0]["sex"],
                    'name' => "Birthed",
                    'token' => $event->newPony[0]["token"],
                    'age' => 0,
                    'stable_assign' => 0,
                    'created_at' => date("Y/m/d"),
                    'ownerid' => Auth::user()->id,
                    'typeid' => $event->newPony[0]["breedID"],
                    'charm' => $event->newPony[0]["charm"],
                    'intel'  => $event->newPony[0]["intel"],
                    'str'  => $event->newPony[0]["str"],
                    'hp'  => $event->newPony[0]["hp"],
                    'level' => $event->newPony[0]["level"],
                    'hunger' => 100,
                    'health'  => 100,
                    'exp' => 0,
                    'genes' => $event->newPony[0]["genes"],
                    'eyeCol' => $event->newPony[0]["eyes"],
                    'accentCol' => $event->newPony[0]["accent"],
                    'hairCol' => $event->newPony[0]["hair"],
                    'hairCol2' => $event->newPony[0]["hair2"],
                    'baseCol' => $event->newPony[0]["coat"],
                    'accentCol2' => $event->newPony[0]["accent2"],
                    'eyeCol-rgb' => $event->newPony[0]["eyesRGB"],
                    'accentCol-rgb' => $event->newPony[0]["accentRGB"],
                    'hairCol-rgb' => $event->newPony[0]["hairRGB"],
                    'hairCol2-rgb' => $event->newPony[0]["hair2RGB"],
                    'baseCol-rgb' => $event->newPony[0]["coatRGB"],
                    'accentCol2-rgb' => $event->newPony[0]["accent2RGB"],
                    'specialtrait' => $event->newPony[0]["specialtrait"]
                ]);
        }
    }
}
