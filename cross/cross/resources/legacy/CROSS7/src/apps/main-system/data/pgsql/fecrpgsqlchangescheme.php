<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlChangeScheme {
	
	function FeCrPgsqlChangeScheme() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->tableSpace = $this->objdb->tableSpace;
		$this->objdb->tableSpace="cross300";
		$this->objdb->setDbParams(); 
	}
	
	/**
    * Copyright 2005 FullEngine
    *
    * Determina cuantos tipos de caso existen con el contexto pasado como parametro
    * @author freina<freina@parquesoft.com>
    * @param integer $nuSchecodigon entero con el id del contexto
    * @return integer
    * @date 22-Mar-2006 12:36
    * @location Cali-Colombia
    */
	function amountTipoordenBySchecodigon($nuSchecodigon){
		settype($nuCant,"integer");
		$sql = 'SELECT * FROM "tipoorden" WHERE "schecodigon"=\''.$nuSchecodigon.'\'';
    	$this->objdb->fncadoexecute($sql);
    	$nuCant=$this->objdb->fncadorowcont();
    	$this->close();
    	return $nuCant;
    }
	
	function close() {
		$this->objdb->tableSpace=$this->tableSpace;
		$this->objdb->setDbParams(); 
	}
} //End of Class Tipoorden
?>