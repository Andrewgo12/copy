<?php       
/**
* @Copyright 2004 - FullEngine
*
* Smarty plugin
* Pinta el administrador que permite registrar los anexos de un caso
* @author freina <freina@parquesoft.com>
* @date 02-May-2007 17:47
* @location Cali - Colombia
*/
function smarty_function_register_attachment_web($params, & $smarty) {

	extract($params);
	settype($objGateway, "object");
	settype($objService, "object");
	settype($rcFileName, "array");
	settype($rcTiposFile, "array");
	settype($rcTmp, "array");
	settype($rcUser, "array");
	settype($rcResult, "array");
	settype($sbValue, "string");
	settype($sbTipo, "string");
	settype($sbEstilo, "string");
	settype($sbOrdenumeros, "string");
	settype($sbIndex, "string");
	settype($sbFncnrio,"string");
	settype($nuCont, "integer");
	settype($nuRows, "integer");
	settype($nuRow, "integer");

	
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	$sbOrdenumeros = $_REQUEST["orden__ordenumeros"];
	
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	//se obtiene el funcionario de un parametro
	$objService = Application::loadServices('General');
	$sbFncnrio = $objService->getParam("cross300","USER_DOCUNET");
	
	//se obtienen los archivos ya guardados
	$rcFileName = WebSession :: getProperty("_rcCasosFileList");
	if(!$rcFileName){
		//consulta las anexos
		if ($sbOrdenumeros && $_REQUEST["consult"]!=null && $_REQUEST["consult"]!="") {
			$objService = Application :: loadServices('General');
			$rcTiposFile = $objService->getConstant('TIPO_FILE');
			$sbTipo = $rcTiposFile["anexo"];
			$objService = Application :: loadServices('General');
			$objGateway = $objService->loadGateway('Archivos');
			$rcResult = $objGateway->getDescArchivo($sbTipo, $sbOrdenumeros);
			$objService->close();
			if (is_array($rcResult) && $rcResult) {
				foreach ($rcResult as $nuCont =>$rcTmp){
					$rcFileName[$nuCont]["name"] = $rcTmp["archnombres"];
					$rcFileName[$nuCont]["id"] = $rcTmp["archcodigon"];
					$rcFileName[$nuCont]["ext"] = $rcTmp["archextensis"];
					$nuRow = $nuCont +1;
					$rcFileName[$nuCont]["row"]=$nuRow;
					$sbIndex = "_file_".$nuRow;
					$rcFileName[$nuCont]["index"]=$sbIndex;
				}
			}
			WebSession :: setProperty("_rcCasosFileList", $rcFileName);
			$_REQUEST["consult"] = 1;
		}
	}
	
	//Trae las etiquetas
	include ($rcUser["lang"]."/".$rcUser["lang"].".anexos.php");

	$sbhtml .= "<table border='0' align='left' width='100%'>";
	$sbhtml .= "<tr><th colspan='3'><div align='left'>".$rclabels["title"]."</div></th></tr>";
	//Pinta el textfield tipo file
	$sbhtml .= "<tr>";
	$sbhtml .= "<td width='25%' class=\"tdlabels\"><B>".$rclabels["nombre"]["label"]."</B></td>";
	$sbhtml .= "<td colspan=\"2\" width='60%'><input type=\"text\" name=\"anexos__archnombres\" id=\"archnombres\" maxlength=\"50\" ".getFieldValidation()."><B>*</B>";
	$sbhtml .= "<tr>";

	$sbhtml .= "<tr>";
	$sbhtml .= "<td width='25%' class=\"tdlabels\"><B>".$rclabels["tipo"]["label"]."</B></td>";
	$sbhtml .= "<td colspan=\"2\" width='60%'><select id=\"archextensis\" name=\"anexos__archextensis\">".getOption()."</select><B>*</B>";
	$sbhtml .= "<tr>";

	$sbhtml .= "<tr>";
	$sbhtml .= "<td width='25%' class=\"tdlabels\">".$rclabels["anexcodigon"]["label"]."</td>";
	$sbhtml .= "<td colspan=\"2\" width='60%'><input type=file name=anexos___anexnombarch size=50 maxlength=100>";
	$sbhtml .= "<a href='#' onClick=\"$form.action.value='FeCrCmdAddAnexosWeb';$form.submit();\" >";
	$sbhtml .= "<img src='web/images/positivo_002.gif' border='0' align='middle' title=\"".$rclabels["add"]["label"]."\"></a>";
	$sbhtml .= "<input type=\"hidden\" name=\"anexos__nmbre_crpta\" id=\"nmbre_crpta\" value=\"".$_REQUEST["anexos__nmbre_crpta"]."\">";
	$sbhtml .= "<input type=\"hidden\" name=\"anexos__fncnrio\" id=\"fncnrio\" value=\"".$sbFncnrio."\">";
	$sbhtml .= "</td></tr>";
	$sbhtml .= "<tr><td colspan='3' class='piedefoto'><hr></tr>"."\n";
	//Pinta las opciones ya selecionadas
	if ($rcFileName) {
		//Pone los emcabezados
		$sbhtml .= "</tr>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["nombre"]["label"]."</td>";
		$sbhtml .= "<td class='titulofila' align='center'>".$rclabels["tipo"]["label"]."</td>";
		$sbhtml .= "<td class='titulofila'>".$rclabels["acciones"]["label"]."</td>";
		$sbhtml .= "</tr>"."\n";
		foreach ($rcFileName as $nuCont => $rcTmp) {
			
			//Calcula el interlineado
			if (($nuRows % 2) == 0) {
				$sbEstilo = "celda";
			} else{
				$sbEstilo = "celda2";
			}
				
			$sbhtml .= "<tr>";
			$sbhtml .="<td class='$sbEstilo'>".$rcTmp["name"]."</td>";
			$sbhtml .="<td align='left' class='$sbEstilo'>".$rcTmp["ext"]."</td>";
			$sbhtml .="<td class='$sbEstilo'>"."<a href='#' onClick=\"$form.action.value='FeCrCmdDeleteAnexosWeb';$form.deleteattachment.value='".$rcTmp["index"]."';$form.submit();\">";
			$sbhtml .="<img src='web/images/borrar.gif' border='0' align='middle' title=\"".$rclabels["del"]["label"]."\"></a>"."</td>";
			$sbhtml .="</tr>"."\n";
			$nuRows ++;
		}
	}
	$sbhtml .= "</table>";
	return $sbhtml;
}
/**
 * @Copyright 2012 FullEngine
 *
 * Pinta la validacion de cadena sin tildes
 * @author freina <freina@fullengine.com>
 * @date 05-Jan-2012 10:30
 * @location Cali - Colombia
 */
