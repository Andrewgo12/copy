<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlRecuseribode {
	var $consult;
	var $objdb;
	function FeStPgsqlRecuseribode() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function addRecuseribode($resbnumedocu, $recucodigos, $resbserirecu, $resbbodeactu, $resbbodeante, $resbfechmovi, $perscodigos) {
		$sql = 'INSERT INTO "recuseribode" ("resbnumedocu","recucodigos","resbserirecu","resbbodeactu","resbbodeante","resbfechmovi","perscodigos")'
		.' VALUES(\''.$resbnumedocu.'\',\''.$recucodigos.'\',\''.$resbserirecu.'\',\''.$resbbodeactu.'\',\''.$resbbodeante.'\','.$resbfechmovi.' ,\''.$perscodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	
	function getAllRecuseribode() {
		$sql = 'SELECT * FROM "recuseribode"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRecuseribode_fkey($recucodigos) {
		$sql = 'SELECT * FROM "recuseribode" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
} //End of Class Recuseribode
?>