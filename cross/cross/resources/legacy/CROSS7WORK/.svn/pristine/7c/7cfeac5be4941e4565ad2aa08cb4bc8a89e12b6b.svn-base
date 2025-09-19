<?php  
/**Copyright 2004 FullEngine
	
	 Consulta y pinta las tareas asignadas a un ente organizacional
	@author creyes <cesar.reyes@parquesoft.com>
	@date 01-sep-2004 11:08:26
	@location Cali - Colombia
*/

function smarty_function_viewtareas($params, & $smarty) {
	extract($_REQUEST);
	extract($params);

	settype($objService, "object");
	settype($rcUser, "array");
	settype($rcTareas, "array");
	settype($rcPersDatos, "array");
	settype($rclistaEntes, "array");
	settype($rcEntes, "array");
	settype($rcValue, "array");
	settype($rcActa, "array");
	settype($rcTmp, "array");
	settype($rcNodos, "array");
    settype($rcOcultarCampos, "array");
	settype($sbAppId, "string");
	settype($sbImgDir, "string");
	settype($sbFlag, "string");
	settype($sbIsOwner, "string");
	settype($sbKey, "string");
	settype($sbAcceso, "string");
	settype($sbValue, "string");
	settype($sbEstilo, "string");
	settype($nuCols, "integer");
	settype($nuIndex, "integer");
    settype($nuCantCO, "integer");

	$sbAcceso = false;
	$sbIsOwner = false;
    $rcOcultarCampos = array("tarecodigos", "actaestacts", "actafechinin", "actafechvenn");
    if (is_array($rcOcultarCampos) && !empty($rcOcultarCampos)) {
        $nuCantCO = sizeof($rcOcultarCampos);
    } else {
        $nuCantCO = 0;
    }

	if (!$orgacodigos) {
		return null;
	}

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	//Obtiene el Id de la aplicacion
	$sbAppId = Application :: getAppId();
	
	/**
	 * Se inicia el ordenamiento por fecha de registro 19-10-2018
	 */
	if (!isset($order_by) || empty($order_by)) {
	    $order_by = 'orden.ordefecregd';
	}
	
	if (!isset($sentido) || empty($sentido)) {
	    $sentido = 'desc';
	}

	$objService = Application :: loadServices("Workflow");
	$rcTareas = $objService->getAsignWork($orgacodigos,$order_by,$sentido);

	if (!is_array($rcTareas))
		return null;

	$table = strtolower($table);
	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".admintareas.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	//Trae el directorio de imagenes
	$sbImgDir = Application :: getImagesDirectory();
	$nuCols = (sizeof($rcTareas[0]) + 1) - $nuCantCO;

	//se valida si el usuario puede ver todos los entes
	$objService = Application :: loadServices("General");
	$rcTmp = $objService->getParam("human_resources", "acceso_total");

	//Consulta los entes organizacionales
	$objService = Application :: loadServices("Human_resources");
	$rcPersDatos = $objService->getPersDatos($rcUser["username"], true);
	$rcNodos = $objService->getActiveBeingEmployee($rcPersDatos["perscodigos"]);

	//se valida si el usuario puede ver todos los entes
	if ($rcTmp) {
		foreach ($rcNodos as $rcValue) {
			if (in_array($rcValue["orgacodigos"], $rcTmp)) {
				$sbAcceso = true;
			}
		}
	}

	if (!$sbAcceso) 
	{
		//se determina si se pueden modificar  las actas de los hijos o no
		$sbFlag = Application :: getConstant("MOD_ACT");
        $objService = Application :: loadServices("Human_resources");
		if ($sbFlag) 
		{
			//Consulta los entes organizacionales
			$rcEntes = $objService->getActiveBeingSonEmployee($rcPersDatos["perscodigos"]);
			if (is_array($rcEntes) && $rcEntes) {
				foreach ($rcEntes as $sbKey => $rcValue) {
					$rclistaEntes[$nuIndex] = $sbKey;
					$nuIndex ++;
				}
			}
		} else {
			$rcEntes = $objService->getActiveBeingEmployee($rcPersDatos["perscodigos"]);
			if (is_array($rcEntes) && $rcEntes) {
				foreach ($rcEntes as $nuIndex => $rcValue) {
					$rclistaEntes[$nuIndex] = $rcValue["orgacodigos"];
				}
			}
		}

		//Determina si las tareas pertenecen al ente que consulta
		if ($rclistaEntes) {
			if (in_array($orgacodigos, $rclistaEntes))
				$sbIsOwner = true;
		}
	}else{
		$sbIsOwner = true;
	}
	//Pinta la tabla
	$rcHtml[] =  "<table width=\"100%\" cellSpacing='1' cellPadding='3' align='center' border='0'>";
	$rcHtml[] =  "<tr><th colspan='$nuCols'><div align='left'>".sizeof($rcTareas)." ".$rclabels["tareas"]["label"]."</div></th></tr>";
	$rcHtml[] =  "<tr>";
	
	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".acta.php");
	
	//Pinta las cabeceras
	foreach ($rcTareas[0] as $sbKey => $sbValue){
        if($sbKey != 'actacodigos' && !(in_array($sbKey,$rcOcultarCampos))){
            $rcHtml[] =  "<td class='titulofila' align='center'>";
            $rcHtml[] =  "   <a class=\"linkconsult\" href=\"#\" onClick=\"$form.action.value='FeCrCmdDefaultAdminTareas';$form.order_by.value='$sbKey';$form.submit();\" class=\"titulofila\">".$rclabels[$sbKey]["label"]."</a>";
            if($order_by == $sbKey){
                if($sentido == "asc" || $sentido == "")
                    $sentido = "desc";
                else
                    $sentido = "asc";
            }
            $rcHtml[] =  "</td>";
        }
    }
    $rcHtml[] =  "   <input type='hidden' name='sentido' value='$sentido'>";
    
	$rcHtml[] =  "<td class='titulofila'>".$rclabels["acciones"]['label']."</td></tr>";
	
	//Pinta los datos	
    $progressService = Application :: loadServices("ProgressBar");
    $progressService->noUp100 = true;
	$rcHtml[] =  "<tr>";
	foreach ($rcTareas as $nuIndex => $rcActa) 
	{
		//Calcula el interlineado
		if (fmod($nuIndex, 2) == 0) {
			$sbEstilo = "celda";
		} else {
			$sbEstilo = "celda2";
		}

		foreach ($rcActa as $sbKey => $sbValue) {
            if(($sbKey == "avance" || $sbKey == "actafechvenn") && $sbValue!=null){
                $rcHtml[] =  "<td class='$sbEstilo'>";
                $progressService->activeColor = getAlert($sbValue);
                $progressService->setValue($sbValue);
                $progressService->tdClass = $sbEstilo;
                $progressService->cellWidth = 2;
                $rcHtml[] =  $progressService->toHtml()."</td>";
            }else
                if($sbKey != 'actacodigos' && !(in_array($sbKey,$rcOcultarCampos))){
                	$rcHtml[] =  "<td class='$sbEstilo'><div align='center'>$sbValue</div></td>";
                }
		}
		$rcHtml[] =  "<td class='$sbEstilo'>";
		if ($sbIsOwner == true) {
			$rcHtml[] =  "<a href='#' title=\"".$rclabels_generic["reg_a"]."\" onClick=\"$form.action.value='".$sbAppId."CmdDefaultActaempresa';$form.acta.value='".$rcActa["actacodigos"]."';$form.submit();\" ><img src='$sbImgDir/editar.gif' border='0' alt=\"".$rclabels_generic["reg_a"]."\" align='absmiddle'></a>";
		}
		$rcHtml[] =  "<a href='#' title=\"".$rclabels_generic["trans"]."\" onClick=\"$form.action.value='".$sbAppId."CmdDefaultTransferTareas';$form.acta.value='".$rcActa["actacodigos"]."';$form.submit();\" ><img src='$sbImgDir/actualizar_002.gif' border='0' alt=\"".$rclabels_generic["trans"]."\" align='absmiddle'></a>";
		$rcHtml[] =  "<a href='#' title=\"".$rclabels_generic["view_t"]."\" onClick=\"javascript:fncopenwindows('".$sbAppId."CmdDefaultFichas','topFrame=".$sbAppId."CmdDefaultHeadFicha&mainFrame=".$sbAppId."CmdDefaultFichaActa&acta=".$rcActa["actacodigos"]."&vars=acta');\" ><img src='$sbImgDir/consultar_002.gif' border='0' alt=\"".$rclabels_generic["view_t"]."\" align='absmiddle'></a>";
		$rcHtml[] =  "<a href='#' title=\"".$rclabels_generic["view_r"]."\" onClick=\"javascript:fncopenwindows('".$sbAppId."CmdDefaultFichas','topFrame=".$sbAppId."CmdDefaultHeadRepoTiemposEjec&mainFrame=".$sbAppId."CmdDefaultBodyFichaOrd&ordenumerosFO=".$rcActa["ordenumeros"]."&vars=ordenumerosFO');\" ><img src='$sbImgDir/zoomprev.gif' border='0' alt=\"".$rclabels_generic["view_r"]."\" align='absmiddle'></a></td></tr>";
	}
	$rcHtml[] =  "</tr>";
	$rcHtml[] =  "</table>";
    return implode("\n",$rcHtml);
}

//determina el color de alerta para el tiepo transcurrido
function getAlert($porcentaje){

    $green = "26ad1f";
    $yellow = "f2ef0f";
    $orange = "ff8400";
    $red = "ff0000";
    $black = "000000";

    if($porcentaje >= 0 && $porcentaje <= 25)
        return $green;
    if($porcentaje >= 26 && $porcentaje <= 50)
        return $yellow;
    if($porcentaje >= 51 && $porcentaje <= 75)
        return $orange;
    if($porcentaje >= 76 && $porcentaje <= 100)
        return $red;
    if($porcentaje > 100)
        return $black;
}
?>
