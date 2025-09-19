<?php
/**
 * @Copyright 2004 FullEngine
 *
 * Comando de modificar a la tabla $tabla
 * @author Ingravity 0.0.8
 * @date 14-dic-2004
 * @location Cali - Colombia
 */

require_once "Web/WebRequest.class.php";
Class FeGeCmdUpdateParametros
{
	function execute() {

		settype($objDomain,"object");
		settype($rcNewParams,"array");
		settype($rcOld,"array");
		settype($rcNAllowed,"array");
		settype($rcValues,"array");
		settype($rcTmp,"array");
		settype($rcParModule,"array");
		settype($sbNAllowParams,"string");
		settype($sbKey,"string");
		settype($sbModule,"string");
		settype($sbIdParam,"string");
		settype($sbIdParamOld, "string");
		settype($nuCont,"integer");
		extract($_REQUEST);

		$objDomain = Application::getDomainController("ParamsManager");
		$rcOld = $objDomain->getAllParams($schema);

		$sbNAllowParams = Application::getConstant("NOT_ALLOWED_PARAMS");
		$rcNAllowed = explode(",",$sbNAllowParams);

		foreach ($_REQUEST as $sbKey=>$rcValues){
				
			if(!(strpos($sbKey,"__")===false) && (strpos($sbKey,'__')!==0)){

				if(is_array($rcValues)){
					if(in_array("",$rcValues)){
						array_pop($rcValues);
					}
				}

				$rcTmp = explode("__",$sbKey);
				$sbModule = $rcTmp[0];
				$sbIdParam = $rcTmp[1];

				if(array_key_exists(2,$rcTmp)){
						
					if(!is_numeric($rcTmp[2])){
						$rcNewParams[$sbModule][$sbIdParam][$rcTmp[2]] = $rcValues;
					}else{
						$rcNewParams[$sbModule][$sbIdParam] = $rcValues;
					}
				}else{
					$rcNewParams[$sbModule][$sbIdParam] = $rcValues;
				}
			}
		}

		//Traemos los prohibidos y los agregamos
		foreach ($rcOld as $sbModule=>$rcParModule){
			foreach ($rcNAllowed as $nuCont=>$sbIdParamOld){
				if(array_key_exists($sbIdParamOld,$rcParModule)){
					$rcNewParams[$sbModule][$sbIdParamOld] = $rcParModule[$sbIdParamOld];
				}
			}
		}

		if($rcNewParams){
				
			//Finalmente, mandamos a guardar
			$objDomain->saveParams($schema,$rcNewParams);

			WebRequest :: setProperty('cod_message', $message = 3);
			return "success";
		}else{
			WebRequest :: setProperty('cod_message', $message = 100);
			return "fail";
		}
	}
}
?>