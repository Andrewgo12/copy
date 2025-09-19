<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeDoOci8SqlExtended {
	var $consult;
	var $objdb;
	var $sql;
	var $rcData;

	function FeDoOci8SqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function setData($rcData) {
		$this->rcData = $rcData;
	}

	function ingresarDocumento() {

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbQuery,"string");
		settype($sbStmt,"string");

		$sbQuery = "DECLARE ";
		$sbQuery .= "numb NUMBER(3); ";
		$sbQuery .= "texto VARCHAR2(300); ";
		$sbQuery .= "BEGIN ";
		$sbQuery .= "CREAR_DOCUMENTO('".$this->rcData["nmbre_srie"]."','".$this->rcData["nmbre_tpo_crpta"]."','".
		$this->rcData["nmbre_crpta"]."','".$this->rcData["nmbre_tpo_dcto"]."','','".$this->rcData["ext"]."','".
		$this->rcData["fncnrio"]."','','','','','','','','','','','','','','','','".$this->rcData["ordenumeros"]."',:bind1,:bind2,:bind3); ";
		$sbQuery .= "END;";

		$sbStmt = $this->objdb->fncadoprepare($sbQuery);
		$this->objdb->fncadoparameter($sbStmt,$codigo,'bind1',1);
		$this->objdb->fncadoparameter($sbStmt,$texto,'bind2',1);
		$this->objdb->fncadoparameter($sbStmt,$folder,'bind3',1);
		$this->objdb->objado->Execute($sbStmt);
		
		$rcResult["code"] = $codigo;
		$rcResult["status"] = $texto;
		$rcResult["folder"] = $folder;
		return $rcResult;
	}

	function showCarpetas() {
		$query = "SELECT * FROM carpeta";
		$this->objdb->fncadoexecute($query);
		return $this->objdb->objresult;
	}
}
?>