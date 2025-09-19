<?php
/**
 *   Propiedad intelectual del FullEngine.
 *
 *	Pinta el valos pasado como parametro o el indicado desde el request
 *	@param array
 *	@author freina<freina@parquesoft.com>
 *	@date 15-Nov-2009 10:50
 *	@location Cali-Colombia
 */

function smarty_function_printvalue($params, &$smarty){
	
	
	settype($sbTmp,"string");
	settype($sbFont,"string");

	//se organiza el arreglo
	extract($params);
	
	if(isset($value)){
		$sbTmp = $value;
	}else{
		$sbTmp = $_REQUEST[$label];
	}
	
	if($blFont){
		$sbFont = "<font ";
		if($size){
			$sbFont .=" size=".$size." ";
		}
		$sbFont .=">".$sbTmp;
		$sbFont .="</font>";
		$sbTmp = $sbFont;
	}
	
	if($blBold) {
		$sbTmp = "<B>".$sbTmp."</B>";
	}
	echo $sbTmp;
}
?>