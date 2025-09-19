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
Class FeGeCmdDeleteActiviPares 
{
	function execute() 
	{
		extract($_REQUEST);
		if($acticodigos != NULL && $acticodigos != "" )
		{
			if($acticodigos == NULL || $acticodigos == "")
			{
				WebRequest :: setProperty('cod_message', $message = 67);
				return "fail";
			}
			
			settype($rcOld,"array");
		
			$objDomain = Application::getDomainController("ParamsManager");
			$rcOld = $objDomain->getAllParams(2);
		
			$sbModule = Application::getConstant("WORKFLOW_MODULE_NAME");
			$sbParam = Application::getConstant("OPOSITE_ACTIVITIES_PARAM_NAME");
		
			if(array_key_exists($sbModule,$rcOld)) {
				if(array_key_exists($sbParam,$rcOld[$sbModule])) {
					if(array_key_exists($acticodigos,$rcOld[$sbModule][$sbParam])) {
						$rcOld[$sbModule][$sbParam][$acticodigos] = false;
					}
				}
			}
		
			//Finalmente, mandamos a guardar
			$objDomain->saveParams(2,$rcOld);
			$objDomain->unsetRequest();
			
			WebRequest :: setProperty('cod_message', $message = 3);
			return "success";
		}
		else
		{
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>
