<?php

//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlModeloresp
{
	var $consult;
	var $objdb;

	function FeEnPgsqlModeloresp()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existModeloresp($morecodigon)
	{
		$sql = 'SELECT * FROM "modeloresp" WHERE "morecodigon"='.$morecodigon;
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addModeloresp($morecodigon,$morenombres,$moredescrips)
	{
		$sql = 'INSERT INTO "modeloresp" ("morecodigon","morenombres","moredescrips") VALUES('.$morecodigon.',\''.$morenombres.'\',\''.$moredescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateModeloresp($morecodigon,$morenombres,$moredescrips)
	{
		$sql='UPDATE "modeloresp" SET "morenombres"=\''.$morenombres.'\',"moredescrips"=\''.$moredescrips.'\' WHERE "morecodigon"='.$morecodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteModeloresp($morecodigon)
	{
		$sql='DELETE FROM "modeloresp" WHERE "morecodigon"='.$morecodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdModeloresp($morecodigon)
	{
		$sql='SELECT * FROM "modeloresp" WHERE "morecodigon"='.$morecodigon;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllModeloresp()
	{
		$sql='SELECT * FROM "modeloresp"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Modeloresp
?>