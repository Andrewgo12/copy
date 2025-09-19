<?php
class progressBar{
    function progressBar(){
        //define los valores por defecto
        $this->activeColor = "26ad1f"; //Color de llenado
        $this->inActiveColor = "ffffff"; //Color de fondo de la barra
        $this->borderColor = "c8c8ce"; //Color del borde
        $this->borderWidth = 1; //Ancho del borde
        $this->cellWidth = 5; //ancho de cada celda
        $this->cellHeight = 20; //alto de las celdas
        $this->cellSpacing = 0;//Espacio entre las celdas
        $this->value = 100; //Valor del procentaje
        $this->tdClass = ""; //Si existe alguna clase de estilo que se aplicara a las tablas
        $this->noUp100 = false; //Si se pasa del 100% colocara +100%, 
                                //Si es menor a 100% colocara -100%
                                //por defecto coloca el valor tal cual
        return true;
    }
    function setValue($value = null){
        if(!is_numeric($value))
            return false;  
        if(!$value) 
            $this->value = 100;
        $this->value = $value;
        return true; 
    } 
    //genera la barra 
    function toHtml(){
        $percent = (integer) ($this->value * 20) / 100;
        $id = md5(rand()); 
        $advance = 0;
        $width = ($this->cellWidth  * 20) + ($this->cellSpacing * 19); 
        $cellSpacing = $this->cellSpacing + $this->cellWidth;
        
        $rchtml[] ="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
        $rchtml[] ="    <tr>";
        $rchtml[] ="        <td class='".$this->tdClass."'>";
        $rchtml[] ="            <div style=\"border-width: ".$this->borderWidth."px;border-style: solid;border-color: #".$this->borderColor.";background-color: #".$this->inActiveColor.";width: ".$width."px;height: ".$this->cellHeight."px;position: relative;left: 0px;top: 0px;\">";
        for($cont = 0; $cont < 20; $cont ++){ 
            if($cont < $percent)
                $background = $this->activeColor;
            else
                $background = $this->inActiveColor;
            $rchtml[] ="\t\t\t<div id='".$id."CELL".$cont."' style=\"width:".$this->cellWidth."px;height: ".$this->cellHeight."px;font-family: Courier, Verdana;font-size: ".$this->cellWidth."px;float: left;background-color: #$background;position:absolute;top:0px;left:".$advance."px;\">&nbsp;</div>";                
            $advance += $cellSpacing;
        }
        $rchtml[] ="            </div>";
        $rchtml[] ="        </td>";
        $rchtml[] ="        <td class='".$this->tdClass."'>&nbsp;</td>";
        $prnValue = $this->value;
        if($this->noUp100){
            if($this->value > 100)
                $prnValue = "+100";
        }
        $rchtml[] ="        <td class='".$this->tdClass."'>&nbsp;&nbsp;$prnValue%</td>";      
        $rchtml[] ="    </tr>";       
        $rchtml[] ="</table>";
        return implode("\n",$rchtml); 
    } 
}
?>