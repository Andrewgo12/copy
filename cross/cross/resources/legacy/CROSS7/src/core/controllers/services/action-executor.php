<?php      
class ExecuteAction {
	
	
	/**
	*	Copyright 2006 FullEngine
	*	actualiza los parametros de ejecucion
	*	@param array  $rcParameters Arreglo con la sgte estructura
	*	[service] nombre del servicio en el cual se enecuentra el metodo a ejecutar
	*	[method] nombre del metodo a ejecutar
	*	[parameters] Arreglo con los parametros que necesita cada metodo
	*	@author freina<freina@parquesoft.com>
	*	@date 04-Apr-2006 14:04
	*	@location Cali - Colombia	
	*/
	function setParameters($rcParameters){
		$this->rcParameters = $rcParameters;
	}

	/**
	*	Copyright 2006 FullEngine
	*	Ejecuta los procedimientos pasados como parametro
	*	@return array $rcResult Arreglo con la sgte estructura
	*	[result] true or false
	*	[service] si false, nombre del servicio que tuvo problema
	*	[method] si false, el nombre del metoo que fallo
	*	@author freina<freina@parquesoft.com>
	*	@date 04-Apr-2006 14:04
	*	@location Cali - Colombia	
	*/
	function execute() {
		
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbIndex,"string");
		settype($sbResult,"string");
		
		//si no existe nada por hacer
		$rcResult["result"] = true;
		
		if($this->rcParameters){
			
			foreach($this->rcParameters as $sbIndex => $rcTmp){
				if($rcTmp["service"] && $rcTmp["method"]){
					$objService = Application :: loadServices($rcTmp["service"]);
					$sbResult = $objService->$rcTmp["method"]($rcTmp["parameters"]);
					$objService->close();
					if($sbResult===false){
						$rcResult["result"] = false;
						$rcResult["service"] = $rcTmp["service"];
						$rcResult["method"] = $rcTmp["method"];
						break;
					} 
				}
			}
		}
		
		return $rcResult;
	}
}
?>