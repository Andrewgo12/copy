<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlRutareglaExtended {
	var $connection;
	var $consult;
	var $objdb;
	function FeWFPgsqlRutareglaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
    /**
    * Copyright 2005 FullEngine
    * 
    * Consulta las reglas para cada tarea estado de la tabla de rutas 
    * @author freina<freina@parquesoft.com>
    * @param integer $nuRutacodigon Entero con el id de la ruta
    * @return array Arreglo con la data de las reglas o null
    * @date 04-Apr-2006 11:24:00
    * @location Cali-Colombia
    */
    function getByRutacodigon($nuRutacodigon){
		$sql = 'SELECT * FROM "rutaregla" WHERE "rutaregla"."rutacodigon" = '.$nuRutacodigon;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }

} //End of Class Ruta
?>