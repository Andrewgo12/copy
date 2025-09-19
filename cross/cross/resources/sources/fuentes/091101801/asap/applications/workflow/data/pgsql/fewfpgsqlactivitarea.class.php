<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlActivitarea {
	var $consult;
	var $objdb;
	function FeWFPgsqlActivitarea() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existActivitarea($tarecodigos, $acticodigos) {
		$sql = 'SELECT * FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas) {
		$sql = 'INSERT INTO "activitarea" ("tarecodigos","acticodigos","actavalorn","actaobligats","actaordenn","actaporcetan","actaactivas")'
		.' VALUES(\''.$tarecodigos.'\',\''.$acticodigos.'\','.$actavalorn.' ,\''.$actaobligats.'\','.$actaordenn.' ,'.$actaporcetan.' ,\''.$actaactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas) {
		$sql = 'UPDATE "activitarea" SET "actavalorn"='.$actavalorn.' ,"actaobligats"=\''.$actaobligats.'\',"actaordenn"='.$actaordenn.' ,"actaporcetan"='.$actaporcetan.' ,"actaactivas"=\''.$actaactivas.'\' WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteActivitarea($tarecodigos, $acticodigos) {
		$sql = 'DELETE FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdActivitarea($tarecodigos, $acticodigos) {
		$sql = 'SELECT * FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllActivitarea() {
		$sql = 'SELECT * FROM "activitarea"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActivitarea_fkey($tarecodigos) {
		$sql = 'SELECT * FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActivitarea_fkey1($acticodigos) {
		$sql = 'SELECT * FROM "activitarea" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTarecodigos($tarecodigos, $acticodigos) {
		$sql = 'SELECT "tarecodigos" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActicodigos($tarecodigos, $acticodigos) {
		$sql = 'SELECT "acticodigos" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActavalorn($tarecodigos, $acticodigos) {
		$sql = 'SELECT "actavalorn" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaobligats($tarecodigos, $acticodigos) {
		$sql = 'SELECT "actaobligats" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaordenn($tarecodigos, $acticodigos) {
		$sql = 'SELECT "actaordenn" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaporcetan($tarecodigos, $acticodigos) {
		$sql = 'SELECT "actaporcetan" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaactivas($tarecodigos, $acticodigos) {
		$sql = 'SELECT "actaactivas" FROM "activitarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Activitarea
?>