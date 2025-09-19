<?php
class FeCrLlaveManager{

	function FeCrLlaveManager(){
		$this->gateway = Application::getDataGateway("llave");
		$this->objDate = Application :: loadServices("DateController");
	}
	function UnsetRequest(){
		foreach ($_REQUEST as $key => $value) {
			if (strpos($key,"__")!==false)
			unset ($_REQUEST[$key]);
		}
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene la respuesta del metodo
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Genera la nueva llave e ingresa la información a la bd
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addLlave(){
		
		settype($objService,"object");
		settype($objManager,"object");
		settype($rcResult,"array");
		settype($rcUser,"array");
		settype($rcData,"array");
		settype($rcDate,"array");
		settype($sbLlavcodigos,"string");
		settype($sbResult,"string");
		settype($nuResult,"integer");

		$rcData = $this->rcData;
		$sbResult = true;

		if(is_array($rcData) && $rcData){
			
			//Obtiene los datos del usuario
			$rcUser = Application :: getUserParam();
			$rcDate = $this->objDate->_getDate();
			
			$objManager = Application :: getDomainController('NumeradorManager');
			$sbLlavcodigos = $objManager->fncgetByIdNumerador("llave");
			$this->sbClave = $sbLlavcodigos;
			//tantas veces hasta que no exista una igual
			do{
				//se genera la nueva llave
				$this->key_gen();
				if($this->sbKey){
					//valida que esta clave ya no exista.
					$nuResult = $this->gateway->existLlave($this->sbKey);
				}
			}while($nuResult>0);
		}
		$this->sbKey.="_".$rcDate["year"];
		//por ultimo se ingresa a la bd la llave
		$rcData["llavcodigos"] = $sbLlavcodigos;
		$rcData["llavfecingd"] = $this->objDate->fncintdatehour();
		$rcData["usuacodigos"] = $rcUser["username"];
		$rcData["llavvalors"] = $this->sbKey;
		$rcData["llavactivas"] = Application :: getConstant("REG_ACT");
		
		$this->gateway->setData($rcData);
		$this->gateway->addLlave();
		$sbResult = $this->gateway->getConsult();
		
		$rcResult["result"] = $sbResult;
		$rcResult["clave"] = $this->sbKey;
		
		$this->rcResult = $rcResult;

		return true;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Genera la nueva llave de acuerdo a un consecutivo y el timestamp de la fechahora
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function key_gen(){

		settype($objManager,"object");
		settype($objDate,"object");
		settype($nuTimestamp,"integer");
		settype($sbSalt,"string");
		settype($sbKey,"string");
		
		if($this->sbClave){
			$objService = Application :: loadServices("Data_type");
			$nuTimestamp = $this->objDate->fncintdatehour();
			//se genera la semilla
			$sbSalt = substr($objService->my_md5($nuTimestamp) , 0, 8);
			$sbKey = $objService->myhash_keygen_s2k($sbLlavcodigos, $sbSalt, 16);
		}
		$this->sbKey = $sbKey;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el registro de la llave deacuerdo al valor de la llave
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getLlaveByLlavvalors(){
		
		settype($rcData,"array");
		extract($this->rcData);
		
		if($this->rcData){
			extract($this->rcData);
			$this->gateway->setData(array("llavvalors"=>$llavvalors));
			$this->gateway->getLlaveByLlavvalors();
			$rcData = $this->gateway->getResult();
		}
		$this->rcResult = $rcData;
		return true;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el sql para modificar la llave
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSqlUpdate(){
		settype($sbSql,"string");
		extract($this->rcData);
		
		if($this->rcData){
			extract($this->rcData);
			$this->gateway->setData(array("ordenumeros"=>$ordenumeros,
									   "llavfecusod"=>$llavfecusod,
									   "llavusuutis"=>$llavusuutis,
									   "llavvalors"=>$llavvalors));
			$this->gateway->setExecuteSql(false);
			$this->gateway->getUpdateLlave();
			$sbSql = $this->gateway->getSql();
		}
		$this->rcResult = $sbSql;
		return true;
	}
}
?>