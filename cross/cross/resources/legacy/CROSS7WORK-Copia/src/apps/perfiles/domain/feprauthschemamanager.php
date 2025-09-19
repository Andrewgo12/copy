<?php
/**
* @Copyright 2005 Parquesoft
*
* Clase manager de la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
class FePrAuthschemaManager {
	var $gateway;

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FePrAuthschemaManager() {
		$this->gateway = Application :: getDataGateway("authschema");
	}

	function addAuthschema($authusernams,$schecodigon)
    {
      	if($this->gateway->existAuthschema($authusernams,$schecodigon) == 0)
      	{
          	$this->gateway->addAuthschema($authusernams,$schecodigon);
		  	if($this->gateway->consult == false)
				return 100;
          	return 3;
      	}
      	else
      	{
          	return 1;
      	}
    }
    
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta los datos por la llave primaria de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdSchema($schecodigon) {
		$data_schema = $this->gateway->getByIdSchema($schecodigon);
		return $data_schema;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllSchema() {
		$data_schema = $this->gateway->getAllSchema($schecodigon);
		return $data_schema;

	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getSchemasUser($authusernams) {
		$data_schema = $this->gateway->getSchemasUser($authusernams);
		return $data_schema;
	}
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteAuthschema($authusernams,$schecodigon=false)
	{
		$data_schema = $this->gateway->deleteAuthschema($authusernams,$schecodigon);
		return $data_schema;
	}
}
?>