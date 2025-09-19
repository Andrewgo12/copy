<?php 
class FeHrPersonalManagerExtended {
	var $gateway;
	function FeHrPersonalManagerExtended() {
		$this->gateway = Application :: getDataGateway("personalExtended");
	}
	/**
	* @copyright Copyright 2004 © FullEngine
	*
	* Consulta los datos de un personal a partir del nombre de usuario
	* @param string $userName Nombre de usuario
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 09-sep-2004 13:43:06
	* @location Cali - Colombia
	*/
	function getByPersusrnams($userName) {
		$data_personal = $this->gateway->getByPersusrnams($userName);
		return $data_personal;
	}
}
?>