<?php              
class FeHrGrupoManager {
	var $gateway;
	var $gatewayex;
	var $gatewaydetalle;
	var $gatewaydetalleext;
	var $gatewaynumeradorextended;
	var $constantes;
	var $gatewayorganizacionextended;

	function FeHrGrupoManager() {
		$this->gateway = Application :: getDataGateway("grupo");
		$this->gatewayex = Application :: getDataGateway("grupoExtended");
		$this->gatewaydetalle = Application :: getDataGateway("grupodetalle");
		$this->gatewaydetalleext = Application :: getDataGateway("grupodetalleExtended");
		$this->gatewaynumeradorextended = Application :: getDataGateway("NumeradorExtended");
		$this->gatewayorganizacionextended = Application :: getDataGateway("organizacionExtended");
	}

	function addGrupo($grupcodigos, $grupnombres, $esgrcodigos) {

		settype($rcsql, "array");
		settype($rctmp, "array");
		settype($rcvalue, "array");
		settype($nucont, "integer");

		if ($this->gatewayex->existGrupo($grupcodigos) == 0) {

			//Consulto el numerador para la llave
			$nuCodGrupo = $this->gatewaynumeradorextended->getByIdNumeradorTrans('codgrupo');
			//Carga el sevicio de Fechas
			$dateService = Application :: loadServices("DateController");
			//Calculamos la fecha de ini
			$grupfchafinn = Application :: getConstant("DB_NULL");
			$grupfchainin = $dateService->fncintdatehour();
			$rcsql[0] = $this->gatewayex->addSqlGrupo($nuCodGrupo, $grupcodigos, $grupnombres, $esgrcodigos, $grupfchainin, $grupfchafinn);

			//si hay detalle de personal
			if (WebSession :: issetProperty("Grupodetalle")) {
				$rctmp = WebSession :: getProperty("Grupodetalle");
				if ($rctmp) {
					// se obtienen los sql de ingreso
					foreach ($rctmp as $nucont => $rcvalue) {
						$rcsql[] = $this->gatewaydetalleext->addSqlGrupodetalle($nuCodGrupo, $rcvalue["perscodigos"], $rcvalue["persrespons"]);
					}
				}
                if(!$rctmp[0]){ //Si no existe personal asignado
                    return 17;
                }
			} else { //Si no existe personal asignado
                return 17;
            }
			if ($rcsql) {
				$this->gatewayex->GrupoTrans($rcsql);
				if ($this->gatewayex->consult) {
					$this->UnsetRequest();
					return 3;
				} else {
					return 100;
				}
			}
		} else {
			return 1;
		}
	}

	function updateGrupo($grupcodigon, $grupcodigos, $grupnombres, $esgrcodigos) {

		settype($rcsql, "array");
		settype($rcvalue, "array");
		settype($rctmp, "array");
		settype($rctmpg, "array");
		settype($sbresult, "string");
		settype($sbflag, "string");
		settype($sbestado, "string");
		settype($nucont, "integer");

		$sbflag = false;

		if ($this->gateway->existGrupo($grupcodigon) == 1) {

			//se obtien la data del grupo
			$rctmpg = $this->gateway->getByIdGrupo($grupcodigon);
			$grupcodigos = $rctmpg[0]["grupcodigos"];

			//lo siguinte es determinar si existe detalle
			if (WebSession :: issetProperty("Grupodetalle")) {
				$rctmp = WebSession :: getProperty("Grupodetalle");
				if ($rctmp) {
					//si existe detalle, se determina si ha cambiado
					$sbresult = $this->DetermineChangeDetail($grupcodigon, $rctmp);
					if ($sbresult) {
						//si hay cambio, se detrmina si ha tenido o tiene aluna relacion con un ente

						//Se busca que el grupo no este actualmente relacionado a un ente organizacional
						if ($this->gatewayorganizacionextended->existOrganizaciongrupo($grupcodigos) == 1) {
							$sbflag = true;
						}

						//Se busca que el grupo no haya estado relacionado a un ente organizacional
						$objtmp = Application :: loadServices("Cross300");
						if ($objtmp->DetermineRelationsGroup($grupcodigon)) {
							$sbflag = true;
						}

						//si el grupo esta relacioando
						if ($sbflag) {
							//se desactiva el registro anterior

							$sbestado = Application :: getConstant("REG_INACT");
							$rcsql[] = $this->gatewayex->updateSqlDeactivateGroup($grupcodigon, $sbestado);

							//Consulto el numerador para la llave
							$grupcodigon = $this->gatewaynumeradorextended->getByIdNumeradorTrans('codgrupo');
							$grupfchafinn = Application :: getConstant("DB_NULL");
							$rcsql[] = $this->gatewayex->addSqlGrupo($grupcodigon, $grupcodigos, $grupnombres, $esgrcodigos, $rctmpg[0]["grupfchainin"], $grupfchafinn);
						}

						$rcsql[] = $this->updateHeaderGrupo($grupcodigon, $grupnombres, $esgrcodigos);
						$rcsql[] = $this->gatewaydetalleext->deleteGrupodetalleByGrupcodigon($grupcodigon);
						foreach ($rctmp as $nucont => $rcvalue) {
							$rcsql[] = $this->gatewaydetalleext->addSqlGrupodetalle($grupcodigon, $rcvalue["perscodigos"], $rcvalue["persrespons"]);
						}

					} else {
						//si no hay cambio
						$rcsql[] = $this->updateHeaderGrupo($grupcodigon, $grupnombres, $esgrcodigos);
						$rcsql[] = $this->gatewaydetalleext->deleteGrupodetalleByGrupcodigon($grupcodigon);
						foreach ($rctmp as $nucont => $rcvalue) {
							$rcsql[] = $this->gatewaydetalleext->addSqlGrupodetalle($grupcodigon, $rcvalue["perscodigos"], $rcvalue["persrespons"]);
						}
					}
				} 
                //Si no existe el detalle
                if(!$rctmp[0]){
                    return 17;
                }
                
			} else {
				// si no existe detalle se puede realizar la modificacion de datos
				$rcsql[] = $this->updateHeaderGrupo($grupcodigon, $grupnombres, $esgrcodigos);
			}
			if ($rcsql) {
				$this->gatewayex->GrupoTrans($rcsql);
				if ($this->gatewayex->consult) {
					$this->UnsetRequest();
					return 3;
				} else {
					return 100;
				}
			}
		} else {
			return 2;
		}
	}

