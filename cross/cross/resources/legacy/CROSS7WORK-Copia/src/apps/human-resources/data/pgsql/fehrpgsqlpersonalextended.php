<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlPersonalExtended {
    function FeHrPgsqlPersonalExtended() {
 		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
    }
    	/**
	Copyright 2004 � FullEngine
	 Consulta los datos de un personal a partir del nombre de usuario
	@param string $userName Nombre de usuario
	@return array 
	@author creyes <cesar.reyes@parquesoft.com>
	@date 09-sep-2004 13:43:06
	@location Cali - Colombia
	*/
	function getByPersusrnams($userName) {
		$sql = 'SELECT * FROM "personal" WHERE "persusrnams"=\''.$userName.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta todo el personal activo 
	* @return array
	* @author freina<freinas@parquesoft.com>
	* @date 24-Nov-2004 15:15
	* @location Cali-Colombia
	*/
	function getAllActivePersonal() {
		
		settype($rctmp, "array");
		settype($sbtmp, "string");
		settype($sbsql, "string");
		
		$sbestado = Application :: getConstant("REG_ACT");
		$sbsql = 'SELECT * FROM "personal" WHERE "persestadoc"=\''.$sbestado.'\' order by "persnombres"';
		
		$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta si un empleado ya tiene el numero de identificacion
	* @param string $sbPersidentifs Cadena con la identificacion del empleado
	* @return array
	* @author freina<freinas@parquesoft.com>
	* @date 16-Jan-2007 14:24
	* @location Cali-Colombia
	*/
	function existPersonal($sbPersidentifs) {
		$sql = 'SELECT * FROM "personal" WHERE "persidentifs"=\''.$sbPersidentifs.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el registro del empleado con la identificacion pasada como parametro
	* @param string $sbPersidentifs Cadena con la identificacion del empleado
	* @return array
	* @author freina<freinas@parquesoft.com>
	* @date 16-Jan-2007 14:24
	* @location Cali-Colombia
	*/
	function getByIdPersonal($sbPersidentifs) {
		$sql = 'SELECT * FROM "personal" WHERE "persidentifs"=\''.$sbPersidentifs.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta si un usuario del sistema ya esta relacionado a un empleado
	* @param string $sbPersusrnams Cadena con el nick del usuario
	* @return array
	* @author freina<freinas@parquesoft.com>
	* @date 22-Jan-2007 17:10
	* @location Cali-Colombia
	*/
	function existPersonalByPersusrnams($sbPersusrnams) {
		settype($sbSql,"string");
		$sbSql = 'SELECT * FROM "personal" WHERE "persusrnams"=\''.$sbPersusrnams.'\'';
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
		/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el registro del empleado con la identificacion pasada como parametro
	* @param string $sbPersidentifs Cadena con la identificacion del empleado
	* @return array
	* @author freina<freinas@parquesoft.com>
	* @date 16-Jan-2007 14:24
	* @location Cali-Colombia
	*/
	function getByUsernamePersonal($rcusername) {
		if(is_array($rcusername))
			$sql = 'SELECT * FROM "personal" WHERE "perscodigos" IN('.join(",",$rcusername).')';
		else
			$sql = 'SELECT * FROM "personal" WHERE "perscodigos"='.$rcusername;
		$sql .= ' AND "persusrnams" IS NOT NULL ORDER BY "persnombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>