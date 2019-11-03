<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountWinners
 *
 * @author caroa
 */
class LastWin extends Winners{
    private $id;
    public function __construct($id) {
        $this->id=$id;
    }
    
    public function postProcess($values) {
        //$values=parent::postProcess($values);
        $fechas=[];
        
        foreach ($values as $value){
            if(isset($value[16]) and $this->id == $value[16])
                $fechas[]=$value[4];
             
        }
        
        return array(end($fechas));
        
    }
    
}
