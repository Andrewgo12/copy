<?php 

class FeStSaldobodegaManager {
    var $gateway;

	function FeStSaldobodegaManager() {
		$this->gateway = Application::getDataGateway("reportes");
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Consulta el listado de saldos para una o todas las bodegas
	* @param string $bodecodigos codigo de la bodega
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 14-oct-2004 14:03:23
	* @location Cali-Colombia
	*/
	function getSqlSaldosBybodega($bodecodigos){
		return $this->gateway->getSqlSaldosBybodega($bodecodigos);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Retorna el sql que consulta los seriales en una bodega
	* @param string $bodecodigos 
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:25:28
	* @location Cali-Colombia
	*/
	function getSqlserialByBodega($bodecodigos){
		return $this->gateway->getSqlserialByBodega($bodecodigos);
	}	
   /**
    * @copyright Copyright 2004 &copy; FullEngine
	*
	*  retorna el sql que consulta los saldos de todas las bodegas
	* @param string $bodecodigos 
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:08:05
	* @location Cali-Colombia
	*/
	function getSqlAllSaldos(){
		return $this->gateway->getSqlAllSaldos();
	}	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Retorna el sql que consulta los seriales de todas las boegas
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:25:28
	* @location Cali-Colombia
	*/
	function getSqlAllserial(){
		return $this->gateway->getSqlAllserial();
	}	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los seriales de un recurso en una boega
	* @param $bodecodigos
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlserialByBodegaRecurso($bodecodigos,$recucodigos){
		return $this->gateway->getSqlserialByBodegaRecurso($bodecodigos,$recucodigos);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los seriales de un recurso en una boega
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlserialByRecurso($recucodigos){
		return $this->gateway->getSqlserialByRecurso($recucodigos);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los saldos de un recurso en una boega
	* @param $bodecodigos
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlSaldosBybodegaRecurso($bodecodigos,$recucodigos){
		return $this->gateway->getSqlSaldosBybodegaRecurso($bodecodigos,$recucodigos);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los saldos de un recurso en una boega
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlSaldosByRecurso($recucodigos){
		return $this->gateway->getSqlSaldosByRecurso($recucodigos);
	}
	function UnsetRequest() {
		unset ($_REQUEST["saldobodega__bodecodigos"]);
		unset ($_REQUEST["saldobodega__numrows"]);
		unset ($_REQUEST["saldobodega__resources"]);
		unset ($_REQUEST["saldobodega__resources_desc"]);
		unset ($_REQUEST["saldobodega__tirecodigos"]);
	}
}
?>