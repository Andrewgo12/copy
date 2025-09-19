<?php
/**
	Copyright 2004 � FullEngine
	
	Pinta un select con los usuarios de la aplicaci�n
	@author creyes <cesar.reyes@parquesoft.com>
	@date 25-ago-2004 16:42:18
	@location Cali-Colombia
*/

function smarty_function_select_user($params, &$smarty){
	extract($params);
	
	//Descarga de la sesion los datos del usuario
	$rcUser = Application::getUserParam();

	//Carga el servicio del profiles
	$obj = Application::loadServices("Profiles");
	
	//Trae el listado de los usuarios de una palicacion en un esquema
	$rcTmpUsers = $obj->getActiveUser($rcUser["app_code"],$rcUser["schema"]);
    foreach($rcTmpUsers as $key => $rcTmp){
        $rcUsers[$key] = $rcTmp['authusernams'];
    }
    //Consulta los usuarios asignados
    $gateway = Application::getDataGateway('SqlExtended');
    $rcTmpUserInPersonal = $gateway->getuserNameInPersonal();
    if(is_array($rcTmpUserInPersonal)){
        foreach($rcTmpUserInPersonal as $key => $rcTmp){
            $rcUserInPersonal[$key] = $rcTmp['persusrnams'];
        }
        $diferencia = array_diff($rcUsers,$rcUserInPersonal);
    }else
        $diferencia = $rcUsers;
    
	if (!isset ($label)) {
		$label = $value;
	}
	if (!isset ($size)) {
		$size = 1;
	}
	//Trae los datos del usuario web para no pintarlo
    $generalService = Application::loadServices('General');
    $rcWebUser = $generalService->getParam('cross300', 'web_user_conf');

	$html_result .= "<select name='$name' size='$size' id='$id'>";
	if ($is_null == "true") {
		$html_result .= "<option value=''>---</option>";
	}
    
    if($_REQUEST[$name])
        array_unshift($diferencia, $_REQUEST[$name]);
        
    foreach($diferencia as $unsername){
        if($unsername != $rcWebUser["user"]){
            $html_result .= "<option value='";
            $html_result .= $unsername;
            if ($_REQUEST[$name] == $unsername) {
                $html_result .= "' selected>";
            } else {
                $html_result .= "'>";
            }
            $html_result .= $unsername;
            $html_result .= "</option>";
        }
    }
	
	$html_result .= "</select>";
	print $html_result;
}
?>