<?php
class FeCrOrden_logManager {
	var $gatewayo;
	var $gatewayoe;
	var $gatewayse;
	var $objdate;
	var $objnumerador;

	function FeCrOrden_logManager() {
		$this->gatewayo = Application :: getDataGateway("orden_logExtended");
		$this->gatewayoe = Application :: getDataGateway("ordenempresa_logExtended");
		$this->gatewayse = Application :: getDataGateway("SqlExtended");
		$this->objdate = Application :: loadServices("DateController");
		$this->objnumerador = Application :: getDomainController("NumeradorManager");
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea los sql para el ingreso en la tabla de log de orden
	*   @author freina
	*	@param array $ircdata (Arreglo con los sql)
	*	@param string $isbusuacodigos (Codigo del usuario quien realiza la operacion)
	*	@param string $isbsql (Indica el tipo de sql)
	*	@return array $orcresult (Arreglo con los sql o null)
	*   @date 10-Oct-2004 10:53
	*   @location Cali-Colombia
	*/
	function addOrden_logSql($ircdata, $isbusuacodigos, $isbsql) {

		settype($objdatet, "object");
		settype($orcresult, "array");
		settype($rctmpk, "array");
		settype($rctmp, "array");
		settype($rctmpo, "array");
		settype($rctmpoe, "array");
		settype($sbTmp, "string");
		settype($sbtmpo, "string");
		settype($sbtmpoe, "string");
		settype($nufechahora, "integer");
		settype($nuindex, "integer");

		if ($ircdata) {

			//servicio de fechas
			$nufechahora = $this->objdate->fncintdatehour();
			$nuindex = $this->objnumerador->fncgetByIdNumerador("orden_log");

			//Determina el tipo de operacion
			switch ($isbsql) {
				case "1" :
					//insert
					$sbTmp = $this->fncparse_insert($ircdata[0]);
					$sbtmpo = $this->gatewayo->addOrden_logSqlEsp($nuindex, $isbusuacodigos, $nufechahora, $sbTmp);
					$sbTmp = $this->fncparse_insert($ircdata[1]);
					$sbtmpoe = $this->gatewayoe->addOrdenempresa_logSqlEsp($nuindex, $sbTmp);
					if ($sbtmpo && $sbtmpoe) {
						$orcresult[0] = $sbtmpo;
						$orcresult[1] = $sbtmpoe;
					}
					break;
				case "2" :
					//update
					$rctmp = $this->gatewayse->fncmetadata('orden');
					$rctmpo = $this->fncparse_update($rctmp, $ircdata[0], 'orden');
					$sbtmpo = $this->gatewayo->addOrden_logSql($nuindex, $isbusuacodigos, $nufechahora, $rctmpo);
					$rctmp = $this->gatewayse->fncmetadata('ordenempresa');
					$rctmpoe = $this->fncparse_update($rctmp, $ircdata[1], 'ordenempresa');
					unset($rctmpoe["contidentis"]);
					unset($rctmpoe["infrcodigos"]);
					$rctmpoe["contidentis"] = $this->findValue($ircdata[1],"contidentis");
					$rctmpoe["infrcodigos"] = $this->findValue($ircdata[1],"infrcodigos");
					$sbtmpoe = $this->gatewayoe->addOrdenempresa_logSql($nuindex, $rctmpoe);
					if ($sbtmpo && $sbtmpoe) {
						$orcresult[0] = $sbtmpo;
						$orcresult[1] = $sbtmpoe;
					}
					break;
				default :
					}
		}
		return $orcresult;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Toma una cadena con un sql insert y extrae los datos
	*   @author freina
	*	@param string $isbcadena (SQl con el insert)
	*	@return array $orcresult (Arreglo con la data)
	*   @date 10-Oct-2004 10:53
	*   @location Cali-Colombia
	*/
	function fncparse_insert($isbcadena) {

		settype($osbtmp, "string");
		settype($sbposini, "string");
		settype($sbposfin, "string");

		if ($isbcadena) {
			$sbposini = strpos($isbcadena, "VALUES(");
			$sbposfin = strrpos($isbcadena, ")");
			if (!($sbposini === false) && !($sbposfin === false)) {
				$osbtmp = substr($isbcadena, $sbposini +7, ($sbposfin - ($sbposini +7)));
			}
		}
		return $osbtmp;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Toma una cadena con un sql update y extrae los datos
	*   @author freina
	*	@param array $ircdata (Arreglo con la estructura de la tabla)
	*	@param string $isbcadena (SQl con el insert)
	*@param string $isbTable Cadena con el nombre de la tabla
	*	@return array $orcresult (Arreglo con la data)
	*   @date 10-Oct-2004 10:53
	*   @location Cali-Colombia
	*/
	function fncparse_update($ircdata, $isbcadena, $isbTable = '') {
		settype($orcresult, "array");
		settype($rcPrimaryKey, "array");
		settype($rcKeys, "array");
		settype($objtmp, "object");
		settype($sbtmp, "string");
		settype($sbtmpv, "string");
		settype($sbposini, "string");
		settype($sbposfin, "string");
		settype($sbpossigno, "string");
		settype($sbCadena, "string");
		settype($sbindex, "string");
		settype($sbFieldName, "string");
		settype($nuCont, "integer");

		if ($isbcadena) {
			$sbposini = strpos($isbcadena, "SET");
			$sbposfin = strpos($isbcadena, "WHERE");
			$rcKeys = array_keys($ircdata);
			if (!($sbposini === false) && !($sbposfin === false)) {
				//se obtiene la llave de la tabla
				$rcPrimaryKey = $this->gatewayse->fncMetaPrimayKey($isbTable);
				$sbtmp = substr($isbcadena, $sbposini +4, ($sbposfin - ($sbposini +4)));
				
				foreach ($ircdata as $sbindex => $objtmp) {

					if (!(in_array($objtmp->name, $rcPrimaryKey))) {
						
						$sbposini = strpos($sbtmp, strtolower($sbindex));

						if (!($sbposini === false)) {

							//se debe ubicar el sgte nombre de campo
							foreach ($rcKeys as $nuCont => $sbFieldName) {
								if (strtolower($sbFieldName) == strtolower($sbindex)) {
									break;
								}
							}
							
							//con la posicion se evalua si el sgte campo existe
							do {
								$nuCont ++;
								if($rcKeys[$nuCont]){
									$sbposfin = strpos($sbtmp, strtolower($rcKeys[$nuCont]));
									if (!($sbposfin === false)) {
										break;
									}
								}else{
									$sbposfin = false;
									break;
								}
								
							} while ($nuCont < sizeof($rcKeys));

							if (!($sbposfin === false)) {
								$sbposfin -= 2;
							} else {
								$sbposfin = strlen($sbtmp);
							}
							
							if (!($sbposini === false) && !($sbposfin === false) 
							&& ($sbposini >= 0) && ($sbposfin >= 0)) {
								$sbCadena = trim(substr($sbtmp, $sbposini, 
								($sbposfin - $sbposini)));
							}
							
							if ($sbCadena) {
								$sbpossigno = strpos($sbCadena, "=");
								if (!($sbpossigno === false)) {
									$sbtmpv = trim(substr($sbCadena, $sbpossigno +1));
								} else {
								$sbtmpv = "";
								}
								$orcresult[$objtmp->name] = $sbtmpv;
							}
						}

						unset ($sbCadena);
					} else {
						$sbpossigno = strrpos($isbcadena, "=");
						if (!($sbpossigno === false)) {
							$sbtmpv = trim(substr($isbcadena, $sbpossigno +1));
						} else {
							$sbtmpv = "";
						}
						$orcresult[$objtmp->name] = $sbtmpv;
					}
				}
			}
		}
		return $orcresult;
	}

	function addOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		if ($this->gatewayo->existOrden_log($orlonumeron) == 0) {
			$this->gatewayo->addOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		if ($this->gatewayo->existOrden_log($orlonumeron) == 1) {
			$this->gatewayo->updateOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteOrden_log($orlonumeron) {
		if ($this->gatewayo->existOrden_log($orlonumeron) == 1) {
			$this->gatewayo->deleteOrden_log($orlonumeron);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdOrden_log($orlonumeron) {
		$data_orden_log = $this->gatewayo->getByIdOrden_log($orlonumeron);
		return $data_orden_log;
	}

	function getAllOrden_log() {
		//$this->gatewayo->
	}

	function UnsetRequest() {
		unset ($_REQUEST["orden_log__orlonumeron"]);
		unset ($_REQUEST["orden_log__orlofecingd"]);
		unset ($_REQUEST["orden_log__ordenumeros"]);
		unset ($_REQUEST["orden_log__proccodigos"]);
		unset ($_REQUEST["orden_log__ordesitiejes"]);
		unset ($_REQUEST["orden_log__usuacodigos"]);
		unset ($_REQUEST["orden_log__ordeestaacs"]);
		unset ($_REQUEST["orden_log__ordeobservs"]);
		unset ($_REQUEST["orden_log__ordefecingd"]);
		unset ($_REQUEST["orden_log__ordefecregd"]);
		unset ($_REQUEST["orden_log__ordefecvend"]);
		unset ($_REQUEST["orden_log__ordefecfinad"]);
		unset ($_REQUEST["orden_log__ordefecentn"]);
	}
	
	function findValue($sbData,$sbField)
	{
		if(strpos($sbData,$sbField)!==false)
		{
			$rcPart = explode($sbField,$sbData);
			if(array_key_exists(1,$rcPart))
			{
				if(strpos($rcPart[1],"=")!==false)
				{
					$rcPart = explode("=",$rcPart[1]);
					if(array_key_exists(1,$rcPart))
					{
						if(strpos($rcPart[1],",")!==false)
						{
							$rcPart = explode(",",$rcPart[1]);
							return $rcPart[0];
						}
						else 
						{
							return $rcPart[1];
						}
					}
				}
			}
		}
	}
}
?>