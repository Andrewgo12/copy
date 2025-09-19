<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
*  Consulta las soluciones
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-sep-2004 9:05:31
* @location Cali-Colombia
*/
function smarty_function_consultsolucion($params, &$smarty){
    extract($_REQUEST);
    settype($sbTmp,"string");

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
    include ($rcUser["lang"]."/".$rcUser["lang"].".consultsolucion.php");
    
    $gateway = Application::getDataGateway('SqlExtended');
    echo "<table border='1' align='center' width='100%'>";
    $rcTipos = $gateway->getTiposFormatKey();
    $rcByType = $gateway->getNumReqBytype();
    echo "<tr><td class='piedefoto'><table border='0' align='center' width='100%'>";
    foreach($rcTipos as $key => $name){
        $cant = $rcByType[$key];
        if(!$cant)
            $cant = "0";
        echo "<tr><td><a href='index.php?action=FeCrCmdDefaultConsultSolucion&tiorcodigos=$key'>$name ($cant)</a></td></tr>";
    }
    echo "</table></td></tr></table>";
    //Si existe el tiorcodigos consulta por las clasificaciones
    if($tiorcodigos){
        $rcEventos = $gateway->getEventosFormatKey($tiorcodigos);
        $rcByEvent = $gateway->getNumReqByEvent($tiorcodigos);
        if(is_array($rcEventos)){
            echo "<table border='1' align='center' width='100%'>";
            echo "<tr><td class='piedefoto'><table border='0' align='center' width='100%'>";
            echo "<tr><td class=piedefoto><div align='left'><b>{$rcTipos[$tiorcodigos]}</b></td><td class='piedefoto'><div><div align='right'><a href='index.php?action=FeCrCmdDefaultConsultSolucion'>{$rclabels['regresar']['label']}</a></td></tr>";
            foreach($rcEventos as $key => $name){
                $cant = $rcByEvent[$tiorcodigos.'|'.$key];
                if(!$cant)
                    $cant = "0";
                echo "<tr><td colspan=2><a href='index.php?action=FeCrCmdDefaultConsultSolucion&tiorcodigos=$tiorcodigos&evencodigos=$key'>$name ($cant)</a></td></tr>";
            }
            echo "</table></td></tr></table>";
        }
    }
    //Si existe el tiorcodigos consulta por las clasificaciones
    if($tiorcodigos && $evencodigos){
        $rcCausas = $gateway->getByFkeyCausasFormatKey($tiorcodigos, $evencodigos);
        $rcByCausa = $gateway->getNumReqByCausa($tiorcodigos, $evencodigos);
        if(is_array($rcCausas)){
            echo "<table border='1' align='center' width='100%'>";
            echo "<tr><td class='piedefoto'><table border='0' align='center' width='100%'>";
            echo "<tr><td class=piedefoto><div align='left'><b>{$rcEventos[$evencodigos]}</b></td><td class='piedefoto'><div><div align='right'><a href='index.php?action=FeCrCmdDefaultConsultSolucion&tiorcodigos=$tiorcodigos'>{$rclabels['regresar']['label']}</a></td></tr>";
            foreach($rcCausas as $key => $name){
                $cant = $rcByCausa[$tiorcodigos.'|'.$evencodigos.'|'.$key];
                if(!$cant)
                    $cant = "0";
                echo "<tr><td colspan=2><a href='index.php?action=FeCrCmdDefaultConsultSolucion&tiorcodigos=$tiorcodigos&evencodigos=$evencodigos&causcodigos=$key'>$name ($cant)</a></td></tr>";
            }
            echo "</table></td></tr></table>";
        }
    }
    $objService = Application::loadServices('General');
    $rcTiposFile = $objService->getConstant('TIPO_FILE');
    $dateService = Application::loadServices('DateController');
    
    //Pinta el listado de las soluciones 
    if($buscar){
    	$objService = Application :: loadServices("Data_type");
    	$sbTmp = $objService->formatString($buscar);
        $rcByReq = $gateway->getSolReqByString($sbTmp,$rcTiposFile['solucion']);
        $item = $rclabels['busqueda']['label']." \"$buscar\"";
    }else if($tiorcodigos && $evencodigos && $causcodigos){
        $rcByReq = $gateway->getSolReqByCausa($tiorcodigos,$evencodigos,$causcodigos,$rcTiposFile['solucion']);
        $item = $rcCausas[$causcodigos];
    }else if($tiorcodigos && $evencodigos){
        $rcByReq = $gateway->getSolReqByEvento($tiorcodigos,$evencodigos,$rcTiposFile['solucion']);
        $item = $rcEventos[$evencodigos];
    }else if($tiorcodigos){
        $rcByReq = $gateway->getSolReqBytype($tiorcodigos,$rcTiposFile['solucion']);
        $item = $rcTipos[$tiorcodigos];
    }
    
    if(is_array($rcByReq)){
        echo "<table border='1' align='center' width='100%'>";
        echo "<tr><td class='piedefoto'><table border='0' align='center' width='100%'>";
        echo "<tr><td class=piedefoto><div align='left'><b>{$rclabels['title']} : $item</b></div></td></tr>";
        foreach($rcByReq as $key => $rcSolucion){
            if($buscar)
                $rcSolucion['oremsolucios'] = str_replace($buscar,"<b><u>$buscar</u></b>",$rcSolucion['oremsolucios']);
            echo "<tr><td colspan=2 ><fieldset >";
            echo "<b>".$rclabels['ordenumeros']['label']."</b> : ".$rcSolucion['ordenumeros']."<br>";
            echo "<b>".$rclabels['oremsolucios']['label']."</b> : ".$rcSolucion['oremsolucios']."<br>";
            //Si existe el archivo
            if($rcSolucion['archcodigon']){
                echo "<b>".$rclabels['archnombres']['label']."</b> : <a href='#' onclick=\"fncopenwindows('FeCrCmdDefaultDownloadFile','archcodigon={$rcSolucion['archcodigon']}');\" title='{$rclabels['descargar']['label']}'>".$rcSolucion['archnombres']."</a> | ".
                "<b>".$rclabels['archfechan']['label']."</b> : ".$dateService->fncformatofechahora($rcSolucion['archfechan']);
            }
            echo "</fieldset></td></tr>";
        }
        echo "</table></td></tr></table>";
    }
    
}

