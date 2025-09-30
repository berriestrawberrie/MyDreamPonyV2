<?php

namespace App\Listeners;

use App\Events\CalculateGenetic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Pony;

class CalculateLineage
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
    public function handle(CalculateGenetic $event): void
    {

        //ORDER THE DAM AND SIRE
        if($event->ponys[0]["sex"] === "female"){
            $dam = $event->ponys[0];
            $sire = $event->ponys[1];
        }else{
            $dam = $event->ponys[1];
            $sire = $event->ponys[0];
        }

        //CALCULATE THE LINEAGE
        $damLine = explode(",",$dam["lineage"]);
        $sireLine = explode(",",$sire["lineage"]);
        //dd("DamLINE: " ,$damLine, "SIRELINE: ", $sireLine);
        if(count($damLine)<6){
            $missing = 6 - count($damLine);
            $zeros = array_fill(0, $missing, 0);
            $newDam = array_merge($damLine,$zeros);
            $newDamList = implode(",",$newDam);
        }else{
            $newDam = array_slice($damLine, 0, 6);
            $newDamList = implode(",",$newDam);
        }
        if(count($sireLine)<6){
            $missing = 6 - count($sireLine);
            $zeros = array_fill(0, $missing, 0);
            $newSire = array_merge($sireLine,$zeros);
            $newSireList = implode(",",$newSire);
        }else{
            $newSire = array_slice($sireLine, 0,6);
            $newSireList = implode(",",$newSire);
        }
                //dd($newDamList , $newSireList);

        $lineage = $dam["ponyid"]. ",". $sire["ponyid"]. ",".$newDamList . ",". $newSireList;

        //ADD PONY LINEAGE
        Pony::where('token', $event->token)
            ->update([
                'lineage' => $lineage,
            ]);
    }//END OF LISTENER
}
