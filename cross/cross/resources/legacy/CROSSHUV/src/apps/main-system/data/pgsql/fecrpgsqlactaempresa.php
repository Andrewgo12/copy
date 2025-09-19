<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlActaempresa {
	var $consult;
	var $objdb;
	function FeCrPgsqlActaempresa() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existActaempresa($actacodigos, $acemnumeros) {
		$sql = 'SELECT * FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addActaempresa($actacodigos, $acemnumeros, $esaccodigos, $acemfeccren, 
	$acemfecaten, $acemhorainn, $acemhorafin, $orgacodigos, $acemusuars,$acemobservas,
	$acemusumods, $acemradicas) {
		settype($sbDbNull, "string");
		settype($sbSql, "string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if($acemusumods && $acemusumods != $sbDbNull){
			$acemusumods = "'".$acemusumods."'";
		}
		if($acemradicas && $acemradicas != $sbDbNull){
			$acemradicas = "'".$acemradicas."'";
		}
		$sbSql = 'INSERT INTO "actaempresa" ("actacodigos","acemnumeros",' .
		'"esaccodigos","acemfeccren","acemfecaten","acemhorainn","acemhorafin",' .
		'"orgacodigos","acemusuars","acemobservas","acemusumods","acemradicas")'
		.' VALUES(\''.$actacodigos.'\',\''.$acemnumeros.'\',\''.$esaccodigos.'\','.
		$acemfeccren.' ,'.$acemfecaten.' ,'.$acemhorainn.' ,'.$acemhorafin.' ,\''.
		$orgacodigos.'\',\''.$acemusuars.'\',\''.$acemobservas.'\','.$acemusumods.','.$acemradicas.')';
		
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateActaempresa($actacodigos, $acemnumeros, $esaccodigos, $acemfeccren, $acemfecaten, $acemhorainn, $acemhorafin, $acemobservas,$acemusumods) {
		settype($sbDbNull, "string");
		settype($sbSql, "string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if($acemusumods && $acemusumods != $sbDbNull){
			$acemusumods = "'".$acemusumods."'";
		}
		$sbSql = 'UPDATE "actaempresa" SET "esaccodigos"=\''.$esaccodigos.'\',"acemfeccren"='.$acemfeccren.' ,"acemfecaten"='.$acemfecaten.' ,"acemhorainn"='.$acemhorainn.' ,"acemhorafin"='.$acemhorafin.' ,"acemobservas"=\''.$acemobservas.'\',"acemusumods"='.$acemusumods.' WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteActaempresa($actacodigos, $acemnumeros) {
		$sql = 'DELETE FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdActaempresa($actacodigos, $acemnumeros) {
		$sql = 'SELECT * FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllActaempresa() {
		$sql = 'SELECT * FROM "actaempresa"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActaempresa_fkey($actacodigos) {
		$sql = 'SELECT * FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActaempresa_fkey1($esaccodigos) {
		$sql = 'SELECT * FROM "actaempresa" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActacodigos($actacodigos, $acemnumeros) {
		$sql = 'SELECT "actacodigos" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemnumeros($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemnumeros" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsaccodigos($actacodigos, $acemnumeros) {
		$sql = 'SELECT "esaccodigos" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemfeccren($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemfeccren" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemfecaten($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemfecaten" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemhorainn($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemhorainn" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemhorafin($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemhorafin" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAcemobservas($actacodigos, $acemnumeros) {
		$sql = 'SELECT "acemobservas" FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos.'\' AND "acemnumeros"=\''.$acemnumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Actaempresa
?>