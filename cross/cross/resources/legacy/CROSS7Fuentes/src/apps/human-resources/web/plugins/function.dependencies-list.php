<?php

/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta unas listas para la configuracion de dependencias fisicas  
*	@author freina<freina@parquesoft.com>
* 	@date 17-Aug-2006 15:46
*	@location Cali-Colombia
*/
function smarty_function_dependencies_list($params, & $smarty) {

	extract($_REQUEST);
	extract($params);
	
	settype($objService, "object");
	settype($rcDependencie, "array");
	settype($rcFormed, "array");
	settype($rcTmp, "array");
	settype($sbKey, "string");
	settype($sbValue, "string");
	settype($sbCadena, "string");
	settype($sbHtml, "string");
	settype($sbSelected, "string");
	settype($sbResult,"string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");

	//set memory limit
	$objService = Application :: loadServices("General");
	$sbResult = $objService->setMemoryLimit();

	//Trae todos los comandos de una app	
	$rcDependencie = getDependencies();

	if (!is_array($rcDependencie))
		return false;

	//Trae todos las dependencias configuradas para la dependencia seleccionada
	$rcFormed = getPhysicalDependency($orgacodigos);
	if (!is_array($rcFormed))
		$rcFormed = array ();

	$nuCant = sizeof($rcDependencie);

	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {

		$rcTmp = $rcDependencie[$nuCont];

		$sbKey = $rcTmp["code"];
		$sbValue = $rcTmp["code"];

		//Verifica cual opcion debe ser selecionada
		if ($rcFormed[$sbKey]) {
			$sbSelected = "selected";
		} else
			$sbSelected = "";
		$sbHtml .= "<option value='$sbValue' $sbSelected>".$rcTmp["tree"]."</option>\n";
	}
	$sbCadena = "<table border='0' align='center' width='100%''>
						 <tr>
						 	<td>
							  <div align=\"center\">       
								<select name=\"selTipoCampos\"  id=\"selTipoCampos\" size=\"30\" multiple >"."$sbHtml"."</select>
							  </div>
							</td>
						</tr></table>";
	//Restore memory limit
	if($sbResult){
		ini_restore ( "memory_limit");	
	}
	return $sbCadena;
}
/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Funcion de busqueda recursiva
	*   @param $rcData array   Data total
	*   @param $rcPadre array  Data acumulada
	*   @param $sbPadre string Codigo a analizar
	* 	@param $sbLabel string Cadena que complementa el label
	*   @param $nuIndice integer Indice del arreglo
	* 	@author freina
	*   @date 03-Nov-2004 16:41 
	*   @location Cali-Colombia
	*/
function _Seleccion($sbPadre, & $rcData, & $rcPadre, & $sbLabel, & $nuIndice) {

	settype($rcTmp, "array");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($sbTmpT, "string");
	settype($sbTmpL, "string");

	$nuCant = sizeof($rcData);

	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($rcData[$nuCont]["orgacgpads"] == $sbPadre) {
			$sbTmpT = $sbLabel."|-- ".$rcData[$nuCont]["organombres"];
			$sbTmpL = $sbLabel."|..";
			_Seleccion($rcData[$nuCont]["orgacodigos"], $rcData, $rcPadre, $sbTmpL, $nuIndice);
			$rcTmp = array ("tree" => $sbTmpT, "code" => $rcData[$nuCont]["orgacodigos"],);
			$rcPadre[$nuIndice] = $rcTmp;
			$nuIndice ++;
		}
	}
	return;
}
/**
*   Propiedad intelectual del FullEngine.
*   
*   Obtiene todas las dependencias de la organizacion
*   @author freina
*	@return $rcResult Arreglo con las dependencias
*   @date 18-Aug-2006 14:46 
*   @location Cali-Colombia
*/
function getDependencies() {

	settype($objGateway, "object");
	settype($objTmp, "object");
	settype($rcResult, "array");
	settype($rcReturn, "array");
	settype($rcTmp, "array");
	settype($sbLabel, "string");
	settype($nuIndice, "integer");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuRow, "integer");

	$objTmp = Application :: loadServices("General");
	$rcTmp = $objTmp->getParam("human_resources", "ORG_INACT");
	$objGateway = Application :: getDataGateway("organizacionExtended");
	$rcTmp = $objGateway->getAllOrganizacion($rcTmp);
	if ($rcTmp) {
		_Seleccion("", $rcTmp, $rcResult, $sbLabel, $nuIndice);
	}

	if ($rcResult) {
		$nuCant = sizeof($rcResult);
		for ($nuCont = ($nuCant -1); $nuCont >= 0; $nuCont --) {
			$rcReturn[$nuRow] = $rcResult[$nuCont];
			$nuRow ++;
		}
	}

	return $rcReturn;
}
function getPhysicalDependency($sbOrgacodigos) {

	settype($objManager, "object");
	settype($rcResult, "array");
	settype($rcTmp, "array");
	settype($sbIndex, "string");
	settype($sbValue, "string");

	if ($sbOrgacodigos) {
		
		$sbOrgacodigos = (string) $sbOrgacodigos;
		
		$objManager = Application :: getDomainController('PhysicaldependenciesManager');
		$rcTmp = $objManager->getPhysicaldependencies();

		if ($rcTmp) {
			foreach ($rcTmp as $sbIndex => $sbValue) {
				$sbValue = (string) $sbValue;
				if ($sbValue == $sbOrgacodigos) {
					$rcResult[$sbIndex] = true;
				}
			}
		}
	}

	return $rcResult;
}
?>