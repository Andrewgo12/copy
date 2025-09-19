<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlTema
{
	var $consult;
	var $objdb;

	function FeEnPgsqlTema()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existTema($temacodigon)
	{
		$sql = 'SELECT * FROM "tema" WHERE "temacodigon"='.$temacodigon;
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addTema($temacodigon,$ejtecodigon,$temanombres,$temadescrips)
	{
		$sql='INSERT INTO "tema" ("temacodigon","ejtecodigon","temanombres","temadescrips") VALUES(\''.$temacodigon.'\',\''.$ejtecodigon.'\',\''.$temanombres.'\',\''.$temadescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescrips)
	{
		$sql='UPDATE "tema" SET "temanombres"=\''.$temanombres.'\',"temadescrips"=\''.$temadescrips.'\',"ejtecodigon"='.$ejtecodigon.' WHERE "temacodigon"='.$temacodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteTema($temacodigon)
	{
		$sql='DELETE FROM "tema" WHERE "temacodigon"='.$temacodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdTema($temacodigon)
	{
		$sql='SELECT * FROM "tema" WHERE "temacodigon"='.$temacodigon;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByIdEjetematico($ejtecodigon){
		$sql='SELECT * FROM "tema" WHERE "ejtecodigon"='.$ejtecodigon;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllTema()
	{
		$sql='SELECT * FROM "tema"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tema
?>