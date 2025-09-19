<?php  
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlMovimialmaceExtended {
	var $rcSql;
	var $rcGeneric;
	var $rcResources;
	var $objdb;
	function FeStPgsqlMovimialmaceExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Genera los sql del ingreso de movimientos y recursos seriados
	* @param array $rcGeneric Vector con los datos genericos de consulta
	* @param array $rcResources Vector con los datos de los recursos
	* @param integer $index Indice en donnde se inicia la secuancia de sql
	* @return array Arreglo con los sql generados
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 06-oct-2004 13:32:44
	* @location Cali-Colombia
	*/
	function getExecSqlMovimialmace($rcGeneric, $rcResources, $index) {
		$this->rcGeneric = $rcGeneric;
		$this->rcResources = $rcResources;
		$nuCont = 0;
		$nuContSer = 0;
		foreach ($rcResources as $rcRec) {
			//Movimialmace salida
			$rcMovi[$nuCont] = 'INSERT INTO "movimialmace" ("moalcodigos","bodecodigos","recucodigos","moalfechmovd","comocodigos","moalcantrecf","perscodigos","tidocodigos","moalnumedocs","moalsignos")'
			.' VALUES(\''.$index.'\',\''.$rcGeneric['bodecodigos_out'].'\',\''.$rcRec["recucodigos"].'\','.$rcGeneric["moalfechmovd"].',\''.$rcGeneric['comocodigos_out'].'\','.$rcRec["moalcantrecf"].',\''.$rcGeneric["perscodigos"].'\',\''.$rcGeneric["tidocodigos"].'\',\''.$rcGeneric["moalnumedocs"].'\',\'-\')';
			$nuCont ++;
			$index ++;
			//Movimialmace salida
			$rcMovi[$nuCont] = 'INSERT INTO "movimialmace" ("moalcodigos","bodecodigos","recucodigos","moalfechmovd","comocodigos","moalcantrecf","perscodigos","tidocodigos","moalnumedocs","moalsignos")'
			.' VALUES(\''.$index.'\',\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcRec["recucodigos"].'\','.$rcGeneric["moalfechmovd"].',\''.$rcGeneric['comocodigos_in'].'\','.$rcRec["moalcantrecf"].',\''.$rcGeneric["perscodigos"].'\',\''.$rcGeneric["tidocodigos"].'\',\''.$rcGeneric["moalnumedocs"].'\',\'+\')';
			$nuCont ++;
			$index ++;
			//Si los recursos son seriados
			if (is_array($rcRec["series"])) {
				foreach ($rcRec["series"] as $rcSer) {
					$nuReg = $rcSer["serial2"] - $rcSer["serial1"] + 1;
					if ($nuReg == 1) {
						$serial = $rcSer["prefix"].$rcSer["serial1"].$rcSer["suffix"];
						$rcMovi[$nuCont] = 'INSERT INTO "recuseribode" ("resbnumedocu","recucodigos","resbserirecu","resbbodeactu","resbbodeante","resbfechmovi","perscodigos")'
						.' VALUES (\''.$rcGeneric["moalnumedocs"].'\',\''.$rcRec["recucodigos"].'\',\''.$serial.'\',\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcGeneric['bodecodigos_out'].'\','.$rcGeneric["moalfechmovd"].',\''.$rcGeneric["perscodigos"].'\')';
						$nuCont ++;
					} else {
						for ($cont = 0; $cont < $nuReg; $cont ++) {
							$serial = $rcSer["prefix"].$rcSer["serial1"].$rcSer["suffix"];
							$rcSer["serial1"]++;
							$rcMovi[$nuCont] = 'INSERT INTO "recuseribode" ("resbnumedocu","recucodigos","resbserirecu","resbbodeactu","resbbodeante","resbfechmovi","perscodigos")'
							.' VALUES (\''.$rcGeneric["moalnumedocs"].'\',\''.$rcRec["recucodigos"].'\',\''.$serial.'\',\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcGeneric['bodecodigos_out'].'\','.$rcGeneric["moalfechmovd"].',\''.$rcGeneric["perscodigos"].'\')';
							$nuCont ++;
						}
					}
				}
			}
		}
		$this->rcSql = $rcMovi;
		//Ejecuta la transaccion
		return $this->execMovimianlmace();
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Valida, genera y ejecuta los movimientos de almacen en la base de datos
	* @return boolean
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 07-oct-2004 9:01:06
	* @location Cali-Colombia
	*/
	function execMovimianlmace() {
		//Trae los codigos de la bodegas no validadas en la salida
		$intWareHouse = Application :: getConstant("INTERNAL_WAREHOUSE");
		//Trae los datos de la bodega de salida
		$gateWay = Application :: getDataGateway("bodega");
		$rcBodegaOut = $gateWay->getByIdBodega($this->rcGeneric["bodecodigos_out"]);
		//$rcNoValidate = array ();
		//Inicia una transaccion
		$this->objdb->fncadobegintrans();
		//Bloquea las tablas de saldo y saldoserie
		$this->objdb->fncadolock("saldo,saldoserie");
		//Si la bodega de salida es interna la valida
		if ($rcBodegaOut[0]["tibocodigos"] == $intWareHouse) {
			//Trae los saldos de la bodega de salida
			$saldoSalida = $this->getSaldos($this->rcGeneric["bodecodigos_out"]);
			if (!$saldoSalida) {
				$this->objdb->fncadorollbacktrans();
				//Se�al 13 No hay recursos en la bodega de salida
				return 13;
			}
			//Genera los sql de actualizaci�n de saldos para la bodega de salida (RESTA) y valida existencias
			$rcSqlSalida = $this->getSqlSaldos($saldoSalida, $this->rcResources, $this->rcGeneric, false);
			if ($rcSqlSalida["fallo"]) {
				//Si no hay existencias
				$this->objdb->fncadorollbacktrans();
				return $rcSqlSalida;
			}
			//TRae los saldos de los recursos seriados de la bodega de salida
			$saldoSerieSalida = $this->getSaldosSerie($this->rcGeneric["bodecodigos_out"]);
			if (!$saldoSerieSalida) {
				$this->objdb->fncadorollbacktrans();
				//Se�al 13 No hay recursos en la bodega de salida
				return 13;
			}
			//Genera los Sql para los movimientos de los saldos de seriales
			$rcSqlSerie = $this->getSqlSerial($this->rcGeneric, $this->rcResources, $saldoSerieSalida);
			if($rcSqlSerie["fallo"]){
				//Si no existe el serial
				$this->objdb->fncadorollbacktrans();
				return $rcSqlSerie;
			}
		} else {
			//Genera los movimientos de recursos seriados para la bodega de entrada
			$rcSqlSerie = $this->getSqlSerial($this->rcGeneric, $this->rcResources);
		}
		//Trae los saldos de la bodega de antrada
		$saldoEntrada = $this->getSaldos($this->rcGeneric["bodecodigos_in"]);
		//Genera los sql de actualizaci�n de saldos para la bodega de entrada (SUMA)
		$rcSqlEntrada = $this->getSqlSaldos($saldoEntrada, $this->rcResources, $this->rcGeneric);

		//Ejecuta los sql en la base de datos
		//Sql de movimialmace 
		foreach($this->rcSql as $sql){
			$this->objdb->fncadoexecute($sql);
			if(!$this->objdb->objresult){
				$this->objdb->fncadorollbacktrans();
				//Retorna la se�al de error en la ejecucion en la base de datos
				return 14;
			}	
		}
		//Sql de actualizacion de salida de saldos
		if(is_array($rcSqlSalida)){
			foreach($rcSqlSalida as $sql){
				$this->objdb->fncadoexecute($sql);
				if(!$this->objdb->objresult){
					$this->objdb->fncadorollbacktrans();
					//Retorna la se�al de error en la ejecucion en la base de datos
					return 14;
				}	
			}
		}
		//Sql de Actualizacion de entradas de saldos
		if(is_array($rcSqlEntrada)){
			foreach($rcSqlEntrada as $sql){
				$this->objdb->fncadoexecute($sql);
				if(!$this->objdb->objresult){
					$this->objdb->fncadorollbacktrans();
					//Retorna la se�al de error en la ejecucion en la base de datos
					return 14;
				}	
			}
		}
		//Sql de actualizacion y/o grabado de saldos de seriales
		if(is_array($rcSqlSerie)){
			foreach($rcSqlSerie as $sql){
				$this->objdb->fncadoexecute($sql);
				if(!$this->objdb->objresult){
					$this->objdb->fncadorollbacktrans();
					//Retorna la se�al de error en la ejecucion en la base de datos
					return 17;
				}	
			}
		}
		//Elimina de sesion los datos del movimiento
		WebSession :: setProperty("genericData", $value=null);
		//Cierra la transaccion
		$this->objdb->fncadocommittrans();
		return 3;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Genera los Sql para los movimientos de los saldos de seriales
	* @param array $rcSaldoSerie Vector con los seriales de la bodega
	* @param array $rcGeneric Vector con los datos genericos del movimianto
	* @param array $rcResources Vector con los recursos del movimiento
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 07-oct-2004 14:51:16
	* @location Cali-Colombia
	*/
	function getSqlSerial($rcGeneric, $rcResources, $rcSaldoSerie = null) {
		$nuContSql = 0;
		$rcSql = null;
		if (is_array($rcSaldoSerie)) {
			//Se generan los sql con la velidaci�n de existencia
			foreach ($rcResources as $rcRec) {
				if (is_array($rcRec["series"])) {
					foreach ($rcRec["series"] as $rcSerials) {
						$cant = $rcSerials["serial2"] - $rcSerials["serial1"] + 1;
						if ($cant > 1) {
							//Cuando son varios
							for ($nuCont = 0; $nuCont < $cant; $nuCont ++) {
								$recSerial = $rcSerials["prefix"].$rcSerials["serial1"].$rcSerials["suffix"];
								$indice = (string) "{$rcRec["recucodigos"]}"."$recSerial";
								if($rcSaldoSerie[$indice]){
									$rcSql[$nuContSql] = 'UPDATE "saldoserie" SET "bodecodigos"=\''.$rcGeneric['bodecodigos_in'].'\',"sasefechregn"=\''.$rcGeneric["moalfechmovd"].'\' WHERE "recucodigos"=\''.$rcRec["recucodigos"].'\' AND "saserecseris"=\''.$recSerial.'\'';
									$nuContSql++;
								}else{
									//No existe el serial
										$rcNoSaldo["fallo"] = 15;
										$rcNoSaldo["msg"] = "{$rcRec["recucodigos"]} - {$rcRec["recunombres"]} ($recSerial)";
									return $rcNoSaldo;
								}
								$rcSerials["serial1"]++;
							}
						} else {
							//Cuando es solo un serial
							//Valida que el serial exista
							$recSerial = $rcSerials["prefix"].$rcSerials["serial1"].$rcSerials["suffix"];
							$indice = $rcRec["recucodigos"].$recSerial;
							if($rcSaldoSerie[$indice]){
								$rcSql[$nuContSql] = 'UPDATE "saldoserie" SET "bodecodigos"=\''.$rcGeneric['bodecodigos_in'].'\',"sasefechregn"=\''.$rcGeneric["moalfechmovd"].'\' WHERE "recucodigos"=\''.$rcRec["recucodigos"].'\' AND "saserecseris"=\''.$recSerial.'\'';
								$nuContSql++;
							}else{
								//No existe el serial
								$rcNoSaldo["fallo"] = 15;
								$rcNoSaldo["msg"] = "{$rcRec["recucodigos"]} - {$rcRec["recunombres"]} ($recSerial)";
								return $rcNoSaldo;
							}
						}
					}
				}
			}
		} else {
			//Se generan los insert a la bodega de entrada
			foreach ($rcResources as $rcRec){
				if (is_array($rcRec["series"])) {
					foreach ($rcRec["series"] as $rcSerials) {
						$cant = $rcSerials["serial2"] - $rcSerials["serial1"] + 1;
						if ($cant > 1){
							//Cuando son varios
							for ($nuCont = 0; $nuCont < $cant; $nuCont ++) {
								$recSerial = $rcSerials["prefix"].$rcSerials["serial1"].$rcSerials["suffix"];
								$rcSql[$nuContSql] = 'INSERT INTO "saldoserie" ("bodecodigos","recucodigos","saserecseris","sasefechregn")'
								.' VALUES(\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcRec["recucodigos"].'\',\''.$recSerial.'\','.$rcGeneric["moalfechmovd"].')';
								$nuContSql++;
								$rcSerials["serial1"]++;
							}
						}else{
							//Si es solo uno
							$recSerial = $rcSerials["prefix"].$rcSerials["serial1"].$rcSerials["suffix"];
							$rcSql[$nuContSql] = 'INSERT INTO "saldoserie" ("bodecodigos","recucodigos","saserecseris","sasefechregn")'
							.' VALUES(\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcRec["recucodigos"].'\',\''.$recSerial.'\','.$rcGeneric["moalfechmovd"].')';
							$nuContSql++;
						}
					}
				}
			}
		}
		return $rcSql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los recursos seriados que estan en una bodega indexados por la concatenacion de recurso serial 
	* @param datatype Name desc
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 07-oct-2004 13:52:30
	* @location Cali-Colombia
	*/
	function getSaldosSerie($bodecodigos, $recucodigos = null, $serial = null) {
		if (!$bodecodigos)
			return null;
		$whereRec = "";
		if ($recucodigos)
			$where = " \"saldoserie\".\"recucodigos\"='$recucodigos' AND ";
		if ($serial)
			$where .= " \"saldoserie\".\"saserecseris\"='$serial' AND ";
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
								'.$where.'
								"saldoserie"."bodecodigos"="bodega"."bodecodigos" AND
								"saldoserie"."recucodigos"="recurso"."recucodigos"
							ORDER BY
								"recurso"."recunombres"';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		$objtmp = $this->objdb->objresult;
		$nucont = 0;
		if (!$objtmp)
			return null;
		else
			while (!$objtmp->EOF) {
				$rcTmp = $objtmp->fields;
				$rcresult[$rcTmp["recucodigos"].$rcTmp["saserecseris"]] = $rcTmp;
				$objtmp->MoveNext();
			}

		return $rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Genera sql para actualizar los saldos
	* @param array $rcsaldo Vector con los saldos de una bodega
	* @param array $rcResources Vector con los recursos del movimiento
	* @param array $rcGenric Vector con los datos generales del registro
	* @param boolean $operation true para sumar saldo, false para restar saldos, por defecto esta en true
	* @return array cuando los saldos son adecuados
	* @return array $rcNoSaldo["estado"] = false
	* 							$rcNoSaldo["recurso"] = "recucodigos - recunombres"
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 07-oct-2004 11:43:02
	* @location Cali-Colombia
	*/
	function getSqlSaldos($rcsaldo, $rcResources, $rcGeneric, $operation = true) {
		$nuReg = 0;
		foreach ($rcResources as $rcTmp) {
			//Si se suma
			if ($operation == true) {
				if ($rcsaldo[$rcTmp["recucodigos"]]) {
					//Si existe el elemento en los saldos, lo suma
					$newSaldo = $rcsaldo[$rcTmp["recucodigos"]]["saldrecsaldn"] + $rcTmp["moalcantrecf"];
					$rcSql[$nuReg] = 'UPDATE "saldo" SET "saldrecsaldn"='.$newSaldo.',"saldfechregn"='.$rcGeneric["moalfechmovd"].',"saldnumdocs"=\''.$rcGeneric["moalnumedocs"].'\' WHERE "bodecodigos"=\''.$rcGeneric['bodecodigos_in'].'\' AND "recucodigos"=\''.$rcTmp["recucodigos"].'\'';
					$nuReg ++;
				} else {
					//Si no existe el elemento en los saldos, genera
					$rcSql[$nuReg] = 'INSERT INTO "saldo" ("bodecodigos","recucodigos","saldnumdocs","saldrecsaldn","saldfechregn")'
					.' VALUES(\''.$rcGeneric['bodecodigos_in'].'\',\''.$rcTmp["recucodigos"].'\',\''.$rcGeneric['"moalnumedocs"'].'\','.$rcTmp["moalcantrecf"].','.$rcGeneric["moalfechmovd"].')';
					$nuReg ++;
				}
			} else {
				//Si se resta, valida tambien la existencia de los recursos
				if ($rcsaldo[$rcTmp["recucodigos"]]) {
					//Si existe el elemento en los saldos, lo resta
					$newSaldo = $rcsaldo[$rcTmp["recucodigos"]]["saldrecsaldn"] - $rcTmp["moalcantrecf"];
					//Valida las existencias
					if ($newSaldo < 0) {
							//No hay saldo	
						$rcNoSaldo["fallo"] = 15;
						$rcNoSaldo["msg"] = "{$rcTmp["recucodigos"]} - {$rcTmp["recunombres"]}";
						return $rcNoSaldo;
					}
					if ($newSaldo == 0) {
						//Elimina el registro
						$rcSql[$nuReg] = 'DELETE "saldo" WHERE "bodecodigos"=\''.$rcGeneric['bodecodigos_in'].'\' AND "recucodigos"=\''.$rcTmp["recucodigos"].'\'';
						$nuReg ++;
					} else {
						//Actualiza el saldo
						$rcSql[$nuReg] = 'UPDATE "saldo" SET "saldrecsaldn"='.$newSaldo.',"saldfechregn"='.$rcGeneric["moalfechmovd"].' WHERE "bodecodigos"=\''.$rcGeneric['bodecodigos_out'].'\' AND "recucodigos"=\''.$rcTmp["recucodigos"].'\'';
						$nuReg ++;
					}
				} else {
					//No hay saldo
					$rcNoSaldo["fallo"] = 15;
					$rcNoSaldo["msg"] = "{$rcTmp["recucodigos"]} - {$rcTmp["recunombres"]}";
					return $rcNoSaldo;
				}
			}

		}
		return $rcSql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Trae los saldos de una bodega en una matriz indexada por el codigo del recurso
	* @param string $bodecodigos codigo de una bodega (opcional)
	* @param string $recucodigos codigo del recurso (opcional)
	* @return array Vector con los saldos de la bodega
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 07-oct-2004 10:09:21
	* @location Cali-Colombia
	*/
	function getSaldos($bodecodigos, $recucodigos = null) {
		if (!$bodecodigos)
			return null;
		$viewFields = '	"saldo"."bodecodigos",
										"bodega"."bodenombres",
										"saldo"."recucodigos",
										"recurso"."recunombres",
										"saldo"."saldnumdocs",
										"saldo"."saldrecsaldn",
										"saldo"."saldfechregn"';
		$where = "";
		if ($recucodigos)
			$where = " \"saldo\".\"recucodigos\"='$recucodigos' AND ";
		$sql = 'SELECT '.$viewFields.'
								FROM 
									"saldo","bodega","recurso" 
								WHERE
									"saldo"."bodecodigos"=\''.$bodecodigos.'\' AND
									'.$where.'
									"saldo"."bodecodigos"="bodega"."bodecodigos" AND
									"saldo"."recucodigos"="recurso"."recucodigos"
								ORDER BY
									"recurso"."recunombres"';

		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		$objtmp = $this->objdb->objresult;
		$nucont = 0;
		if (!$objtmp)
			return null;
		else
			while (!$objtmp->EOF) {
				$rcTmp = $objtmp->fields;
				$rcresult[$rcTmp["recucodigos"]] = $rcTmp;
				$objtmp->MoveNext();
			}
		return $rcresult;
	}
}
?>