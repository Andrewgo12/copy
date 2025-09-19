<?php 
require_once "Data/Serializer.class.php";
class FeGeParamsManager
{
	var $params;
	var $all;
	function FeGeParamsManager()
	{
		$file_name = Application :: getBaseDirectory().'/config/application.params.data';
		if (file_exists($file_name))
		{
            $user = Application::getUserParam();
            if(!is_array($user))
            	$user['schema'] = 2;
            	
            //Ajusta por defecto el esquema del profiles
            if(!is_array($user))
                $this->params = null;
            else
            {
                $rcTmpParams = Serializer :: load($file_name);
                $this->all = $rcTmpParams;
            	$this->params = $rcTmpParams[$user['schema']];
            }
		}
		else
		{
			$this->params = null;
        }
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene un parametro
	* @param string $module Nombre del modulo
	* @param string $param Nombre del parametro
	* @return mixed
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-nov-2004 16:42:13
	* @location Cali-Colombia
	*/
	function getParam($module,$param){
		return $this->params[$module][$param];
	}
	
	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Obtiene todos los parámetros
	* @return mixed
	* @author creyes <mrestrepo@parquesoft.com>
	* @date 21-mar-2006 16:42:13
	* @location Cali-Colombia
	*/
	function getAllParams($schema = 0)
	{
		return $this->all[$schema];
	}
	
	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Guarda los params
	* @return mixed
	* @author creyes <mrestrepo@parquesoft.com>
	* @date 24-mar-2006 16:42:13
	* @location Cali-Colombia
	*/
	function saveParams($schema,$rcNewParams)
	{
		//Instanciamos y setiamos algunas variables
		$objService = Application :: loadServices("SchemaAdministrator");
		$objService->setModule('general');
		$objService->loadModule();
		$objService->setNameFile('application.params.data');
		
		$objService->setId($schema);
		$objService->setNewData($rcNewParams);
		
		//Guardamos
		$objService->saveParams();
		
		//Cerramos el servicio
		$objService->close();
	}
	
	function UnsetRequest()
	{
		unset($_REQUEST["schecodigon"]);
		unset($_REQUEST["authusernams"]);
		unset($_REQUEST["orgacodigos"]);
		unset($_REQUEST["acticodigos"]);
		unset($_REQUEST["acticodigos2"]);
	}
	
	function UnsetRequestPersonal()
	{
		unset($_REQUEST["schecodigon"]);
		unset($_REQUEST["authusernams"]);
		unset($_REQUEST["perscodigos"]);
	}
}
?>
