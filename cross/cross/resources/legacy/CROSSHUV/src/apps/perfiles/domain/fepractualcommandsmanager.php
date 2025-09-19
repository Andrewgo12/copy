<?php   
/**
*   Propiedad intelectual del FullEngine.
*	
*	Actualiza los comandos de una aplicación con respecto a la base de datos
*	  
*	@author creyes
*	@date 10-ago-2004 10:38:38
*	@location Cali-Colombia
*/
class FePrActualCommandsManager {
	var $AppGateway;
	var $ExtGAteway;
	var $AppName;
	var $AppCode;
	var $rcInsertComm;
	function FePrActualCommandsManager() {
		$this->AppGateway = Application :: getDataGateway("applications");
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Trae el nombre de una aplicación
	*	@param string $applcodigos (Código de aplicación)  
	*	@author creyes
	*	@date 10-ago-2004 10:38:38
	*	@location Cali-Colombia
	*/
	function getAppName($applcodigos) {
		$rcApp = $this->AppGateway->getApplnombres($applcodigos);
		$this->AppCode = $applcodigos;
		if (is_array($rcApp))
			$this->AppName = $rcApp[0]["applnombres"];
		else
			$this->AppName = null;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Actualiza los comandos que no existen de una aplicación en la DB 
	*	@param string $applcodigos (Código de aplicación)  
	*	@author creyes
	*	@date 10-ago-2004 10:38:38
	*	@location Cali-Colombia
	*/
	function actualCommads($applcodigos) {
		//Trae el navigation de la aplicacion
		$rcNavigation = Application :: __loadNavApp(dirname(__FILE__)."/../../".$this->AppName);
		if (!is_array($rcNavigation))
			return false;
		$rcCommands = $rcNavigation["commands"];		
		unset($rcNavigation);
		//Filtra solo el nombre de los comandos
		$nucont = 0;
		foreach ($rcCommands as $key => $rcvalue) {
			if ($rcvalue["validated"] == "true"){
				$rcNameComm[$nucont] = $key;
				$nucont ++;
			}
		}
		$this->ExtGateway = Application :: getDataGateway("extend");
		$rcResult = $this->ExtGateway->actCommands($rcNameComm,$this->AppCode);
		if(!is_array($rcResult)){
			$this->rcInsertComm = null;
			return;
		}
		//Filtra los comandos ingresados
		foreach($rcResult as $key => $value){
			$rcReturn[$key] = $rcNameComm[$value];			
		}
		$this->rcInsertComm = $rcReturn;
	}
}
?>