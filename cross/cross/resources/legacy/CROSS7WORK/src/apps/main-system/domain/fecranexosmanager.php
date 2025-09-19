<?php  
class FeCrAnexosManager {
	var $gateway;
	var $objgateway;

	function FeCrAnexosManager() {
		$this->gateway = Application :: getDataGateway("anexos");
		$this->objgateway = Application :: getDataGateway("AnexosExtended");
	}

	function addAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos) {
		if ($this->gateway->existAnexos($ordenumeros, $anexcodigon) == 0) {
			$this->gateway->addAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos);
			if ($this->gateway->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos) {
		if ($this->gateway->existAnexos($ordenumeros, $anexcodigon) == 1) {
			$this->gateway->updateAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteAnexos($ordenumeros, $anexcodigon) {
		if ($this->gateway->existAnexos($ordenumeros, $anexcodigon) == 1) {
			$this->gateway->deleteAnexos($ordenumeros, $anexcodigon);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdAnexos($ordenumeros, $anexcodigon) {
		$data_anexos = $this->gateway->getByIdAnexos($ordenumeros, $anexcodigon);
		return $data_anexos;
	}

	function getAllAnexos() {
		//$this->gateway->
	}

	function getByAnexos_fkey($ordenumeros) {
		//$this->gateway->
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Ingresa los anexos de una orden
	*   @author freina
	*	@param string $isbordenumeros (Codigo del requerimiento)
	*	@param		 array $ircattachment (Arreglo con los nombres de los
	*archivos anexos)
	*	@return array o null
	*   @date 15-Feb-2005 17:16
	*   @location Cali-Colombia
	*/
	function addAttachment($isbordenumeros, $ircattachment) {

		settype($objdate, "object");
		settype($objnumerador, "object");
		settype($rctmp, "array");
		settype($rctmpa, "array");
		settype($rcsql, "array");
		settype($rcuser, "array");
		settype($orcresult, "array");
		settype($sbstate, "string");
		settype($sbpath, "string");
		settype($sbpathd, "string");
		settype($sbpatho, "string");
		settype($sbpathtmp, "string");
		settype($sbname, "string");
		settype($sbresult, "string");
		settype($sbvalue, "string");
		settype($sbUmask,"string");
		settype($nucont, "integer");
		settype($nucant, "integer");
		settype($nuanexcodigon, "integer");
		settype($nudatehour, "integer");

		if ($ircattachment) {

			//fecha y hora
			$objdate = Application :: loadServices("DateController");
			$nudatehour = $objdate->fncintdatehour();

			//datos del usuario
			$rcuser = Application :: getUserParam();

			$sbstate = Application :: getConstant("N_ANEXO");

			//Trae de la configuracion la ruta del directorio de los anexos
			$sbpath = Application :: getConstant("ANEXOS");
			
			if(is_array($rcuser) && $rcuser){
				if($rcuser["schema"]){
					$sbpath .= Application::getConstant("SLASH").$rcUser["schema"];	
				}
			}
			
			//Se valida si el directorio existe
			if(!is_dir($sbpath)){
				$sbUmask = umask(0); 
				mkdir($sbpath, 0775);
				umask($sbUmask); 
			}

			//obtiene la ruta del directorio temporal
			$sbpathtmp = Application :: getTmpDirectory();

			foreach ($ircattachment as $rctmp) {
				if ($rctmp[1] == $sbstate) {
					$rctmpa[$nucont] = $rctmp[0];
					$nucont ++;
				}
			}

			//se separan los codigos
			$nucant = sizeof($rctmpa);

			$objnumerador = Application :: getDomainController('NumeradorManager');
			$nuanexcodigon = $objnumerador->fncgetByIdNumerador("anexos", $nucant);

			$nucont = 0;
			foreach ($rctmpa as $sbvalue) {

				//Genera el path de origen con el nombre del archivo
				$sbpatho = $sbpathtmp.Application::getConstant("SLASH").$sbvalue;

				//Determina el nombre del archivo
				$sbname = $isbordenumeros."__".$sbvalue;

				//Genera el path de destino con el nombre final del archivo
				$sbpathd = $sbpath.Application::getConstant("SLASH").$sbname;

				//copia el archivo
				@ $sbresult = copy($sbpatho, $sbpathd);
				if (!$sbresult) {
					$orcresult["ERROR"] = true;
				}
				//se generan los sql ha ser ingresados en en los anexos
				$rcsql[$nucont] = $this->objgateway->addAnexosSql($isbordenumeros, ($nuanexcodigon + $nucont), $sbvalue, $nudatehour, $rcuser["username"]);
				$nucont ++;
			}

			$orcresult["SQL"] = $rcsql;

			foreach ($rctmpa as $sbvalue) {
				//Genera el path de origen con el nombre del archivo
				$sbpatho = $sbpathtmp.Application::getConstant("SLASH").$sbvalue;
                if(is_file($sbpatho))
                    unlink($sbpatho);
			}
		}
		return $orcresult;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   actualiza los anexos de una orden
	*   @author freina
	*	@param string $isbordenumeros (Codigo del requerimiento)
	*	@param		 array $ircattachment (Arreglo con los nombres de los
	*archivos anexos)
	*	@return array o null
	*   @date 18-Feb-2005 11:21
	*   @location Cali-Colombia
	*/
	function updateAttachment($isbordenumeros, $ircattachment) {

		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rcanexos, "array");
		settype($rctmpo, "array");
		settype($rcsql, "array");
		settype($rcuser, "array");
		settype($sbstate, "string");
		settype($sbpath, "string");
		settype($sbname, "string");
		settype($sbpathd, "string");
		settype($sbUmask,"string");
		settype($nucont, "integer");
		
		//se obtienen los anexos de una orden
		$rcanexos = $this->gateway->getByAnexos_fkey($isbordenumeros);

		if ($rcanexos) {

			//se obtienen los archivos que no se han eliminado
			$sbstate = Application :: getConstant("O_ANEXO");

			//Trae de la configuracion la ruta del directorio de los anexos
			$sbpath = Application :: getConstant("ANEXOS");
			
			//datos del usuario
			$rcuser = Application :: getUserParam();
			
			if(is_array($rcuser) && $rcuser){
				if($rcuser["schema"]){
					$sbpath .= Application::getConstant("SLASH").$rcUser["schema"];	
				}
			}
			
			//Se valida si el directorio existe
			if(!is_dir($sbpath)){
				$sbUmask = umask(0); 
				mkdir($sbpath, 0775);
				umask($sbUmask); 
			}

			foreach ($ircattachment as $rctmp) {
				if ($rctmp[1] == $sbstate) {
					$rctmpo[$nucont] = $rctmp[0];
					$nucont ++;
				}
			}

			$nucont = 0;
			//una vez se han determinados los archivos viejos se procede a verificar 
			//cuales han de ser eliminados
			if ($rctmpo) {
				foreach ($rcanexos as $rctmp) {
					if (!(in_array($rctmp["anexnombarch"], $rctmpo))) {
						//si no esta se elimina
						$rcsql[$nucont] = $this->objgateway->deleteAnexosSql($isbordenumeros, $rctmp["anexcodigon"]);

						//Determina el nombre del archivo
						$sbname = $isbordenumeros."__".$rctmp["anexnombarch"];

						//Genera el path de destino con el nombre final del archivo
						$sbpathd = $sbpath.Application::getConstant("SLASH").$sbname;
                        if(is_file($sbpathd))
                            unlink($sbpathd);
						$nucont ++;
					}
				}
			} else {
				foreach ($rcanexos as $rctmp) {
					
					//Determina el nombre del archivo
					$sbname = $isbordenumeros."__".$rctmp["anexnombarch"];

					//Genera el path de destino con el nombre final del archivo
					$sbpathd = $sbpath.Application::getConstant("SLASH").$sbname;
                    if(is_file($sbpathd))
                        unlink($sbpathd);
                }
				$rcsql[0] = $this->objgateway->deleteAnexosByordenumeros($isbordenumeros);
			}
			$orcresult["SQL"] = $rcsql;
		}
		return $orcresult;
	}

	function UnsetRequest() {
		unset ($_REQUEST["anexos__ordenumeros"]);
		unset ($_REQUEST["anexos__anexcodigon"]);
		unset ($_REQUEST["anexos__anexnombarch"]);
		unset ($_REQUEST["anexos__anexfechingn"]);
		unset ($_REQUEST["anexos__usuacodigos"]);
	}
}
?>