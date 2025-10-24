<?php

namespace App\Listeners;

use App\Events\CalculateGenetic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SpecialTrait;
use App\Helpers\BabyGenes;
use App\Models\Pony;
use App\Events\NewBabyPony;

class CalculateGenes
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

        $damTraits = explode(",",$event->ponys[0]["specialtrait"]);
        $sireTraits = explode(",",$event->ponys[1]["specialtrait"]);
        
        //CONVERT ALL TRAITS TO NUMERIC
        $damNumeric = SpecialTrait::wherein("traitname", $damTraits)
                    ->get([
                        'traitid'
                    ])->toArray();
        $sireNumeric = SpecialTrait::wherein("traitname", $sireTraits)
            ->get([
                'traitid'
            ])->toArray();
        //PULL THE CURRENT CARRIED GENES AND CONVERT to NUMERIC
            $damGenes = array_map('floatval',array_filter(explode(",",$event->ponys[0]["genes"])));
            if(is_null($damGenes)){
                $damGenes = [];
            }
            for($i = 0 ; $i < count($damNumeric); $i++){
                $damGenes[] = $damNumeric[$i]["traitid"];
            }
            //PULL THE CURRENT CARRIED GENES AND CONVERT to NUMERIC
            $sireGenes = array_map('floatval',array_filter(explode(",",$event->ponys[1]["genes"])));
            if(is_null($sireGenes)){
                $sireGenes = [];
            }
            for($i = 0 ; $i < count($sireNumeric); $i++){
                $sireGenes[] = $sireNumeric[$i]["traitid"];
            }
            
        //SORT THE HAIR GENES
            $damH = array_filter($damGenes, function($gene) {
                        return in_array($gene,[1, 1.5 , 6, 6.5 , 7 , 7.5]);
            });
            $sireH = array_filter($sireGenes, function($gene) {
                        return in_array($gene,[1, 1.5 , 6, 6.5 , 7 , 7.5]);
            });
            //SORT THE BODY GENES
            $damB = array_filter($damGenes, function($gene) {
                        return in_array($gene,[4,4.5,9,9.5,10,10.5]);
            });
            $sireB = array_filter($sireGenes, function($gene) {
                        return in_array($gene,[4,4.5,9,9.5,10,10.5]);
            });
            //SORT THE FACE GENES
            $damF = array_filter($damGenes, function($gene) {
                        return in_array($gene,[2,2.5,5,5.5,8,8.5]);
            });
            $sireF = array_filter($sireGenes, function($gene) {
                        return in_array($gene,[2,2.5,5,5.5,8,8.5]);
            });       
            //SORT THE FACE GENES
            $damF = array_filter($damGenes, function($gene) {
                        return in_array($gene,[2,2.5,5,5.5,8,8.5]);
            });
            $sireF = array_filter($sireGenes, function($gene) {
                        return in_array($gene,[2,2.5,5,5.5,8,8.5]);
            }); 
            //SORT THE LEG GENES
            $damL = array_filter($damGenes, function($gene) {
                        return in_array($gene,[11,11.5]);
            });
            $sireL = array_filter($sireGenes, function($gene) {
                        return in_array($gene,[11,11.5]);
            }); 
              

        $final_shown = [];
        $final_carry = [];
        
//CALCULATE THE HAIR
        if(!empty($damH)|| !empty($sireH)){
            $shown_HD = array_filter($damH, function($gene){return is_int($gene);}); 
            $shown_HS = array_filter($sireH, function($gene){return is_int($gene);});
            $all_HS = array_merge($shown_HD, $shown_HS);
            $carry_HD = array_filter($damH, function($gene){return !is_int($gene);}); 
            $carry_HS = array_filter($sireH, function($gene){return !is_int($gene);});

            $hairGenes = BabyGenes::getGenes($shown_HD,$carry_HD,$all_HS,$shown_HS,$carry_HS);
            $final_shown[] = $hairGenes[0];
            $final_carry[] =$hairGenes[1];
            
        }
//CALCULATE THE FACE
        if(!empty($sireF)||!empty($damF)){
            $shown_FD = array_filter($damF, function($gene){return is_int($gene);}); 
            $shown_FS = array_filter($sireF, function($gene){return is_int($gene);});
            $all_FS = array_merge($shown_FD, $shown_FS);
            $carry_FD = array_filter($damF, function($gene){return !is_int($gene);}); 
            $carry_FS = array_filter($sireF, function($gene){return !is_int($gene);});

            $faceGenes = BabyGenes::getGenes($shown_FD,$carry_FD,$all_FS,$shown_FS,$carry_FS);
            $final_shown[] = $faceGenes[0];
            $final_carry[] = $faceGenes[1];
        }

//CALCULATE THE BODY
        if(!empty($sireB)||!empty($damB)){
            $shown_BD = array_filter($damB, function($gene){return is_int($gene);}); 
            $shown_BS = array_filter($sireB, function($gene){return is_int($gene);});
            $all_BS = array_merge($shown_BD, $shown_BS);
            $carry_BD = array_filter($damB, function($gene){return !is_int($gene);}); 
            $carry_BS = array_filter($sireB, function($gene){return !is_int($gene);});

            $bodyGenes = BabyGenes::getGenes($shown_BD,$carry_BD,$all_BS,$shown_BS,$carry_BS);
            $final_shown[] = $bodyGenes[0];
            $final_carry[] = $bodyGenes[1];
        }

//CALCULATE THE LEGS
        if(!empty($sireL)||!empty($damL)){
            $shown_LD = array_filter($damL, function($gene){return is_int($gene);}); 
            $shown_LS = array_filter($sireL, function($gene){return is_int($gene);});
            $all_LS = array_merge($shown_LD, $shown_LS);
            $carry_LD = array_filter($damL, function($gene){return !is_int($gene);}); 
            $carry_LS = array_filter($sireL, function($gene){return !is_int($gene);});

            $legGenes = BabyGenes::getGenes($shown_LD,$carry_LD,$all_LS,$shown_LS,$carry_LS);
            $final_shown[] = $legGenes[0];
            $final_carry[] = $legGenes[1];
        }

        //IF NO SHOWN GENES THEN SET NULL
            if(empty($final_shown)){
                $final_shownName = null;
            }else{
                //OTHERWISE MAP THE RETURNED TRAIT NAMES
            $final_shownName1 = SpecialTrait::wherein("traitid", $final_shown)
                    ->get([
                        'traitname'
                    ])->toArray();
                    $final_shownName2 = [];
                for($i = 0; $i< count($final_shownName1); $i++){
                    $final_shownName2[] = $final_shownName1[$i]["traitname"];
                }
            }
            $final_shownName2 = implode(",", $final_shownName2);
            $final_carry = implode(",", array_filter($final_carry));

            Pony::where("token", $event->token)
                ->update([
                    'specialtrait' => $final_shownName2,
                    'genes' => $final_carry
                ]);
                
            event(new NewBabyPony($event->newPony));

    }
}
