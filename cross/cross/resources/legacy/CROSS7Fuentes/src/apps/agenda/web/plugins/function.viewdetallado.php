<?php
/**Copyright 2004 � FullEngine
Libreria de Centro de Consulta al cliente
final@author cazapata <cazapata@parquesoft.com>finalfinal
@date 03-sep-2004 11:08:26
@location Cali - Colombia 1104555600  1123736399
*/
function smarty_function_viewdetallado($params, &$smarty){

    extract($_REQUEST);
    $rcUser = Application::getUserParam();
    if(!is_array($rcUser)){
        $rcUser['lang'] = Application::getSingleLang();
    }    
    include ($rcUser["lang"]."/".$rcUser["lang"].".detallado.php");
    $periodo = "$ordefecingdini - $ordefecingdfin";
    //Hace la conversion de fechas
    $dateService = Application :: loadServices("DateController");
    $ordefecingdini = $dateService->fncdatetoint($ordefecingdini);
    $ordefecingdfin = $dateService->fncdatetoint($ordefecingdfin) + 86399;
    
    $detalleClass = new detallado($reporte,$ordefecingdini,$ordefecingdfin,$rclabels,$periodo,$tipoorden);
    $report = $detalleClass->makeReport();
    //Valida si existen datos para el reporte
    if(!$report){
        include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        echo "<script language='javascript'>alert('{$rcmessages[22]}')\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
    }
    return $report;
}

class detallado {

	function detallado($reporte,$date1,$date2,$rcLabels,$periodo,$tipo){
        $this->reporte = $reporte;
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->rcLabels = $rcLabels;
        $this->periodo = $periodo;
        $this->tipo = $tipo;
        $this->gateway = Application::getDataGateway('SqlExtended');
	}
    
