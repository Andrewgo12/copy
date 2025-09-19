<?php
include_once("pkdatabases.php");
class FeCuPgsqlCencoclientes{
	var $connection;
	var $consult;
	var $objdb;
	function FeCuPgsqlCencoclientes()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function fncBuscarContrato($sbcontrato,$sbcodcliente)
	{
		if($sbcontrato && $sbcodcliente){
			$sbSql = 'SELECT *
					  FROM "contrato"
					  WHERE "contrato"."contnics"=\''.$sbcontrato.'\' 
			                AND "contrato"."cliecodigos"=\''.$sbcodcliente.'\'';
		}
		elseif($sbcontrato && !$sbcodcliente){
			$sbSql = 'SELECT *
					  FROM "contrato"
					  WHERE "contrato"."contnics"=\''.$sbcontrato.'\'';
		}
		elseif(!$sbcontrato && $sbcodcliente){
			$sbSql = 'SELECT *
					  FROM "contrato"
					  WHERE "contrato"."cliecodigos"=\''.$sbcodcliente.'\'';
		}
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function fncBuscarClientes($sbcodcliente,$sbnomcliente)
	{
		if($sbcodcliente && $sbnomcliente){
			$sbSql = 'SELECT *
					  FROM
					  WHERE "cliente"."clieidentifs"=\''.$sbcodcliente.'\'
							AND "cliente"."clienombres"=\''.$sbnomcliente.'\'';
		}
		elseif($sbcodcliente && !$sbnomcliente){
			$sbSql = 'SELECT *
					  FROM "cliente"
					  WHERE "cliente"."clieidentifs"=\''.$sbcodcliente.'\'';
		}
		elseif(!$sbcodcliente && $sbnomcliente){
			$sbSql = 'SELECT *
					  FROM "cliente"
					  WHERE "cliente"."clienombres"=\''.$sbnomcliente.'\'';
		}
		//print $sbSql;
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function fncBuscarOrdenes($sbcodorden,$sbcontrato)
	{
		if($sbcontrato && $sbcodorden)
		{
			$sbSql = 'SELECT *
					  FROM "orden","ordenempresa"
					  WHERE "orden"."ordenumeros"=\''.$sbcodorden.'\'
							AND "ordenempresa"."contnics"=\''.$sbcontrato.'\'
							AND "orden"."ordenumeros" = "ordenempresa"."ordenumeros"';
		}
		elseif(!$sbcontrato && $sbcodorden)
		{
			$sbSql = 'SELECT *
					  FROM "orden","ordenempresa"
					  WHERE "orden"."ordenumeros"=\''.$sbcodorden.'\'
							AND "orden"."ordenumeros" = "ordenempresa"."ordenumeros"';
		}
		elseif($sbcontrato && !$sbcodorden)
		{
			$sbSql = 'SELECT *
					  FROM "orden","ordenempresa"
					  WHERE "ordenempresa"."contnics"=\''.$sbcontrato.'\'
							AND "orden"."ordenumeros" = "ordenempresa"."ordenumeros"';
		}
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function fncBuscarProducto($sbcodproducto)
	{
		if($sbcodproducto){
			$sbSql = 'SELECT *
					  FROM "producto"
					  WHERE "producto"."prodcodigos" =\''.$sbcodproducto.'\'';
		}
		$this->objdb->fncadoexecute($sbSql,FETCH_ASSOC);
		return $this->objdb->fncadorowcont();
	}
	function fncBuscarContratoProducto($sbContrato)
	{
		$sbSql = 'SELECT *
				  FROM "contratoprod" 
				  WHERE "contratoprod"."contnics" =\''.$sbContrato.'\'';
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>