<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Smarty plug-in
* Visualiza los datos de un contrato
* @return array
* @author creyes <cesar.reyes@parquesoft.com>
* @date 11-may-2005 16:24:41
* @location Cali-Colombia
*/
function smarty_function_viewfichacontrato($params, &$smarty){
	extract($_REQUEST);
    if($flag != 2)
        return null;

    //carga los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}

	if(!$contrato__contnics){
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        return "<script language='javascript'>alert('{$rcmessages[14]}')</script>";
    }
    
	//Obtiene la compuerta
	$gateway = Application :: getDataGateway("CentroConsulta");
	$rcFichaContrato = $gateway->getContratoByNic($contrato__contnics);
    if(!is_array($rcFichaContrato)){
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        return "<script language='javascript'>alert('{$rcmessages[13]}')</script>";
    }
    
    //Ajusta la forma de la matriz
    $serviceDate = Application :: loadServices("DateController");
    $serviceData = Application :: loadServices("Data_type");
    $rcFichaContrato = $rcFichaContrato[0];
    $locale = $rcFichaContrato["timolocales"];
    $clienombres = $rcFichaContrato["clienombres"];
    $rcFichaContrato["contmonton"] = $serviceData->moneyFormat($rcFichaContrato["contmonton"],$locale)." ".$rcFichaContrato["timonombres"];
    $rcFichaContrato["clienombres"] = $rcFichaContrato["clieidentifs"]." ".$rcFichaContrato["clienombres"];
    $rcFichaContrato["contfchfirmn"] = $serviceDate->fncformatofechahora($rcFichaContrato["contfchfirmn"]);
    unset($rcFichaContrato["timonombres"]);
    unset($rcFichaContrato["clieidentifs"]);
    unset($rcFichaContrato["timolocales"]);
    
    //Busca los productos del contrato
    $rcProductos = $gateway->getProdByContnic($contrato__contnics);
    //carga el lenguaje
	include ($rcuser["lang"]."/".$rcuser["lang"].".centroconsulta.php");
	$htmlService = Application :: loadServices("Html");
    //Ajusta el numero de columnas
    $rcParams["cols"] = 2;
    $rcHtml[] = "<table align='center' width='100%'>";
    $rcHtml[] = "<tr><th align=\"left\">".$rclabels["titcontrato"]["label"]."</th></tr>";
    $rcHtml[] = "<tr><td class='piedefoto'>";
    $rcHtml[] = $htmlService->genCard($rcFichaContrato, $rclabels, $rcParams);
    $rcHtml[] = "</td></tr>";
    $rcHtml[] = getHtmlListProd($rcProductos,$rclabels, $locale, $rcFichaContrato["contnics"],$clienombres);
    $rcHtml[] = "</table>";
    return implode("\n",$rcHtml);
}
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Genera la el html de la lista de los productos
* @param string $rcContratos
* @return array
* @author creyes <cesar.reyes@parquesoft.com>
* @date 05-may-2005 14:24:41
* @location Cali-Colombia
*/
function getHtmlListProd($rcProductos,$rclabels, $locale, $contnics, $clienombres){
    if(!is_array($rcProductos))
        return null;
    
    $serviceDate = Application :: loadServices("DateController");
    $serviceData = Application :: loadServices("Data_type");
    
    $rcHtml[] = "<tr><th align=\"left\">".$rclabels["productos"]["label"]."</th></tr>";
    $rcHtml[] = "<tr><td class='piedefoto'>";
    $rcHtml[] = "<table cellSpacing='1' cellPadding='3' align='center' border='0' width='100%'>";
    //Genera las cabeceras
    $rcHtml[] = "<tr>";
    foreach($rcProductos[0] as $key => $value){
        $rcHtml[] = "<td class='titulofila'>{$rclabels[$key]["label"]}</td>";
    }
    $rcHtml[] = "<td class='titulofila'>{$rclabels["actions"]["label"]}</td>";
    
    $rcHtml[] = "</tr>";
    //Genera los datos del listado
    $cont = 0;
    foreach($rcProductos as $fila => $rcColumnas){
        //Calcula el interlineado
        if(fmod($fila,2)  ==  0)
            $estilo = "celda";
        else
            $estilo = "celda2";
        $rcHtml[] = "<tr>";
        foreach($rcColumnas as $key => $value){
            //Pinta el enlace para la hoja de vida del producto
            if($key == "prodcodigos")
                $value = "<a href='#' onClick=\"javascript:fncopenwindows('FeCuCmdDefaultFichas','topFrame=FeCuCmdDefaultHeadFicha&mainFrame=FeCuCmdDefaultFichaProducto&prodcodigos=$value&contnics=$contnics&vars=prodcodigos,contnics')\">$value</a>";
            //Hace la multiplicación de la cantidad x valor unitario
            if($key == "coprvalunidn"){
                $value = (int) $value * $rcColumnas["coprcantidan"];
                $value = $serviceData->moneyFormat($value,$locale);
            }
            $rcHtml[] = "<td class='$estilo'>$value</td>";
        }
        $rcHtml[] = "<td class='$estilo'><a href='#' onClick=\"javascript:regCases('cross300', 'FeCrCmdDefaultOrden', '$contnics', '{$rcColumnas['prodcodigos']}','$clienombres');\" title='{$rclabels["alt"]["label"]}'><img src='web/images/actualizar.gif' border='0' align='absmiddle'></a></td>";
        $rcHtml[] = "</tr>";
    }
    $rcHtml[] = "</table>";
    $rcHtml[] = "</td></tr>";
    return implode("\n",$rcHtml);
}
?>