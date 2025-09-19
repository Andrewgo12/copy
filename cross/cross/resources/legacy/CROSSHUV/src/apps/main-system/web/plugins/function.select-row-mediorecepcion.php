<?php 
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_row_mediorecepcion
 * Version:  1.0
 * Date:     Jan 10 2007
 * Author:	 freina<freina@parquesoft.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      value = is the name of the row in the tabla that specifies the value of select (required)
 *      label = is the name of the row in the tabla that specifies the laber of select(optional)
 *      size = this sets the number of visible choices(optional)
 *      is_null = especifica si el 'select_row_table' debe tener el valor nulo.  'true|false' (optional)
 *		id = Id del objeto
 *     command = name of the command (optional)
 *
 * Examples: 
 *       {select_row_mediorecepcion name="Mycombo" value="deptno"}
 *       {select_row_mediorecepcion name="Mycombo" value="deptno" label="dname" size="5" is_null="true" command="FeCrCmdDefaultOrden"}
 *
 * --------------------------------------------------------------------
 */
function smarty_function_select_row_mediorecepcion($params, & $smarty) {
	
	extract($params);
	
	settype($objGateway, "object");
    settype($objService, "object");
    settype($rcParams, "array");
    settype($rcData, "array");
	settype($rcTmp, "array");
    settype($rcWebUser, "array");
	settype($sbid, "string");
	settype($sbCommand, "string");
    settype($sbHtml, "string");
	settype($nuCont, "integer");
	
	$objService = Application :: loadServices("General");
    $rcWebUser = $objService->getParam("cross300", "web_user_conf");
    if($_REQUEST["ordenempresa__merecodigos"] == $rcWebUser["merecodigos"])
    	$_REQUEST["loadMerecodigos"] = $rcWebUser["merecodigos"];
    	
    extract($_REQUEST);
    
    $sqlid ="mediorecepcionesp";
	
	if ($command_default) {
		$sbCommand = " onchange=\"action.value = '".$command_default."';submit();\" ";
	}else{
		if($onchange){
			$sbCommand = " onchange=\"".$onchange."\" ";
		}
	}
	if (isset ($sqlid)) {
         if(!isset($loadMerecodigos))
         {
         	$objService = Application :: loadServices("General");
         	$rcWebUser = $objService->getParam("cross300", "web_user_conf");
         	$rcParams[0] = $rcWebUser["merecodigos"];
         }
         $nuCont=1;
		if($param){
			$rcTmp = explode(",",$param);
			foreach($rcTmp as $sbIndex){
				$rcParams[$nuCont] = $_REQUEST[$sbIndex];
				$nuCont ++;
			}
			
		}
		$objGateway = Application :: getDataGateway("SqlExtended");
		$rcData = $objGateway->getDataCombo($sqlid,$rcParams);
		if(!is_array($rcData))
			return false;
		if($loadMerecodigos)
		{
			foreach ($rcData as $rcRow)
				if($rcRow["merecodigos"] == $loadMerecodigos)
					$rcNewData[] = $rcRow;
			$rcData = $rcNewData;
		}
	}
	
	if (!isset ($label)) {
		$label = $value;
	}

	if (!isset ($size)) {
		$size = 1;
	}

	if (isset ($id)) {
		$sbid = " id=\"$id\"";
	}

	$sbHtml = '';
	$sbHtml .= "<select name='$name' size='$size' $sbid ".$sbCommand.">";

	if ($is_null == "true") {
		$sbHtml .= "<option value=''>---</optional>";
	}
	
	for ($i = 0; $i < count($rcData); $i ++)
	{
		$sbHtml .= "<option value='";
		$sbHtml .= $rcData[$i][$value];
		if ($_REQUEST[$name] == $rcData[$i][$value]) {
			$sbHtml .= "' selected>";
		} else {
			$sbHtml .= "'>";
		}
		if(strstr($action,"ShowById")==false)
			$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
		$sbHtml .= $rcData[$i][$label];
		$sbHtml .= "</option>";
	}
	$sbHtml .= "</select>";

	return $sbHtml;
}
?>