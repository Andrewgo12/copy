<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Smarty plug-in
* Visualiza los datos de un cliente
* @param string $clieidentifs 
* @return array
* @author creyes <cesar.reyes@parquesoft.com>
* @date 05-may-2005 14:24:41
* @location Cali-Colombia
*/

function smarty_function_viewfichacliente($params, &$smarty){
	extract($_REQUEST);
    if($flag != 1)
        return null;
    
    //carga los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}

	if(!$cliente__clieidentifs){
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        return "<script language='javascript'>alert('{$rcmessages[6]}')</script>";
    }
    
	//Obtiene la compuerta
	$gateway = Application :: getDataGateway("CentroConsulta");
	$rcFichaCliente = $gateway->getCliente($cliente__clieidentifs);
    if(!is_array($rcFichaCliente)){
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        return "<script language='javascript'>alert('{$rcmessages[12]}')</script>";
    }

    //Consulta los contratos del cliente
    $rcContratos = $gateway->getContratoByCliente($cliente__clieidentifs);
    //Ajusta la forma de la matriz de la 
    $rcFichaCliente = $rcFichaCliente[0];
    $rcFichaCliente["clieidentifs"] = "{$rcFichaCliente["tiidcodigos"]} {$rcFichaCliente["clieidentifs"]}";
    $rcFichaCliente["clielocalizs"] .= " {$rcFichaCliente["locanombres"]}";
    if($rcFichaCliente["cliemails"]){
        $rcFichaCliente["cliemails"] = "<a href='mailto:{$rcFichaCliente["cliemails"]}'>{$rcFichaCliente["cliemails"]}</a>";
    }
    unset($rcFichaCliente["tiidcodigos"]);
    unset($rcFichaCliente["locanombres"]);
    //carga el lenguaje
	include ($rcuser["lang"]."/".$rcuser["lang"].".centroconsulta.php");
    //Carga el servicio de HTML para elaborar las fichas y los listados
	$htmlService = Application :: loadServices("Html");
    //Ajusta el numero de columnas
    $rcParams["cols"] = 2;
    $rcHtml[] = "<table align='center' width='100%'>";
    $rcHtml[] = "<tr><th align=\"left\">".$rclabels["titclientes"]["label"]."</th></tr>";
    $rcHtml[] = "<tr><td class='piedefoto'>";
    $rcHtml[] = $htmlService->genCard($rcFichaCliente, $rclabels, $rcParams);
    $rcHtml[] = "</td></tr>";
    $rcHtml[] = getHtmlList($rcContratos,$rclabels,$rcFichaCliente["clienombres"]);
    $rcHtml[] = "</table>";
    return implode("\n",$rcHtml);
}

/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Genera la el html de la lista de los contratos
* @param string $rcContratos
* @return array
* @author creyes <cesar.reyes@parquesoft.com>
* @date 05-may-2005 14:24:41
* @location Cali-Colombia
*/
function getHtmlList($rcContratos,$rclabels,$clienombres){
    if(!is_array($rcContratos))
        return null;
    
    $serviceDate = Application :: loadServices("DateController");
    $serviceData = Application :: loadServices("Data_type");
    
    $rcHtml[] = "<tr><th align=\"left\">".$rclabels["listcontratos"]["label"]."</th></tr>";
    $rcHtml[] = "<tr><td class='piedefoto'>";
    $rcHtml[] = "<table cellSpacing='1' cellPadding='3' align='center' border='0' width='100%'>";
    //Genera las cabeceras
    $rcHtml[] = "<tr>";
    foreach($rcContratos[0] as $key => $value){
        if($key != "timolocales")
            $rcHtml[] = "<td class='titulofila'>{$rclabels[$key]["label"]}</td>";
    }
    $rcHtml[] = "<td class='titulofila'>{$rclabels["actions"]["label"]}</td>";
    
    $rcHtml[] = "</tr>";
    //Genera los datos del listado
    $cont = 0;
    foreach($rcContratos as $fila => $rcColumnas){
        //Calcula el interlineado
        if(fmod($fila,2)  ==  0)
            $estilo = "celda";
        else
            $estilo = "celda2";
        $locale = $rcColumnas["timolocales"];
        unset($rcColumnas["timolocales"]);
        $rcHtml[] = "<tr>";
        foreach($rcColumnas as $key => $value){
            //Hace la conversión de la fecha
            if($key == "contfchfirmn")
                $value = $serviceDate->fncformatofechahora($value);
            if($key == "contmonton")
                $value = $serviceData->moneyFormat($value,$locale);
            $rcHtml[] = "<td class='$estilo'>$value</td>";
        }
        $rcHtml[] = "<td class='$estilo'><a href='#' onClick=\"javascript:regCases('cross300', 'FeCrCmdDefaultOrden', '{$rcColumnas['contnics']}', null,'$clienombres');\" title='{$rclabels["alt"]["label"]}'><img src='web/images/actualizar.gif' border='0' align='absmiddle'></a></td>";
        $rcHtml[] = "</tr>";
    }
    $rcHtml[] = "</table>";
    $rcHtml[] = "</td></tr>";
    return implode("\n",$rcHtml);
}
?>