function getFieldValidation(){
	settype($sbHtml, "string");

	if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
		$sbHtml = " onkeypress=\"if (!(((event.keyCode>=97) && (event.keyCode<=122)) ||";
		$sbHtml .= " ((event.keyCode>=65) && (event.keyCode<=90)) || (event.keyCode==32)";
		$sbHtml .= " || (event.keyCode==241) || (event.keyCode==209)))";
		$sbHtml .= " event.returnValue = false;\"";
	}else{
		$sbHtml = " onkeypress=\"if (!(((event.charCode>=97) && (event.charCode<=122)) ||";
		$sbHtml .= " ((event.charCode>=65) && (event.charCode<=90)) || (event.charCode==32)";
		$sbHtml .= " || (event.charCode==241) || (event.charCode==209) ||";
		$sbHtml .= " (event.charCode == 0) || (event.charCode == 8)))";
		$sbHtml .= " event.preventDefault();\"";
	}

	return $sbHtml;
}
/**
 * @Copyright 2012 FullEngine
 *
 * Obtiene las opciones del combod de extension de archivo
 * @author freina <freina@fullengine.com>
 * @date 05-Jan-2012 10:50
 * @location Cali - Colombia
 */
function getOption(){

	settype($objService, "object");
	settype($objGateway, "object");
	settype($rcData, "array");
	settype($rcTmp, "array");
	settype($sbHtml,"string");

	$objService = Application :: loadServices("General");
	$objGateway = $objService->getGateWay("extensarchiv"); 
	$objGateway->getExtensarchiv();
	$rcData =$objGateway->getResult();
	$objService->close();
	
	$sbHtml = "<option value=''>---</optional>";
	
	if(is_array($rcData) && $rcData){
		foreach ($rcData as $rcTmp) {
			$sbHtml .= "<option value='".$rcTmp["exarcodigos"]."'>";
			$sbHtml .= "(".$rcTmp["exarcodigos"].") ".$rcTmp["exarnombres"];
			$sbHtml .= "</option>";
		}
	}

	return $sbHtml;
}
?>