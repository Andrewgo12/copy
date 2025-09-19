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
Class FeGeCmdUpdatePermisosPersonal 
{
	function execute() 
	{
		extract($_REQUEST);
		if($schecodigon != NULL && $schecodigon != "" && $authusernams != NULL &&
		 $authusernams != ""  && $perscodigos != NULL && $perscodigos != "")
		{
			settype($rcOld,"array");
		
			$objDomain = Application::getDomainController("ParamsManager");
			$rcOld = $objDomain->getAllParams($schecodigon);
		
			$sbModule = Application::getConstant("HUMAN_RESOURCES_MODULE_NAME");
			$sbParam = Application::getConstant("PERMISOS_PERSONAL_PARAM_NAME");
		
			if(array_key_exists($sbModule,$rcOld)) {
				if(array_key_exists($sbParam,$rcOld[$sbModule])) {
					$rcOld[$sbModule][$sbParam][$authusernams] = $perscodigos;
				}
			}
			
			//Incluyámole el perscodigos del usuario mismo
			$objHR = Application::loadServices("Human_resources");
			$persDatos = $objHR->getPersDatos($authusernams);
			if(is_array($persDatos))
				$rcOld[$sbModule][$sbParam][$authusernams][] = $persDatos["perscodigos"];
				
			//Finalmente, mandamos a guardar
			$objDomain->saveParams($schecodigon,$rcOld);
			
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