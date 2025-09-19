<?php  
class FeGeTipolocalizaManager {
	var $gateway;

	function FeGeTipolocalizaManager() {
		$this->gateway = Application :: getDataGateway("tipolocaliza");
		$this->gatewaye = Application :: getDataGateway("tipolocalizaExtended");
	}

	function addTipolocaliza($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados) {
		if ($this->gateway->existTipolocaliza($tilocodigos) == 0) {
			$sbactivo = Application :: getConstant("REG_ACT");
			$sbinactivo = Application :: getConstant("REG_INACT");
			if ($tilocodpadrs && $tilocodpadrs!=$sbdbnull) {
				//se valida si el padre esta activo
				$rctmpp = $this->gateway->getByIdTipolocaliza($tilocodpadrs);
				if ($rctmpp) {
					if ($rctmpp[0]["tiloestados"] == $sbinactivo && $tiloestados == $sbactivo) {
						return 54;
					}
				}	
			}
			$this->gatewaye->addTipolocaliza($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados);
			if ($this->gatewaye->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateTipolocaliza($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados) {

		settype($objGateway, "object");
		settype($orcResult, "array");
		settype($rctmp, "array");
		settype($rctmpp, "array");
		settype($rcsql, "array");
		settype($rcData, "array");
		settype($sbsql, "string");
		settype($sbindex, "string");
		settype($sbvalor, "string");
		settype($sbdbnull, "string");
		settype($sbinactivo, "string");
		settype($sbactivo, "string");
		settype($sbFlag, "string");
		settype($nucant, "integer");
		settype($nuResult, "integer");
		
		$sbFlag = false;

		if ($this->gateway->existTipolocaliza($tilocodigos) == 1) {

			$sbdbnull = Application :: getConstant("DB_NULL");
			$sbactivo = Application :: getConstant("REG_ACT");
			$sbinactivo = Application :: getConstant("REG_INACT");
			if ($tilocodpadrs && $tilocodpadrs!=$sbdbnull) {
				//se valida si el padre esta activo
				$rctmpp = $this->gateway->getByIdTipolocaliza($tilocodpadrs);
				if ($rctmpp) {
					if ($rctmpp[0]["tiloestados"] == $sbinactivo && $tiloestados == $sbactivo) {
						$orcResult["result"]=54;
						return $orcResult;
					}
				}	
			}
			
			//obtiene los datos de registro para determinar si ha cambiado de padre
			$rcData = $this->gateway->getByIdTipolocaliza($tilocodpadrs);
			if($rcData){
				//se determina si hubo cambio de padre
				if(!$rcData[0]["tilocodpadrs"]){
					$rcData[0]["tilocodpadrs"] = $sbdbnull;
				}
				if($rcData[0]["tilocodpadrs"]!=$tilocodpadrs){
					$sbFlag = true;
				} 
			}

			$sbsql = $this->gatewaye->updateTipolocalizaSql($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados);
			if ($sbsql) {
				
				//gateway extendido
				$objGateway = Application :: getDataGateway("sqlExtended");
				$nuResult = $objGateway->determineLocationRelation($tilocodigos);
				if($nuResult>0 && $sbFlag){
					$orcResult["result"]=48;
					$orcResult["tilocodigos"]=$tilocodigos;
					return $orcResult;
				}
				$rcsql[0] = $sbsql;
				$rctmp = $this->fncinicio($tilocodigos);
				if ($rctmp) {
					$nucant = 1;
					foreach ($rctmp as $sbindex => $sbvalor) {
						$nuResult = $objGateway->determineLocationRelation($sbvalor);
						if($nuResult>0 && $sbFlag){
							$orcResult["result"]=48;
							$orcResult["tilocodigos"]=$sbvalor;
							return $orcResult;
						}
						$rcsql[$nucant] = $this->gatewaye->updateTiloestadosSql($sbvalor, $tiloestados);
						$nucant ++;
					}
				}
				$this->gatewaye->TipolocalizaTrans($rcsql);
				if ($this->gatewaye->consult) {
					$this->UnsetRequest();
					$orcResult["result"]=3;
				} else {
					$orcResult["result"]=100;
				}
			}
		} else {
			$orcResult["result"]=2;
		}
		return $orcResult;
	}

	function deleteTipolocaliza($tilocodigos) {
		
		settype($rcResult,"array");
		settype($rcSql,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbIndex,"string");
		settype($sbValor,"string");
		settype($nuCant,"integer");
		
		if ($this->gateway->existTipolocaliza($tilocodigos) == 1) {
			$sbSql = $this->gatewaye->deleteTipolocalizaSql($tilocodigos);
			if ($sbSql) {
				$rcSql[0] = $sbSql;
				$rcTmp = $this->fncinicio($tilocodigos);
				if ($rcTmp) {
					$nuCant = 1;
					foreach ($rcTmp as $sbIndex => $sbValor) {
						$rcSql[$nuCant] = $this->gatewaye->deleteTipolocalizaSql($sbValor);
						$nuCant ++;
					}
				}
				$this->gatewaye->TipolocalizaTrans($rcSql);
				if ($this->gatewaye->consult) {
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

	function getByIdTipolocaliza($tilocodigos) {
		$data_tipolocaliza = $this->gateway->getByIdTipolocaliza($tilocodigos);
		return $data_tipolocaliza;
	}

	function getAllTipolocaliza() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["tipolocaliza__tilocodigos"]);
		unset ($_REQUEST["tipolocaliza__tilonombres"]);
		unset ($_REQUEST["tipolocaliza__tilodesc"]);
		unset ($_REQUEST["tipolocaliza__tilocodpadrs"]);
		unset ($_REQUEST["tipolocaliza__tiloimagens"]);
		unset ($_REQUEST["tipolocaliza__tiloestados"]);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Funcion de busqueda recursivo
	*   @param $ircdata array   Data total
	*   @param $ircpadre array  Data acumulada
	*   @param $isbpadre string Codigo a analizar
	*   @param $inuindice integer   Indice consecutivo
	*   @author freina
	*   @date 04-Nov-2004 09:54 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $ircdata, & $ircpadre,  & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if ($ircdata[$nucont]["tilocodpadrs"] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont]["tilocodigos"], $ircdata, $ircpadre, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont]["tilocodigos"];
				$inuindice ++;
			}
		}
		return;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene los hijos de un tipo de localizacion
	*   @param $isbtilocodigos
	*   @author freina
	*   @date 04-Nov-2004 09:54 
	*   @location Cali-Colombia
	*/
	function fncinicio($isbtilocodigos) {

		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($nuindice, "integer");
		$nuindice = 0;
		$rctmp = $this->gateway->getAllTipolocaliza();
		if ($rctmp) {
			$this->fncseleccion($isbtilocodigos, $rctmp, $orcresult, $nuindice);
		}
		return $orcresult;
	}
}
?>