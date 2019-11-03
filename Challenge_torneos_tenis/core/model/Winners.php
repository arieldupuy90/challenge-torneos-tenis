<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Winners
 *
 * @author caroa
 */
class Winners extends Player{
    //put your code here
    
    public function postProcess($values) {
        $winners=array();
        $best=array();
        
        foreach ($values as $value){
            if(isset($value[0]) and isset($value[16])){
                !isset ($winners[$value[0]][$value[16]]) ? $winners[$value[0]][$value[16]] = 1 : $winners[$value[0]][$value[16]]+=1;
            }
                    
            
        }
        
        foreach ($winners as $tournament=>$winner){
            arsort($winner, SORT_NUMERIC | SORT_DESC);
            $win=array_keys($winner);
            
            $best[]=array("torneo"=>$tournament,"ganador"=>reset($win));
        }
        
        
        return $best;
    }

}
