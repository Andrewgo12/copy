<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlReportes {
	var $objdb;
	function FeStPgsqlReportes() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  retorna el sql que consulta los saldos de una bodega
	* @param string $bodecodigos 
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:08:05
	* @location Cali-Colombia
	*/
	function getSqlSaldosBybodega($bodecodigos) {
		$sql = 'SELECT 
										"saldo"."bodecodigos",
										"bodega"."bodenombres",
										"saldo"."saldnumdocs",
										"recurso"."recunombres",
										"saldo"."recucodigos",
										"saldo"."saldrecsaldn",
										"unidadmedida"."unmesiglas",
										"saldo"."saldfechregn"
									FROM 
											"saldo","bodega","recurso","unidadmedida" 
										WHERE
											"saldo"."bodecodigos"=\''.$bodecodigos.'\' AND
											"saldo"."bodecodigos"="bodega"."bodecodigos" AND
											"saldo"."recucodigos"="recurso"."recucodigos" AND
											"recurso"."unmecodigos"="unidadmedida"."unmecodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Retorna el sql que consulta los seriales en una bodega
	* @param string $bodecodigos 
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:25:28
	* @location Cali-Colombia
	*/
	function getSqlserialByBodega($bodecodigos) {
		$sql = 'SELECT
										 "saldoserie"."bodecodigos",
										 "bodega"."bodenombres",
										 "saldoserie"."recucodigos",
										 "recurso"."recunombres",
										 "saldoserie"."saserecseris",
										 "saldoserie"."sasefechregn"
									FROM "saldoserie","bodega","recurso"
									WHERE
										"saldoserie"."bodecodigos"=\''.$bodecodigos.'\' AND
										"saldoserie"."bodecodigos"="bodega"."bodecodigos" AND
										"saldoserie"."recucodigos"="recurso"."recucodigos"';
		return $sql;
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  retorna el sql que consulta los saldos de todas las bodegas
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:08:05
	* @location Cali-Colombia
	*/
	function getSqlAllSaldos() {
		$sql = 'SELECT 
										"saldo"."bodecodigos",
										"bodega"."bodenombres",
										"saldo"."saldnumdocs",
										"recurso"."recunombres",
										"saldo"."recucodigos",
										"saldo"."saldrecsaldn",
										"unidadmedida"."unmesiglas",
										"saldo"."saldfechregn"
									FROM 
											"saldo","bodega","recurso","unidadmedida" 
										WHERE
											"saldo"."bodecodigos"="bodega"."bodecodigos" AND
											"saldo"."recucodigos"="recurso"."recucodigos" AND
											"recurso"."unmecodigos"="unidadmedida"."unmecodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Retorna el sql que consulta los seriales de todas las boegas
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-oct-2004 13:25:28
	* @location Cali-Colombia
	*/
	function getSqlAllserial() {
		$sql = 'SELECT
										 "saldoserie"."bodecodigos",
										 "bodega"."bodenombres",
										 "saldoserie"."recucodigos",
										 "recurso"."recunombres",
										 "saldoserie"."saserecseris",
										 "saldoserie"."sasefechregn"
									FROM "saldoserie","bodega","recurso"
									WHERE
										"saldoserie"."bodecodigos"="bodega"."bodecodigos" AND
										"saldoserie"."recucodigos"="recurso"."recucodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los seriales de un recurso en una boega
	* @param $bodecodigos
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlserialByBodegaRecurso($bodecodigos, $recucodigos) {
		$sql = 'SELECT
										 "saldoserie"."bodecodigos",
										 "bodega"."bodenombres",
										 "saldoserie"."recucodigos",
										 "recurso"."recunombres",
										 "saldoserie"."saserecseris",
										 "saldoserie"."sasefechregn"
									FROM "saldoserie","bodega","recurso"
									WHERE
										"saldoserie"."bodecodigos"=\''.$bodecodigos.'\' AND
										"saldoserie"."recucodigos"=\''.$recucodigos.'\' AND
										"saldoserie"."bodecodigos"="bodega"."bodecodigos" AND
										"saldoserie"."recucodigos"="recurso"."recucodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los seriales de un recurso en una boega
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlserialByRecurso($recucodigos) {
		$sql = 'SELECT
										 "saldoserie"."bodecodigos",
										 "bodega"."bodenombres",
										 "saldoserie"."recucodigos",
										 "recurso"."recunombres",
										 "saldoserie"."saserecseris",
										 "saldoserie"."sasefechregn"
									FROM "saldoserie","bodega","recurso"
									WHERE
										"saldoserie"."recucodigos"=\''.$recucodigos.'\' AND
										"saldoserie"."bodecodigos"="bodega"."bodecodigos" AND
										"saldoserie"."recucodigos"="recurso"."recucodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los saldos de un recurso en una boega
	* @param $bodecodigos
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlSaldosBybodegaRecurso($bodecodigos, $recucodigos) {
		$sql = 'SELECT 
										"saldo"."bodecodigos",
										"bodega"."bodenombres",
										"saldo"."saldnumdocs",
										"recurso"."recunombres",
										"saldo"."recucodigos",
										"saldo"."saldrecsaldn",
										"unidadmedida"."unmesiglas",
										"saldo"."saldfechregn"
									FROM 
											"saldo","bodega","recurso","unidadmedida" 
										WHERE
											"saldo"."bodecodigos"=\''.$bodecodigos.'\' AND
											"saldo"."recucodigos"=\''.$recucodigos.'\' AND
											"saldo"."bodecodigos"="bodega"."bodecodigos" AND
											"saldo"."recucodigos"="recurso"."recucodigos" AND
											"recurso"."unmecodigos"="unidadmedida"."unmecodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta los saldos de un recurso en todas las bodegas
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getSqlSaldosByRecurso($recucodigos) {
		$sql = 'SELECT 
										"saldo"."bodecodigos",
										"bodega"."bodenombres",
										"saldo"."saldnumdocs",
										"recurso"."recunombres",
										"saldo"."recucodigos",
										"saldo"."saldrecsaldn",
										"unidadmedida"."unmesiglas",
										"saldo"."saldfechregn"
									FROM 
											"saldo","bodega","recurso","unidadmedida" 
										WHERE
											"saldo"."recucodigos"=\''.$recucodigos.'\' AND
											"saldo"."bodecodigos"="bodega"."bodecodigos" AND
											"saldo"."recucodigos"="recurso"."recucodigos" AND
											"recurso"."unmecodigos"="unidadmedida"."unmecodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta Los movimientos de almacen
	* @param $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-oct-2004 09:45:28
	* @location Cali-Colombia
	*/
	function getMovimialmace($moalfechmovd1, $moalfechmovd2, $moalnumedocs = null, $bodecodigos = null, $recucodigos = null) {

		if ($moalnumedocs)
			$moalnumedocs = " \"movimialmace\".\"moalnumedocs\"='$moalnumedocs' AND ";
		if ($bodecodigos)
			$bodecodigos = " \"movimialmace\".\"bodecodigos\"='$bodecodigos' AND ";
		if ($recucodigos)
			$recucodigos = " \"movimialmace\".\"recucodigos\"='$recucodigos' AND ";

		$sql = 'SELECT 
							"movimialmace"."moalnumedocs",
							"tipodocument"."tidonombres" AS "tidocodigos",
							"movimialmace"."moalfechmovd",
							"movimialmace"."moalsignos",
							"bodega"."bodenombres" AS "bodecodigos",
							"concepmovimi"."comonombres" AS "comocodigos",
							"recurso"."recunombres" AS "recucodigos",
							"movimialmace"."moalcantrecf",
							"unidadmedida"."unmesiglas",
							"movimialmace"."perscodigos"
						FROM
							"movimialmace","tipodocument","bodega","concepmovimi","recurso","unidadmedida"
						WHERE 
							"movimialmace"."moalfechmovd" BETWEEN '.$moalfechmovd1.' AND '.$moalfechmovd2.' AND
							'.$moalnumedocs.$bodecodigos.$recucodigos.'
							"movimialmace"."tidocodigos"="tipodocument"."tidocodigos" AND
							"movimialmace"."bodecodigos"="bodega"."bodecodigos" AND
							"movimialmace"."comocodigos"="concepmovimi"."comocodigos" AND
							"movimialmace"."recucodigos"="recurso"."recucodigos" AND
							"recurso"."unmecodigos"="unidadmedida"."unmecodigos"';
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Retorna el sql que consulta con el track de un serial
	* @param string $serial 
	* @param string $recucodigos
	* @return string sql
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-oct-2004 12:16:06
	* @location Cali-Colombia
	*/
	function getSqlTrackSerial($serial, $recucodigos = null) {
		if ($recucodigos)
			$recucodigos = " \"recuseribode\".\"recucodigos\"='$recucodigos' AND ";
		$sql = 'SELECT
						 "recuseribode"."resbnumedocu",
						 "recurso"."recunombres" AS "recucodigos",
						 "recuseribode"."resbserirecu",
						 "bodega"."bodenombres",
						 "recuseribode"."resbfechmovi",
						 "recuseribode"."perscodigos"
					FROM 
						"recuseribode","recurso","bodega"
					WHERE
						"recuseribode"."resbserirecu"=\''.$serial.'\' AND
						'.$recucodigos.'
						"recuseribode"."recucodigos"="recurso"."recucodigos" AND
						"recuseribode"."resbbodeactu"="bodega"."bodecodigos"';
			return $sql;
	}

}
?>