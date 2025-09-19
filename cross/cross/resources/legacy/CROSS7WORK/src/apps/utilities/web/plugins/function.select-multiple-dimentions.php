<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_row_table
 * Version:  1.0
 * Date:     Dic 03, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:
 * Input:
 *      name = is the name of the select (required)
 *      table_name = name of table in data base (required)
 *      value = is the name of the row in the tabla that specifies the value of select (required)
 *      label = is the name of the row in the tabla that specifies the laber of select(optional)
 *      size = this sets the number of visible choices(optional)
 *      is_null = especifica si el 'select_row_table' debe tener el valor nulo.  'true|false' (optional)
 *		id = Id del objeto
 *     command = name of the command (optional)
 *
 * Examples:
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno"}
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno" label="dname" size="5" is_null="true" command="FeCrCmdDefaultOrden"}
 *
 * --------------------------------------------------------------------
 */
function smarty_function_select_multiple_dimentions($params, & $smarty) {

	extract($params);
	extract($_REQUEST);

	settype($objManager,"object");
	settype($objService, "object");
	settype($rcTmp, "array");
	settype($rcTmpV, "array");
	settype($rcLoad,"array");
	settype($rcHtml,"array");
	settype($rcUser,"array");
	settype($sbHtml,"string");
	settype($sbSelected,"string");
	settype($sbCadena,"string");
	settype($sbAll,"string");
	settype($sbResult,"string");
	settype($nuOptions, "integer");
	$rcTmp[0] = $rcRow;
	
	//set memory limit
	$objService = Application :: loadServices("General");
	$sbResult = $objService->setMemoryLimit();

	$rcUser = Application::getUserParam();
	$generalService = Application::loadServices('General');
	$objManager = $generalService->InitiateClass('DimensionManager');
	$objManager->setIdProcess($rcUser["username"]);
	$objManager->setOperation('getDataReferenceField');

	$objManager->rcDetalleDimension = $rcTmp;
	$objManager->execute();
	$v = $objManager->getReference();

	if(is_array($_REQUEST[$name])&& $_REQUEST[$name]){
		$rcLoad = $_REQUEST[$name];
	}


	if(is_array($v) && $v){
		
		list($sbKey,$v) = each($v);
		
		foreach($v as $rcTmpV){
			$sbSelected = "";
			//Verifica cual opcion debe ser selecionada
			if(in_array($rcTmpV[0],$rcLoad)){
				$sbSelected = " SELECTED ";	
			}
			
			$rcHtml[] = "<option value='".$rcTmpV[0]."' ".$sbSelected.">".$rcTmpV[1]."</option>\n";
		}

	}
	
	if (is_array($rcHtml) && $rcHtml){
		$sbAll = implode("\n", $rcHtml);	
	}
	
	if($nuOptions > 10){
		$nuOptions = 10;
	}
		
	$sbCadena = "<select name='".$name."[]' id='".$id."' size='$nuOptions' multiple>".$sbAll."</select>";
	
	//Restore memory limit
	if($sbResult){
		ini_restore ( "memory_limit");	
	}
	return $sbCadena;
}
?>