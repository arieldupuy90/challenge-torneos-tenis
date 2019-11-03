<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of players
 *
 * @author caroa
 */
class Player implements Model{
    private $range="C2:S";
    public function postProcess($values) {
        $filterValues=array();
        foreach ($values as $val){
            if(isset($val[16]) and isset($val[13]))
                $filterValues[]=array("id"=>$val[16],"nombre"=>$val[13],"torneo"=>$val[0]);
        }
        return $filterValues;
    }
    function getRange() {
        return $this->range;
    }
    
    
}
