<?php
/*
 * Created on 13/04/2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawIntegraLog($params, & $smarty) {

	extract($_REQUEST);

	settype($objDate,"object");
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcApps,"array");
	settype($sbHtml,"string");
	settype($sbStatus,"string");
	settype($sbStyle,"string");
	settype($sbLabel,"string");
	settype($sbSql,"string");
	settype($nuCont,"integer");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".integralog.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	$rcSession = WebSession :: getProperty("_rcIntegraLog");

	if($rcSession && is_array($rcSession)){

		$objDate = Application :: loadServices("DateController");
		$sbStatus = Application :: getConstant("FAILED_STATUS");
		$rcApps = Application :: getConstant("INTEG_APPS");
		
		//label para el excel
		$sbLabel =  html_entity_decode($rclabels["inlocodigon"]["label"]) .",";
		$sbLabel .= html_entity_decode($rclabels["inlofchaejin"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inloidcrosss"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inlofchaejfn"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inlousuarios"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inloapps"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inloerrors"]["label"]).",";
		$sbLabel .= html_entity_decode($rclabels["inloestados"]["label"]);
		//almacena el sql
		$sbSql = WebSession :: getProperty("_sbQueryIntegraLog");
		if($sbSql){
			saveSql($sbSql,$sbLabel);
		}

		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr><td colspan='3'><a onClick=\"getExcel();\">";
		$sbHtml .= "<img src='web/images/generar_excel.gif' alt='".$rclabels_crl['CmdDownload']."' border=0>";
		$sbHtml .= "</a></td></tr>";
		$sbHtml .= "<tr><td>";
		$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inlocodigon"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inlofchaejin"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inloidcrosss"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inlofchaejfn"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inlousuarios"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inloapps"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["inloerrors"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["accion"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		foreach($rcSession as $nuCont => $rcTmp){
			//Calcula el interlineado
			if (fmod($nuCont, 2) == 0) {
				$sbStyle = "celda";
			} else {
				$sbStyle = "celda2";
			}
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= $rcTmp["inlocodigon"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= $objDate->fncformatofechahora($rcTmp["inlofchaejin"]);
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= $rcTmp["inloidcrosss"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= "<div id=\"div_inlofchaejfn_".$rcTmp["inlocodigon"]."\">";
			if($rcTmp["inlofchaejfn"]){
				$sbHtml .= $objDate->fncformatofechahora($rcTmp["inlofchaejfn"]);
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			if($rcTmp["inlousuarios"]){
				$sbHtml .= $rcTmp["inlousuarios"];
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</div>";
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= $rcApps[$rcTmp["inloapps"]];
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= "<div id=\"div_inloerrors_".$rcTmp["inlocodigon"]."\">";
			if($rcTmp["inloerrors"]){
				$sbHtml .= $rcTmp["inloerrors"];
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</div>";
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='$sbStyle' align='center'>";
			$sbHtml .= "<div id=\"div_inloestados_".$rcTmp["inlocodigon"]."\">";
			if($rcTmp["inloestados"] == $sbStatus){
				$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta_e"]["label"]."'); if(sbResult == true){jsUpdateDetailIntegration('".$rcTmp["inlocodigon"]."','".$rcTmp["inloapps"]."');}\">";
				$sbHtml .= "<img src=web/images/editar.gif border=0 title='".$rclabels_crl['CmdUpdate']."'></a>";
				$sbHtml .= "<a href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta_ej"]["label"]."'); if(sbResult == true){jsSendIntegration('".$rcTmp["inlocodigon"]."');disableButtons();}\">";
				$sbHtml .= "<img src=web/images/actualizar_002.gif border=0 title='".$rclabels_crl['CmdSend']."'></a>";
			}else{
				$sbHtml .="&nbsp";
			}
			$sbHtml .= "</div>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
				
		}
		$sbHtml .= "</table>";
		$sbHtml .= "</td></tr>";
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}

/**
* @Copyright 2010 FullEngine
* Almacena el sql de la operacion en disco
* 
* @param string $sbSql Cadena con el query
* @param string $sbLabels cadena con los labels
* @author freina <freina@parquesoft.com>
* @date 19-Abr-2010 16:23
* @location Cali - Colombia
*/
function saveSql($sbSql,$sbLabels) {
	
	settype($sbPath,"string");
	settype($sbFile,"string");
	
	$sbPath = Application::getTmpDirectory();
	//Se valida si el directorio existe
	if(!is_dir($sbPath)){
		$sbUmask = umask(0);
		mkdir($sbPath, 0775);
		umask($sbUmask);
	}
	$sbPath .= Application::getConstant("SLASH")."sql_".$_REQUEST["PHPSESSID"];
	
	if(file_exists($sbPath)){
		unlink($sbPath);
	}
		
	$sbFile = fopen($sbPath,"w");
	fwrite($sbFile,$sbSql);
	fwrite($sbFile,"_____");
	fwrite($sbFile,$sbLabels);
	fclose($sbFile);
}
?>