	function DetermineChangeDetail($inugrupcodigon, $ircdata) {

		settype($rctmp, "array");
		settype($rctmpn, "array");
		settype($rcvalue, "array");
		settype($sbflag, "string");
		settype($nucantn, "integer");
		settype($nucanto, "integer");
		settype($nucont, "integer");

		$sbflag = false;
		$rctmp = $this->gatewaydetalleext->getGrupodetalleByGrupcodigon($inugrupcodigon);
		if ($rctmp) {
			$nucanto = sizeof($rctmp);
			$nucantn = sizeof($ircdata);
			if ($nucanto == $nucantn) {
				foreach($rctmp as $nucont => $rcvalue){
					$rctmpn[$nucont] = $rcvalue["perscodigos"];
				} 
				foreach ($ircdata as $nucont => $rcvalue) {
					if (!in_array($rcvalue["perscodigos"], $rctmpn)){
						$sbflag = true;
					}
				}
			}else{
				$sbflag = true;
			}
		}
		return $sbflag;
	}

	function updateHeaderGrupo($grupcodigon, $grupnombres, $esgrcodigos) {

		settype($dateService, "object");
		settype($objtmp, "object");
		settype($rctmp, "array");
		settype($osbsql, "string");

		//Carga el sevicio de Fechas
		$dateService = Application :: loadServices("DateController");

		//Calculamos la fecha final si es necesario
		//Consulto el estado inactivo
		$objtmp = Application :: loadServices("General");
		$rctmp = $objtmp->getParam("human_resources", "EST_GRUP_INA");

		//Si el estado es indicado como de finalizacion se calcula la fecha de finalizacion
		if ($rctmp) {
			if (in_array($esgrcodigos, $rctmp)) {
				$grupfchafinn = $dateService->fncintdatehour();
			} else {
				$grupfchafinn = Application :: getConstant("DB_NULL");
			}
		} else {
			$grupfchafinn = Application :: getConstant("DB_NULL");
		}

		$osbsql = $this->gatewayex->updateSqlGrupo($grupcodigon, $grupnombres, $esgrcodigos, $grupfchafinn);
		return $osbsql;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Elimina el registro de un grupo
	*   @param integer $grupcodigon (Entero con el codigo interno del grupo)
	*   @param string $grupcodigos (Cadena con el codigo externo del grupo) 
	*   @author freina
	*   @date 12-Nov-2004 14:51 
	*   @location Cali-Colombia
	*/
	function deleteGrupo($grupcodigon, $grupcodigos) {

		settype($objtmp, "object");
		settype($rctmp, "array");

		//Se busca que el grupo no este actualmente relacionado a un ente organizacional
		if ($this->gatewayorganizacionextended->existOrganizaciongrupo($grupcodigos) == 1) {
			return 10;
		}

		//Se busca que el grupo no haya estado relacionado a un ente organizacional
		$objtmp = Application :: loadServices("Cross300");
		if ($objtmp->DetermineRelationsGroup($grupcodigon)) {
			return 10;
		}

		if ($this->gateway->existGrupo($grupcodigon) == 1) {

			$rctmp[0] = $this->gatewaydetalleext->deleteGrupodetalleByGrupcodigon($grupcodigon);
			$rctmp[1] = $this->gatewayex->deleteGrupo($grupcodigon);

			if ($rctmp) {

				// se realiza la transaccion
				$this->gatewayex->GrupoTrans($rctmp);

				//Valida si se elimino el registro
				if ($this->gatewayex->consult == false)
					return 2;
				$this->UnsetRequest();
				return 3;
			} else {
				return 2;
			}
		} else {
			return 2;
		}
	}

	function getByIdGrupo($grupcodigon) {
		$data_grupo = $this->gateway->getByIdGrupo($grupcodigon);
		return $data_grupo;
	}

	function getAllGrupo() {
		//$this->gateway->
	}

	function getByGrupo_fkey($esgrcodigos) {
		//$this->gateway->
	}

	function UnsetRequest() {
		WebSession :: unsetProperty("Grupodetalle");
        foreach($_REQUEST as $index => $value){
            if(stripos($index,'grupodetalle__')!==false){
                unset($_REQUEST[$index]);
            }
        }
		unset ($_REQUEST["grupo__grupcodigon"]);
		unset ($_REQUEST["grupo__grupcodigos"]);
		unset ($_REQUEST["grupo__grupnombres"]);
		unset ($_REQUEST["grupo__esgrcodigos"]);
		unset ($_REQUEST["grupo__grupfchainin"]);
		unset ($_REQUEST["grupo__grupfchafinn"]);
		unset ($_REQUEST["grupo__grupactivos"]);
		unset ($_REQUEST["grupodetalle__perscodigos"]);
		unset ($_REQUEST["grupodetalle__persrespons"]);
	}
}
?>