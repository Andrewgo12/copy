<?php
/*
 * Created on 23/08/2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawSolicitante($params, & $smarty) {

	extract($_REQUEST);

	settype($objService, "object");
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcField1,"array");
	settype($rcField2,"array");
	settype($sbHtml,"string");
	settype($sbHtml1,"string");
	settype($sbHtml2,"string");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".solicitante.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	include_once ("config/config.solicitante.php");

	$rcSession = WebSession :: getProperty("_rcSolicitante");
	
	if($rcSession && is_array($rcSession)){
		
		switch ($rcSession["signal"]) {
			case 1:
				if(is_array($rcSession["contacto"]) && $rcSession["contacto"]){
					set_REQUEST($rcField1 , $rcSession["contacto"]);	
				}
			break;
			case 2:
				if(is_array($rcSession["contacto"]) && $rcSession["contacto"]){
					set_REQUEST($rcField1 , $rcSession["contacto"]);	
				}
				if(is_array($rcSession["cliente"]) && $rcSession["cliente"]){
					set_REQUEST($rcField2 , $rcSession["cliente"]);	
				}
				
			break;
		}

		$rcField1 = getObject($rcField1);

		$objService = Application :: loadServices("Html");

		$sbHtml1 = $objService->genCard($rcField1[1], $rcField1[0], $rcParams);

		if($rcSession["signal"]==1){
			$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align=\"center\" class='titulofila'>";
			$sbHtml .= $rclabels["subtitle3"];
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			$sbHtml .= "<tr>";
			$sbHtml .= "<td>";
			$sbHtml .= $sbHtml1;
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			$sbHtml .= "</table>";
		}else{
			if($rcSession["signal"]==2){

				$rcField2 = getObject($rcField2);
				$sbHtml2 = $objService->genCard($rcField2[1], $rcField2[0], $rcParams);
				$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
				$sbHtml .= "<tr>";
				$sbHtml .= "<td align=\"center\" class='titulofila'>";
				$sbHtml .= $rclabels["subtitle1"];
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "<tr>";
				$sbHtml .= "<td>";
				$sbHtml .= $sbHtml2;
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "<tr>";
				$sbHtml .= "<td align=\"center\" class='titulofila'>";
				$sbHtml .= $rclabels["subtitle2"];
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "<tr>";
				$sbHtml .= "<td>";
				$sbHtml .= $sbHtml1;
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "</table>";
			}
		}

	}
	return $sbHtml;
}
/**Copyright 2012 FullEngine
 *
 * crea los objetos a presentar en la forma
 * @author freina <freina@parquesoft.com>
 * @date 24-Aug-2012 14:40
 * @location Cali - Colombia
 */
function getObject($rcField){

	settype($rcResult, "array");
	settype($rcRow, "array");
	settype($sbName, "string");
	settype($sbType, "string");
	settype($sbIndex, "string");
	settype($sbValue, "string");
	settype($sbLabel, "string");
	settype($sbPlugin_File, "string");
	settype($sbPlugin_Func, "string");
	settype($sbEnd, "string");
	settype($nuCont, "integer");

	if(is_array($rcField) && $rcField){

		//labels
		$sbType = "function";
		$sbName = "printlabel_pub";
		$sbPlugin_FuncL = 'smarty_' .$sbType.'_'.$sbName;
		$sbPlugin_File = Application::getPluginsDirectory()."/".$sbType.".".$sbName.".php";
		include_once $sbPlugin_File;


		foreach ($rcField as $sbIndex=>$rcTmp){

			if(is_array($rcTmp) && $rcTmp){

				$sbValue = null;

				if($rcTmp[1]){
					$sbBold = "true";
					$sbEnd = "<b>*</b>";
				}else{
					$sbBold = null;
					$sbEnd = null;
				}
				$sbLabel = $sbPlugin_FuncL(array("name"=>$sbIndex, "blBold"=>$sbBold),$this,false);
				$rcResult[0][$sbIndex]["label"] = $sbLabel;

				foreach ($rcTmp[0] as $nuCont=>$rcRow){

					$sbName = strtolower($rcRow[0]);

					$sbPlugin_File = Application::getPluginsDirectory()."/".$sbType.".".$sbName.".php";

					if(file_exists($sbPlugin_File)){

						$sbPlugin_Func = 'smarty_' .$sbType.'_'.$sbName;

						include_once $sbPlugin_File;

						$sbValue = $sbPlugin_Func($rcRow[1],$this,false);
							
						$rcResult[1][$sbIndex] .= $sbValue;
					}
				}

				$rcResult[1][$sbIndex] .= $sbEnd;
			}
		}

		return $rcResult;
	}
}
/**Copyright 2012 FullEngine
 *
 * monta la informacion obtenida en la consulta
 * @author freina <freina@parquesoft.com>
 * @date 28-Aug-2012 14:40
 * @location Cali - Colombia
 */
function set_REQUEST($rcField , $rcData){
	
	settype($rcTmp, "array");
	settype($rcRow, "array");
	settype($rcObject, "array");
	settype($sbIndex, "string");
	
	$rcObject = array("textfield","select_row_table_lang","calendar");
	if(is_array($rcField) && $rcField && is_array($rcData) && $rcData){
		
		foreach ($rcField as $sbIndex=>$rcTmp){
			foreach($rcTmp[0] as $rcRow){
				if(in_array($rcRow[0], $rcObject)){
					if($rcRow[1]["id"]){
						$_REQUEST[$rcRow[1]["name"]] = $rcData[$rcRow[1]["id"]];
					}else{
						if($rcRow[1]["name"]){
							$_REQUEST[$rcRow[1]["name"]] = $rcData[$rcRow[1]["name"]];
						}
					}
				}
			}
		}
	}
	
	return true;
}
?>