    /**
    * Copyright 2005 FullEngine
    *
    * Arma el reporte detallado dependiendo del tipo de reporte
    * @author creyes
    * @return string cadena con el reporte
    * @date 9-August-2005 13:57:54
    * @location Cali-Colombia
    */
    function makeReport(){
        switch($this->reporte){
            case 'tipos': return $this->makeByAllTipo();
            case 'estado_time': return $this->makeByEnd();
            case 'tipo':return $this->makeByTipo();
        }
    }
    /**
    * Copyright 2005 FullEngine
    * 
    * Hace el reporte por todos los tipos
    * @author creyes
    * @return string cadena con el reporte
    * @date 9-August-2005 14:3:26
    * @location Cali-Colombia
    */
    function makeByAllTipo(){
        //Consulta los tipos de requerimiento
        $rcTipos = $this->gateway->getAllTipoorden();
        //Consulta los req totales x dependencia  x tipo
        $rcTotalDepByTipo = $this->gateway->getReqByDepByTipo($this->date1,$this->date2);
        if(!is_array($rcTotalDepByTipo))
            return null;
        //pinta el titulo del reporte
        $rcHtml[] = '<table align="center" width="100%">';
        $titulo = str_replace("[1]",$this->periodo,$this->rcLabels['titulo']['label']);
        $titulo = str_replace("[2]",$this->rcLabels['tipos']['label'],$titulo);
        $rcHtml[] = "<tr><th rowspan='2'>$titulo</th><tr>";
        $rcHtml[] = '</table><br>';
        
        $rcHtml[] = '<table align="center" width="100%">';
        $rcHtml[] = "<tr><th rowspan='2'>".$this->rcLabels['dependencias']['label']."</th>";
        //Pinta las cabeceras
        foreach($rcTipos as $tipo){
            $rcHtml[] = "<td colspan='3' class=\"titulofila\">$tipo</td>";
        }
        $rcHtml[] = "<td colspan='2' class=\"titulofila\">{$this->rcLabels['totales']['label']}</td>";
        $rcHtml[] = "</tr>";

        $rcHtml[] = "<tr>";
        foreach($rcTipos as $tipo){
            $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['cantidad']['label']}</td>";
            $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['porctipodep']['label']}</td>";
            $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['porctipodepcorp']['label']}</td>";
        }
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['cantidad']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['porcdep']['label']}</td>";
        $rcHtml[] = "</tr>";


        //Pinta los datos del reporte
        $todas = $rcTotalDepByTipo['todas'];
        $rcTotByTipo = $rcTotalDepByTipo['totalxdep'];
        unset($rcTotalDepByTipo['todas']);
        unset($rcTotalDepByTipo['totalxdep']);
        foreach($rcTotalDepByTipo as $dependencia => $rcTmp){
            //Pinta el nombre de la dependencia
            $rcHtml[] = '<tr><td class="titulofila">'.$rcTmp['organombres'].'</td>';
            foreach($rcTipos as $tipo => $name){
                $valorDep = $rcTmp[$tipo];
                if(is_array($valorDep)){
                    $rcHtml[] = "<td>{$valorDep['cantidad']}</td>".
                                "<td>{$valorDep['tipxdep']}</td>".
                                "<td>{$valorDep['topxcorpxdep']}</td>";
                }else{
                    $rcHtml[] = "<td>0</td>".
                                "<td>0</td>".
                                "<td>0</td>";
                }
            }
            //Pinta los totales y porcentaje por dependencia
            $rcHtml[] = "<td><b>{$rcTmp['total']}</b></td>".
                        "<td>{$rcTmp['depxcorp']}</td><tr>";
        }
        unset($rcTmp);
        //Pinta los totales por tipo
        $rcHtml[] = "<tr><th>".$this->rcLabels['totalebytipo']['label']."</th>";
        foreach($rcTipos as $tipo => $name){
            $valorTipo = $rcTotByTipo[$tipo];
            if(is_array($valorTipo)){
                $rcHtml[] = "<td class=\"titulofila\"><b>{$valorTipo['valor']}</b></td>";
                $rcHtml[] = "<td colspan='2' class=\"titulofila\">{$valorTipo["procentaje"]}</td>";
            }else{
                $rcHtml[] = "<td class=\"titulofila\">0</td>";
                $rcHtml[] = "<td colspan='2' class=\"titulofila\">0</td>";
            }
        }
        $rcHtml[] = "<td class=\"titulofila\"><b>$todas</b></td>";
        $rcHtml[] = "<td class=\"titulofila\">100</td>";
        $rcHtml[] = "</tr>";
        $rcHtml[] = "</table><br>";

        //Pinta las convenciones
        $rcHtml[] = '<table align="left" width="100%">';
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['porctipodep']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['porctipodep']['commentary']}</td>".
                    "</tr>";
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['porctipodepcorp']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['porctipodepcorp']['commentary']}</td>".
                    "</tr>";
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['porcdep']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['porcdep']['commentary']}</td>".
                    "</tr>";
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['totalebytipo']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['totalebytipo']['commentary']}</td>".
                    "</tr>";
        $rcHtml[] = '</table>';
        return implode("\n",$rcHtml);
    }
    /**
    * Copyright 2005 FullEngine
    * 
    * Consulta y elabora el reporte detallado por tipo 
    * @author creyes
    * @return array cadena con el reporte
    * @date 10-August-2005 16:16:2
    * @location Cali-Colombia
    */
    function makeByTipo(){
        $tipoordenGateway = Application::getDataGateway('Tipoorden');
        $rcTiornombres = $tipoordenGateway->getTiornombres($this->tipo);
        $rcEventos = $this->gateway->getEventoByTipoorden($this->tipo);
        $rcReqByEven = $this->gateway->getReqByEvento($this->tipo,$this->date1,$this->date2);
        if(!is_array($rcReqByEven))
            return null;
        $rcReqByCausa = $this->gateway->getReqByCausa($this->tipo,$this->date1,$this->date2);
        $rcTotalCausa = $rcReqByCausa['totales'];
        $rcReqByCausa = $rcReqByCausa['causas'];

        //pinta el titulo del reporte
        $rcHtml[] = '<table align="center" width="100%">';
        $titulo = str_replace("[1]",$this->periodo,$this->rcLabels['titulo']['label']);
        $titulo = str_replace("[2]",$rcTiornombres[0]['tiornombres'],$titulo);
        $rcHtml[] = "<tr><th rowspan='2'>$titulo<br></th><tr>";
        $rcHtml[] = '</table><br>';

        $rcHtml[] = '<table align="center" width="100%">';
        $rcHtml[] = "<tr><th rowspan='2'>".$this->rcLabels['dependencias']['label']."</th>";
        //Pinta los eventos
        foreach($rcEventos as $tipo){
            $size = (sizeof($tipo['causas']) * 2) + 2;
            $colspan = "colspan='$size'";
            $rcHtml[] = "<td $colspan class=\"titulofila\">{$tipo['nombre']} </td>";
        }
        $rcHtml[] = "<td colspan='2' class=\"titulofila\">{$this->rcLabels['totales']['label']}</td>";
        $rcHtml[] = "</tr>";
        //Las causas
        $rcHtml[] = "<tr>";
        foreach($rcEventos as $tipo){
            if(is_array($tipo['causas'])){
                foreach($tipo['causas'] as $causnombres)
                    $rcHtml[] = "<td colspan='2' class=\"titulofila\">$causnombres</td>";
            }
            $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['cantidad']['label']}</td>";
            $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['PDC']['label']}</td>";
        }
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['cantidad']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['porcdep']['label']}</td>";
        $rcHtml[] = "</tr>";
        
        //Pinta los datos del reporte
        foreach($rcReqByEven['consulta'] as $orgacodigos => $rcDatos){
            $rcHtml[] = "<td class=\"titulofila\">{$rcDatos['organombres']}</td>";
            foreach($rcEventos as $evencodigos => $tipo){
                if(is_array($tipo['causas'])){
                    foreach($tipo['causas'] as $causcodigos => $causnombres){
                        $rcCausas = $rcReqByCausa[$orgacodigos][$evencodigos][$causcodigos];
                        if(is_array($rcCausas))
                            $rcHtml[] = "<td colspan='2'>{$rcCausas['cantidad']}</td>";
                        else
                            $rcHtml[] = "<td colspan='2'>0</td>";
                    }
                }
                if(is_array($rcDatos[$evencodigos])){
                    $rcHtml[] = "<td><b>{$rcDatos[$evencodigos]['cantidad']}</b></td>";
                    $rcHtml[] = "<td>{$rcDatos[$evencodigos]['porcentaje']}</td>";
                }else{
                    $rcHtml[] = "<td><b>0</b></td>";
                    $rcHtml[] = "<td>0</td>";
                }
            }
            $rcHtml[] = "<td><b>{$rcDatos['totalxdep']}</b></td>";
            $rcHtml[] = "<td>{$rcDatos['porcxdep']}</td>";
            $rcHtml[] = "</tr>";
        }
       
        //Pinta los totales del pie
        $rcTotalEvento = $rcReqByEven['totalxeven'];
        $rcHtml[] = "<tr><th rowspan='2'>".$this->rcLabels['PC']['label']."</th>";
        foreach($rcEventos as $evencodigos => $tipo){
            if(is_array($tipo['causas'])){
                foreach($tipo['causas'] as $causcodigos => $causnombres)
                    if($rcTotalCausa[$causcodigos]){
                        $rcHtml[] = "<td class=\"titulofila\"><b>{$rcTotalCausa[$causcodigos]}</b></td>";
                        $porcentaje = ($rcTotalCausa[$causcodigos] * 100) / $rcReqByEven['todas'];
                        $rcHtml[] = "<td class=\"titulofila\">".number_format($porcentaje,2,',','.')."</td>";
                    }else{
                        $rcHtml[] = "<td class=\"titulofila\"><b>0</b></td>";
                        $rcHtml[] = "<td class=\"titulofila\">0</td>";
                    }
            }
            if(is_array($rcTotalEvento[$evencodigos])){
                $rcHtml[] = "<td class=\"titulofila\"><b>{$rcTotalEvento[$evencodigos]['valor']}</b></td>";
                $rcHtml[] = "<td class=\"titulofila\">{$rcTotalEvento[$evencodigos]['porcentaje']}</td>";
            }else{
                $rcHtml[] = "<td class=\"titulofila\"><b>0</b></td>";
                $rcHtml[] = "<td class=\"titulofila\">0</td>";
            }
        }
        $rcHtml[] = "<td class=\"titulofila\"><b>{$rcReqByEven['todas']}</b></td>";
        $rcHtml[] = "<td class=\"titulofila\">100 %</td>";
        $rcHtml[] = "</tr>";

        //$rcTotalCausa
        
        $rcHtml[] = '</table><br>';
        //Pinta las convenciones
        $rcHtml[] = '<table align="left" width="100%">';
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['PDC']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['PDC']['commentary']}</td>".
                    "</tr>";
        $rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['PD']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['PD']['commentary']}</td>".
                    "</tr>";
        /*$rcHtml[] = "<tr>".
                        "<td class=\"titulofila\">{$this->rcLabels['PC']['label']}</td>".
                        "<td class='piedefoto'>{$this->rcLabels['PC']['commentary']}</td>".
                    "</tr>";*/
        $rcHtml[] = '</table>';
        return implode("\n",$rcHtml);
    }
    /**
    * Copyright 2005 FullEngine
    *
    * VIsualiza el reporte de requerimientos por estado
    * @return string
    * @date 12-August-2005 14:20:17
    * @location Cali-Colombia
    */
    function makeByEnd(){
        $rcReporte = $this->gateway->getReqByEnd($this->date1,$this->date2);

        if(!is_array($rcReporte))
            return null;
        //pinta el titulo del reporte
        $rcHtml[] = '<table align="center" width="100%">';
        $titulo = str_replace("[1]",$this->periodo,$this->rcLabels['titulo']['label']);
        $titulo = str_replace("[2]",$this->rcLabels['estado_time']['label'],$titulo);
        $rcHtml[] = "<tr><th rowspan='2'>$titulo</th><tr>";
        $rcHtml[] = '</table><br>';
        $rcHtml[] = '<table align="center" width="100%">';
        $rcHtml[] = "<tr><td class=\"titulofila\" rowspan='2'>".$this->rcLabels['dependencias']['label']."</th>";
        $rcHtml[] = "<td colspan='2' class=\"titulofila\">".$this->rcLabels['finalizadas']['label']."</td>";
        $rcHtml[] = "<td colspan='2' class=\"titulofila\">".$this->rcLabels['pendientes']['label']."</td>";
        $rcHtml[] = "<td rowspan='2' class=\"titulofila\">{$this->rcLabels['totales']['label']}</td>";
        $rcHtml[] = "</tr>";
        $rcHtml[] = "<tr>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['in']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['out']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['in']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['out']['label']}</td>";
        $rcHtml[] = "</tr>";

        foreach($rcReporte['data'] as $rcTmp){
            $rcHtml[] = "<tr>";
            $rcHtml[] = "<td class=\"titulofila\">{$rcTmp['organombres']}</td>";
            $rcHtml[] = "<td>".$this->valNumber($rcTmp['fin_in'])."</td>";
            $rcHtml[] = "<td>".$this->valNumber($rcTmp['fin_out'])."</td>";
            $rcHtml[] = "<td>".$this->valNumber($rcTmp['pend_in'])."</td>";
            $rcHtml[] = "<td>".$this->valNumber($rcTmp['pend_out'])."</td>";
            $rcHtml[] = "<td>".$this->valNumber($rcTmp['total'])."</td>";
            $rcHtml[] = "</tr>";
        }
        
        //Pinta los totales
        $rcHtml[] = "<tr>";
        $rcHtml[] = "<td class=\"titulofila\">{$this->rcLabels['PC']['label']}</td>";
        $rcHtml[] = "<td class=\"titulofila\">".$this->valNumber($rcReporte['fin_in'])."</td>";
        $rcHtml[] = "<td class=\"titulofila\">".$this->valNumber($rcReporte['fin_out'])."</td>";
        $rcHtml[] = "<td class=\"titulofila\">".$this->valNumber($rcReporte['pend_in'])."</td>";
        $rcHtml[] = "<td class=\"titulofila\">".$this->valNumber($rcReporte['pend_out'])."</td>";
        $rcHtml[] = "<td class=\"titulofila\">".$this->valNumber($rcReporte['total'])."</td>";
        $rcHtml[] = "</tr>";

        $rcHtml[] = "</table><br>";
        return implode("\n",$rcHtml);
    }
    function valNumber($val){
        if(!$val)
            return "0";
        return $val;
    }
}
?>