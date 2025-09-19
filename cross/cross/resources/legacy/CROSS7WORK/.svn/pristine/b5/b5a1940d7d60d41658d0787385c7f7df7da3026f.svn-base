<?php
	
/**
 * @Copyright 2005 Parquesoft
 *
 * Clase manager de la tabla transfertarea
 * @author Ingravity 0.0.9
 * @location Cali - Colombia
 */
class FeCrTransfertareaManager{
	var $gateway;

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo constructor tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function FeCrTransfertareaManager(){
		$this->gateway = Application::getDataGateway("transfertarea");
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo adicion de datos tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function addTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtafecingn,$trtaobservas){
		if($this->gateway->existTransfertarea($trtacodigos) == 0){
			$result = $this->gateway->addTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtafecingn,$trtaobservas);
			if($result == false)
			return 100;
			$this->UnsetRequest();
			return 3;
		}else{
			return 1;
		}
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo de actualizacion de datos tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function updateTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtaobservas){
		if($this->gateway->existTransfertarea($trtacodigos) == 1){
			$result = $this->gateway->updateTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtaobservas);
			if($result == false)
			return 5;
			$this->UnsetRequest();
			return 3;
		}else{
			return 2;
		}
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo de eliminacion de datos tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function deleteTransfertarea($trtacodigos){
		if($this->gateway->existTransfertarea($trtacodigos) == 1){
			$result = $this->gateway->deleteTransfertarea($trtacodigos);
			if($result){
				$this->UnsetRequest();
				return 3;
			}else{
				return 5;
			}
		}else{
			return 2;
		}
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo consulta los datos por la llave primaria de la tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getByIdTransfertarea($trtacodigos){
		$data_transfertarea = $this->gateway->getByIdTransfertarea($trtacodigos);
		return $data_transfertarea;
	}
	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo consulta los datos por la tarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getTranferByTarecodigos($tarecodigos){
		$data_transfertarea = $this->gateway->getTarecodigos($tarecodigos);
		return $data_transfertarea;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo consulta todos los datos de la tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getAllTransfertarea(){
		$data_transfertarea = $this->gateway->getAllTransfertarea($trtacodigos);
		return $data_transfertarea;

	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para limpiar los datos de la sesion de la tabla: transfertarea
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function UnsetRequest(){

		unset($_REQUEST["transfertarea__trtacodigos"]);
		unset($_REQUEST["transfertarea__tarecodigos"]);
		unset($_REQUEST["transfertarea__orgacodigos"]);
		unset($_REQUEST["transfertarea__trtafechan"]);
		unset($_REQUEST["transfertarea__trtaobservas"]);
	}
}
?>