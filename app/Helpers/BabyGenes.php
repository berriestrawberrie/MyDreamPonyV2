<?php

namespace App\Helpers;

class BabyGenes
{
    /**
     * Create a new class instance.
     */

    public static function getGenes($shown_D, $carry_D, $all_S, $shown_S, $carry_S)
    {
        //IF BOTH PARENTS HAVE SHOWN HAIR GENE
        if(!empty($shown_D) && !empty($shown_S) ){
            //PARENTS HAVE NO CARRY GENES
            if(empty($carry_D) && empty($carry_S)){
                //BABY GETS DOMINANT GENE
                $shown_Baby = min(array_filter(array_merge($shown_S,$shown_D)));
                if($shown_D === $shown_S){
                    $baby_carry = null;
                }else{
                    //50% CHANCE TO CARRY OTHER GENE
                    if(rand(0,1)===1){
                    $baby_carry = max(array_filter(array_merge($shown_S,$shown_D)));
                }
                }
            }else{
                $DNA = array_merge($shown_D,$carry_D);
                $SNA = array_merge($shown_S,$carry_S);
                //PICK A RANDOM GENE TO COMBINE 
                $alleD = $DNA[array_rand($DNA)];
                $alleS = $SNA[array_rand($SNA)];
                $shown_Baby = min($alleD, $alleS);
                //REDUCE THE POOL FOR POSSIBLE CARRY
                $DNA_pool = array_filter(array_merge($SNA,$DNA), function($gene) use($shown_Baby){
                    return $gene != $shown_Baby;
                });
                if(rand(0,1)===1){
                    $getCarryGene = $DNA_pool[array_rand($DNA_pool)];
                    $baby_carry = intval($getCarryGene)? $getCarryGene : $getCarryGene  + .5 ; 
                }
                $baby_carry = null;
            }
            return [$shown_Baby, $baby_carry];

        }//END OF BOTH SHOWN

        //IF ONLY 1 PARENTS HAVE SHOWN HAIR GENE
        if(!empty($shown_D)||!empty($shown_S)){
            //PARENTS HAVE NO CARRY GENES
            if(empty($carry_D) && empty($carry_S)){
                $shown_Baby = null;
                //50% CHANCE TO PASS SHOWN GENE
                if(rand(0,1)===1){
                    $baby_carry = $all_S[0] + .5;
                }else{
                    //50% CHANCE NOT PASS SHOWN GENE
                    $baby_carry = null;
                }
            }else{
                //PARENTS HAVE CARRY GENES
                $DNA = array_merge($shown_D,$carry_D);
                $SNA = array_merge($shown_S,$carry_S);
                
                //IF A PARENT HAS NO GENES(CARRIED/SHOWN) THEN ONLY CARRY POSSIBLE
                if(empty($DNA)||empty($SNA)){
                    $shown_Baby = null;
                    $DNA_pool = array_filter(array_merge($DNA, $SNA));
                    $getCarryGene = $DNA_pool[array_rand($DNA_pool)];
                    $baby_carry = is_int($getCarryGene)? $getCarryGene + .5: $getCarryGene;
                }else{
                //BOTH PARENTS HAVE CARRIED/SHOW GENES
                //PICK A RANDOM GENE TO COMBINE 
                $alleD = $DNA[array_rand($DNA)];
                $alleS = $SNA[array_rand($SNA)];
                $shown_Baby = min($alleD, $alleS);
                //REDUCE THE POOL FOR POSSIBLE CARRY
                $DNA_pool = array_filter(array_merge($SNA,$DNA), function($gene) use($shown_Baby){
                    return $gene != $shown_Baby;
                });
                if(rand(0,1)===1){
                    $getCarryGene = $DNA_pool[array_rand($DNA_pool)];
                    $baby_carry = is_int($getCarryGene)? $getCarryGene : $getCarryGene  + .5 ; 
                }
                $baby_carry = null;
                }
            }
            return [$shown_Baby, $baby_carry];
        }

        //IF PARENTS HAVE NO SHOWN GENES AND ONLY CARRY
        if(empty($shown_D) && empty($shown_S)){
            $chance = rand(1,4);
            //25% NO CARRY NO SHOW
            if($chance === 1){
                $shown_Baby = null;
                $baby_carry = null;
            }elseif($chance === 2 || $chance === 3){
                //50% CARRY NO GENE
                $DNA = $carry_D;
                $SNA = $carry_S;
                //IF ONE PARENT DOES NOT HAVE CARRIED GENES NO SHOWN POSSIBLE   
                if(empty($DNA)||empty($SNA)){
                    $shown_Baby = null;
                    $baby_carry = null;
                    if(rand(0,1)===1){
                        //50% CHANCE CARRIER
                        $baby_carry = array_filter(array_merge($DNA,$SNA));
                    }
                }else{
                    $shown_Baby = null;
                    //BOTH PARENTS HAVE GENES WHICH GENE CARRIED RANDOM
                    $DNA_pool = array_filter(array_merge($DNA, $SNA));
                    $baby_carry = $DNA_pool[array_rand($DNA_pool)];
                }
            }else{
                //25% SHOW GENE BOTH PARENTS CARRY
                $DNA_pool = array_filter(array_merge($carry_D, $carry_S));
                $shown_Baby = is_int($DNA_pool[array_rand($DNA_pool)])? $DNA_pool[array_rand($DNA_pool)] : $DNA_pool[array_rand($DNA_pool)] - .5;
                $baby_carry = null;
                //BABY WILL STILL CARRY OTHER PARENT GENE TOO
                if(rand(0,1)===1){
                    //FILTER OUT THE SHOWN GENE IF DIFFERING GENES
                    if($DNA_pool[0] != $DNA_pool[1]){
                        $baby_carry = array_filter($DNA_pool, function($gene) use($shown_Baby){
                        return $gene != $shown_Baby;
                        })[0];}

                }

            }
            return [$shown_Baby, $baby_carry];
        }//END OF CARRY ONLY NO SHOW

        
       /* dd("DAM HAIR GENES? :", $shown_D,"SIRE HAIR GENES? :", $shown_S,
        "DAM CARRY GENES: ", $carry_D, "SIRE CARRY GENES: ", $carry_S,
        "BABY SHOWN: ", $shown_Baby,"BABY CARRY: ", $baby_carry); */


    }//END OF PUBLIC FUNCTION
}
