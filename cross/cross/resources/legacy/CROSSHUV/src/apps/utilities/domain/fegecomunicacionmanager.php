<?php    
class FeGeComunicacionManager {
	
	var $gateway;
	var $objdate;

	function FeGeComunicacionManager() {
		$this->gateway = Application :: getDataGateway("comunicacion");
		$this->objdate = Application :: loadServices("DateController");
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea un nuevo registro de comunicacion
	*   @author freina
	*	@param string $isbordenumeros (Cadena con el codigo del requerimiento)
	*	@param string $isbfocacodigos (Cadena con el codigo del formato de carta)
	*	@param string $isbcomuasuntos (Cadena con el asunto de la comunicacion)
	*	@param string $isbcomutextos (Cadena con el texto de la comunicacion)
	*	@return string $osbresult (Cadena con el codigo de resultado)
	*   @date 29-Oct-2004 06:24
	*   @location Cali-Colombia
	*/
	function addComunicacion($isbordenumeros, $isbfocacodigos, $isbcomuasuntos, $isbcomutextos) {

		settype($objnumerador, "object");
		settype($rcuser, "array");
		settype($osbresult, "string");
		settype($sbcomucodigos, "string");
		settype($sbcomuestados, "string");
		settype($sbcomuusuagen, "string");
		settype($sbusuacodigos, "string");
		settype($sbdbnull, "string");
		settype($nucomufecregn, "integer");

		if ($isbfocacodigos && $isbcomuasuntos && $isbcomutextos) {

			$objnumerador = Application :: getDomainController('NumeradorManager');
			$sbcomucodigos = $objnumerador->fncgetByIdNumerador("comunicacion");

			$sbdbnull = Application :: getConstant("DB_NULL");
			$sbcomuestados = Application :: getConstant("COM_P");
			//Obtiene los datos del usuario
			$rcuser = Application :: getUserParam();
			
			//fecha hora de hoy
			$nucomufecregn = $this->objdate->fncintdatehour();

			$this->gateway->addComunicacion($sbcomucodigos, $isbordenumeros, $isbfocacodigos, $isbcomuasuntos, 
			$isbcomutextos, $sbcomuestados, $rcuser["username"], $rcuser["username"], $nucomufecregn, $sbdbnull);
			$this->UnsetRequest();
			$osbresult = 3;
		} else {
			$osbresult = 0;
		}
		return $osbresult;
	}

	function updateComunicacion($comucodigos, $ordenumeros, $focacodigos, $comuasuntos, $comutextos, $comuestados, $comuusuagen, $usuacodigos, $comufecregn, $comufecenvn) {
		if ($this->gateway->existComunicacion($comucodigos) == 1) {
			$this->gateway->updateComunicacion($comucodigos, $ordenumeros, $focacodigos, $comuasuntos, $comutextos, $comuestados, $comuusuagen, $usuacodigos, $comufecregn, $comufecenvn);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteComunicacion($comucodigos) {
		if ($this->gateway->existComunicacion($comucodigos) == 1) {
			$this->gateway->deleteComunicacion($comucodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdComunicacion($comucodigos) {
		$data_comunicacion = $this->gateway->getByIdComunicacion($comucodigos);
		return $data_comunicacion;
	}

	function getAllComunicacion() {
		//$this->gateway->
	}

	function getByComunicacion_fkey($focacodigos) {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["comunicacion__comucodigos"]);
		unset ($_REQUEST["comunicacion__ordenumeros"]);
		unset ($_REQUEST["comunicacion__focacodigos"]);
		unset ($_REQUEST["comunicacion__comuasuntos"]);
		unset ($_REQUEST["comunicacion__comutextos"]);
		unset ($_REQUEST["comunicacion__comuestados"]);
		unset ($_REQUEST["comunicacion__comuusuagen"]);
		unset ($_REQUEST["comunicacion__usuacodigon"]);
		unset ($_REQUEST["comunicacion__comufecregn"]);
		unset ($_REQUEST["comunicacion__comufecenvn"]);
	}

}
?>