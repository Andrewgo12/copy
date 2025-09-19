<?php

class Statistic{

    function Statistic(){
        $this->method = 1;
        return true;
    }
    
    function  setLimitInferior($limitInferior){
        $this->limitInferior = (integer)$limitInferior;
    }
    function  setLimitSuperior($limitSuperior){
        $this->limitSuperior = (integer)$limitSuperior;
    }
    function setAmountData($amountData){
        $this->amountData = (integer) $amountData;
    }
    function setMethod($method){
        $this->method = (integer)$method; 
    }
    
    function getClasses(){
        return $this->classes;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Determina las clases entre un limite inferior y un 
    * limite superior
    * @author creyes <careyes@parquesoft.com>
    * @param integer  $this->setLimitInferior($limitInferior)
    * @param integer  $this->setLimitSuperior($limitSuperior)
    * @return array $this->getClases()
    * @date 25-July-2006 12:21:16
    * @location Cali-Colombia
    */
    function makeClasses(){
        
        if($this->limitSuperior < $this->limitInferior)
            return false;
        if(!$this->limitSuperior || !$this->limitInferior || !$this->amountData)
            return false;
        if($this->amountData < 2)
            return false;
        
        
        //Calcula el rango
        $this->range = (integer) $this->limitSuperior - $this->limitInferior;
        
        //Calcula en nro de clases
        switch($this->method){
            case 1:
                $this->amountClasses = log( $this->amountData,2);
            break;
            case 2:
                $this->amountClasses = 1 + (3.332 * log10( $this->amountData));
            break;
            default:
                $this->amountClasses = log( $this->amountData,2);
        }
        $this->amountClasses = round($this->amountClasses);
        
        //Calcula el ancho de las clases
        $this->wideClass = $this->range / $this->amountClasses;
        $this->wideClass = round($this->wideClass);
        
        if($this->wideClass == 0){
            $this->limitSuperior++;
            $this->classes[] = array($this->limitInferior,$this->limitSuperior);
            return true;
        }
        //Construye las clases
        $start = $this->limitInferior;
        for($i=0;$i<$this->amountClasses;$i++){
            $end = $start + $this->wideClass;
            $this->classes[$i] = array($start,$end);
            $start = $end + 1;
        }
        return true;
    }
}
?>