<?php
/**
* Copyright 2005 FullEngine
*
* Smarty plugin busca y pinta la información de la compañia
* @author creyes
* @return string
* @date 17-August-2005 15:29:0
* @location Cali-Colombia
*/
function smarty_function_logo_emp($params,&$smarty){
	
	settype($objService,"object");
	settype($rcData,"array");
	settype($sbLogo,"string");
    
    $objService = Application::loadServices('General');
    $rcData = $objService->getParam('general','empresa');
    if(is_array($rcData) && $rcData["emprlogos"]){
    	$sbLogo = '<td  width="83"><img src="web/images/'.$rcData['emprlogos'].'" width="83" height="70" alt=""></td>';
    }else{
    	$sbLogo = '<td  width="83"><img src="web/images/inicio.barrasuperior_02.png" width="83" height="70" alt=""></td>';
    }
	return $sbLogo;
}
?> 
