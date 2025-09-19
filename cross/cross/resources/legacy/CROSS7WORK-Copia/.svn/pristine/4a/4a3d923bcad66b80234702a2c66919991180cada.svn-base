<?php  
class FeGeLocalizacionManager {
	
	var $gateway;
	var $gatewaye;

	function FeGeLocalizacionManager() {
		$this->gateway = Application :: getDataGateway("localizacion");
		$this->gatewaye = Application :: getDataGateway("localizacionExtended");
	}

	function addLocalizacion($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados) {
		
		if ($this->gateway->existLocalizacion($locacodigos) == 0) {
			$sbactivo = Application :: getConstant("REG_ACT");
			$sbinactivo = Application :: getConstant("REG_INACT");
			if($locacodpadrs && $locacodpadrs!=$sbdbnull){
				//se valida si el padre esta activo
				$rctmpp = $this->gateway->getByIdLocalizacion($locacodpadrs);
				if($rctmpp){
					if($rctmpp[0]["locaestados"] == $sbinactivo && $locaestados==$sbactivo){
						return 55;
					}
				}
			}
            $this->gatewaye->addLocalizacion($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados);
			if ($this->gatewaye->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Modifica la localizacion
	*   @param $locacodigos
	*   @param $locanombres
	*   @param $locadescrips
	*   @param $tilocodigos
	*   @param $locacodpadrs
	*   @param $locaordenn
	*   @param $locazonas
	*   @param $locaestados
	*   @author freina
	*   @date 03-Nov-2004 16:48 
	*   @location Cali-Colombia
	*/
	function updateLocalizacion($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados) {
		
		settype($rctmp,"array");
		settype($rcData,"array");
		settype($rctmpp,"array");
		settype($rcsql,"array");
		settype($sbsql,"string");
		settype($sbindex,"string");
		settype($sbvalor,"string");
		settype($sbdbnull,"string");
		settype($sbinactivo,"string");
		settype($sbactivo,"string");
		settype($nucant,"integer");
		
		if ($this->gateway->existLocalizacion($locacodigos) == 1) {
			$sbdbnull = Application :: getConstant("DB_NULL");
			$sbactivo = Application :: getConstant("REG_ACT");
			$sbinactivo = Application :: getConstant("REG_INACT");
			if($locacodpadrs && $locacodpadrs!=$sbdbnull){
				//se valida si el padre esta activo
				$rctmpp = $this->gateway->getByIdLocalizacion($locacodpadrs);
				if($rctmpp){
					if($rctmpp[0]["locaestados"] == $sbinactivo && $locaestados==$sbactivo){
						return 55;
					}
				}
			}
			
			$sbsql = $this->gatewaye->updateLocalizacionSql($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados);
			if($sbsql){
				$rcsql[0] = $sbsql;
				$rctmp = $this->fncinicio($locacodigos);
				if($rctmp){
					$nucant = 1;
					foreach($rctmp as $sbindex => $sbvalor){
						$rcsql[$nucant] = $this->gatewaye->updatelocaestadosSql($sbvalor, $locaestados);
						$nucant ++;
					}
				}
				//se valida en caso de que el tipo de localizacion haya cambiado, que se pueda realiar el cambio
				$rcData = $this->gateway->getByIdLocalizacion($locacodigos);
				if($rcData){
					if($rcData[0]["tilocodigos"]!=$tilocodigos && $rctmp){
						return 49;
					}
				}
				 
				$this->gatewaye->LocalizacionTrans($rcsql);
				if($this->gatewaye->consult){
					$this->UnsetRequest();
					return 3;
				}else{
					return 100;
				}
			}
		} else {
			return 2;
		}
	}

	function deleteLocalizacion($locacodigos) {
		
		settype($rcResult,"array");
		settype($rcSql,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbIndex,"string");
		settype($sbValor,"string");
		settype($nuCant,"integer");
		
		if ($this->gateway->existLocalizacion($locacodigos) == 1) {
            //Valida si es usada en los req
            $service = Application::loadServices('Cross300');
            $gateway = $service->getGateWay("SqlExtended");
            $rcReq = $gateway->getReqByLocalizacion($locacodigos);
            $service->close();
            if(is_array($rcReq))
                return 56;
			$sbSql = $this->gatewaye->deleteLocalizacionSql($locacodigos);
			if ($sbSql) {
				$rcSql[0] = $sbSql;
				$rcTmp = $this->fncinicio($locacodigos);
				if ($rcTmp) {
					$nuCant = 1;
					foreach ($rcTmp as $sbIndex => $sbValor) {
						$rcSql[$nuCant] = $this->gatewaye->deleteLocalizacionSql($sbValor);
						$nuCant ++;
					}
				}
				$this->gatewaye->LocalizacionTrans($rcSql);
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

	function getByIdLocalizacion($locacodigos) {
		$data_localizacion = $this->gateway->getByIdLocalizacion($locacodigos);
		return $data_localizacion;
	}

	function getAllLocalizacion() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["localizacion__locacodigos"]);
		unset ($_REQUEST["localizacion__locanombres"]);
		unset ($_REQUEST["localizacion__locadescrips"]);
		unset ($_REQUEST["localizacion__tilocodigos"]);
		unset ($_REQUEST["localizacion__locacodpadrs"]);
		unset ($_REQUEST["localizacion__locaordenn"]);
		unset ($_REQUEST["localizacion__locazonas"]);
		unset ($_REQUEST["localizacion__locaestados"]);
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
	*   @date 03-Nov-2004 16:41 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($this->rctmp);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if ($this->rctmp[$nucont]["locacodpadrs"] == $isbpadre) {
				$this->fncseleccion($this->rctmp[$nucont]["locacodigos"], $inuindice);
				$this->orcresult[$inuindice] = $this->rctmp[$nucont]["locacodigos"];
				$inuindice ++;
			}
		}
		return;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene los hijos de una localizacion
	*   @param $isblocacodigos
	*   @author freina
	*   @date 03-Nov-2004 15:35 
	*   @location Cali-Colombia
	*/
	function fncinicio($isblocacodigos) {

		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($nuindice, "integer");
		$nuindice = 0;
		
		if(!is_array($this->rctmp))
			$this->rctmp = $this->gateway->getAllLocalizacion();
		
		if ($this->rctmp) {
			$this->fncseleccion($isblocacodigos, $nuindice);
		}
		return $this->orcresult;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene una vaina que bien podría ser un árbol de localizaciones, pero a partir de cierto nivel
	*   @param $isblocacodigos
	*   @author freina
	*   @date 19-Jun-2008 13:35 
	*   @location Cali-Colombia
	*/
	function getTreeLocalization($tipoMunicipio) {
		
		//Traigámolos todos
		$rcTmp = $this->gatewaye->getTreeLocalization($tipoMunicipio);
		
		//Excepción si no hay nadie
		if(!is_array($rcTmp))
			return false;
		
		//Hagamos alguna locura en memoria para armar ese árbol
		foreach ($rcTmp as $rcRow) {
			$rcPadres[] = $rcRow["locacodigos"];
			$rcReturn[$rcRow["locacodigos"]]["tilonombres"] = $rcRow["tilonombres"];
			if(in_array($rcRow["locacodpadrs"],$rcPadres) && $rcRow["tilocodigos"]<>$tipoMunicipio) {
				$rcReturn[$rcRow["locacodigos"]]["locanombres"] = $rcReturn[$rcRow["locacodpadrs"]]["locanombres"]." > ".$rcRow["locanombres"];
			}
			else if($rcRow["tilocodigos"]==$tipoMunicipio) {
				$rcReturn[$rcRow["locacodigos"]]["locanombres"] = $rcRow["locanombres"];
			}
		}
		if(is_array($rcReturn))
			$rcReturn = $this->ordenarPorLocanombres($rcReturn);
		return $rcReturn;
	}
	
	function ordenarPorLocanombres($ircData) {
		settype($rcOut,"array");
		settype($rcTmp,"array");
		
		foreach ($ircData as $locacodigos=>$row)
			$rcTmp[] = $row["locanombres"];
			
		sort($rcTmp);
		reset($ircData);
		
		foreach ($rcTmp as $nuCont=>$locanombres) { 
			foreach ($ircData as $locacodigos=>$row) {
				if($row["locanombres"] == $locanombres && strlen($locanombres)) {
					$rcOut[$locacodigos]["tilonombres"] = $row["tilonombres"];
					$rcOut[$locacodigos]["locanombres"] = $locanombres;
				}
			}
		}
		
		return $rcOut;
	}
}
?>