<?php
/**
* @Copyright 2005 Parquesoft
*
* Clase manager de la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
class FePrSchemaManager {
	var $gateway;

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FePrSchemaManager() {
		$this->gateway = Application :: getDataGateway("schema");
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Escribe en un archivo serializado la configuracion de lus usuarios de esquema
	* @param array $rcData 
	* @return integer signal
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 03-nov-2004 10:32:18
	* @location Cali-Colombia
	*/
	function setSchema($rcData) {
		$file_name = Application :: getBaseDirectory().'/config/schema.data';
		$result = & Serializer :: save($rcData, $file_name);
		if (PEAR :: isError($result)) {
			return false;
			
		}
		return true;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la lista de la conf de esquemas
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 03-nov-2004 10:39:19
	* @location Cali-Colombia
	*/
	function getSchema() {
		$file_name = Application :: getBaseDirectory().'/config/schema.data';
		if (file_exists($file_name))
			return Serializer :: load($file_name);
		else
			return null;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo adicion de datos tabla: schema
	* @author Ingravity 0.0.9
	* @modified freina<freina@parquesoft.com>
	* @param string $sbSchenombres Cadena con el nombre del esquema
	* @param string $sbScheobservas Cadena con las observaciones
	* @date 21-Mar-2006 15:16
	* @location Cali - Colombia
	*/
	function addSchema($sbSchenombres, $sbScheobservas) {

		settype($objNumerador, "object");
		settype($objService, "object");
		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($rcResult, "array");
		settype($rcModules, "array");
		settype($sbResult, "string");
		settype($sbIndex, "string");
		settype($sbFile, "string");
		settype($nuSchecodigon, "integer");

		$rcResult["result"] = false;

		//se obtiene los datos del archivo serializado de los esquemas
		$rcData = $this->getSchema();

		if ($rcData && is_array($rcData)) {
			
			//se obtiene el id
			$objNumerador = Application :: getDomainController('NumeradorManager');
            //MOD cazapata
			$nuSchecodigon = 2;//$objNumerador->fncgetByIdNumerador('schema');
			//MOD cazapata
			//Primero, se crea el schema en la bd, luego se mueven serializados
			$nuResult = true;//$this->gateway->createSchema($nuSchecodigon);
			if($nuResult)
			{
				$this->gateway->getSqlUseSchema("profiles");
			    //MOD cazapata	
				$sbResult = true;//$this->gateway->addSchema($nuSchecodigon, $sbSchenombres, $rcData[0]["schedbusers"], $rcData[0]["schedbkeys"], $sbScheobservas);
				if ($sbResult)
				{
					$rcData[$nuSchecodigon] = array ('schenombres' => $sbSchenombres, 'schedbusers' => $rcData[0]["schedbusers"], 'schedbkeys' => $rcData[0]["schedbkeys"]);
					$sbResult = $this->setSchema($rcData);
					
					if ($sbResult)
					{
						$objService = Application :: loadServices("SchemaAdministrator");
						
						//se crea el esquema en los serializados de los diferentes modulos
						$rcModules = Application :: getConstant("MODULES");//modulos del sistema
						
						foreach ($rcModules as $sbIndex => $rcTmp)
						{
							$objService->setModule($sbIndex);
							$objService->loadModule();
							$objService->setId($nuSchecodigon);
							foreach ($rcTmp as $sbFile)
							{
								$objService->setNameFile($sbFile);
								$sbResult = $objService->addData();
								if (!$sbResult)
								{
									$objService->close();
									break 2;
								}
							}
							$objService->close();
						}
						//agregar las tuplas en authschema para el webuser
						$sbWebUser = Application :: getConstant("WEB_USER");
						$authSchema = Application :: getDomainController("AuthschemaManager");
						$sbResult = $authSchema->addAuthschema($sbWebUser,$nuSchecodigon);
						
						if ($sbResult)
						{
							$rcResult["result"] = true;
							$rcResult["id"] = $nuSchecodigon;
						}
						else
						{
							//se elimina elesquema de la bd
							if ($this->gateway->existSchema($nuSchecodigon) == 1)
								$sbResult = $this->gateway->deleteSchema($nuSchecodigon);
						}
					}
				}
				else
				{
					//Si falla el insert, de plano no se serializa, luego tenemos que borrar el schema
					$sql = $this->gateway->getSqlDropSchema($this->sbName);
					if($sql){
						$this->gateway->objdb->fncadoexecute($sql);	
					}
					$this->gateway->getSqlUseSchema("profiles");
				}
			}
		}

		return $rcResult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo actualizacion de datos tabla: schema
	* @author Ingravity 0.0.9
	* @modified freina<freina@parquesoft.com>
	* @param Integer $nuSchecodigon Entero con el id del esquema
	* @param string $sbSchenombres Cadena con el nombre del esquema
	* @param string $sbScheobservas Cadena con las observaciones
	* @date 22-Mar-2006 17:20
	* @location Cali - Colombia
	*/
	function updateSchema($nuSchecodigon, $sbSchenombres, $sbScheobservas) {

		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($sbResult, "string");

		$rcData = $this->getSchema();
		if ($rcData && is_array($rcData)) {

			if ($this->gateway->existSchema($nuSchecodigon) == 1) {
				
				$rcTmp = $this->gateway->getByIdSchema($nuSchecodigon);

				$sbResult = $this->gateway->updateSchema($nuSchecodigon, $sbSchenombres, $sbScheobservas);

				if ($sbResult) {

					$rcData[$nuSchecodigon] = array ('schenombres' => $sbSchenombres,
													 'schedbusers' => $rcData[0]["schedbusers"],
													 'schedbkeys' => $rcData[0]["schedbkeys"]);
					$sbResult = $this->setSchema($rcData);
					if ($sbResult) {
						$this->UnsetRequest();
						return 3;
					} else {
						$sbResult = $this->gateway->updateSchema($nuSchecodigon,
						 $rcTmp[0]["schenombres"], $rcTmp[0]["scheobservas"]);
					}
				}
				return 5;
			} else {
				return 2;
			}
		}
		return 100;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de eliminacion de datos tabla: schema
	* @author Ingravity 0.0.9
	* @param integer $nuSchecodigon Entero con el id del esquema
	* @location Cali - Colombia
	*/
	function deleteSchema($nuSchecodigon) {

		settype($objManager, "object");
		settype($objService, "object");
		settype($rcData, "array");
		settype($sbResult, "string");
		settype($rcTmp, "array");
		settype($rcModules, "array");
		settype($sbIndex, "string");
		settype($sbFile, "string");

		//se llevan a cabo validaciones de si 
		// el esquema esta relacionado a un usuario o tipo de caso

		//validacion contra usuarios
		$objManager = Application :: getDomainController("AuthManager");
		$sbResult = $objManager->existAuthBySchecodigon($nuSchecodigon);

		if ($sbResult) {
			return 15;
		}

		//validacion contra tipos de caso
		$objService = Application :: loadServices("Cross300");
		$sbResult = $objService->existTipoordenBySchecodigon($nuSchecodigon);
		if ($sbResult) {
			return 16;
		}

		if ($this->gateway->existSchema($nuSchecodigon) == 1) {
			$sbResult = $this->gateway->deleteSchema($nuSchecodigon);
			if ($sbResult) {
				
				$rcData = $this->getSchema();
				
				if ($rcData && is_array($rcData)) {
					unset ($rcData[$nuSchecodigon]);
					$sbResult = $this->setSchema($rcData);
					if ($sbResult) {

						$objService = Application :: loadServices("SchemaAdministrator");

						//se crea el esquema en los serializados de los diferentes modulos
						//modulos del sistema
						$rcModules = Application :: getConstant("MODULES");

						foreach ($rcModules as $sbIndex => $rcTmp) {

							$objService->setModule($sbIndex);
							$objService->loadModule();
							$objService->setId($nuSchecodigon);
							foreach ($rcTmp as $sbFile) {
								$objService->setNameFile($sbFile);
								$sbResult = $objService->deleteData();
								if (!$sbResult) {
									$objService->close();
									break 2;
								}
							}
							$objService->close();
						}
					}
					$this->UnsetRequest();
					return 3;
				}
			} else {
				return 5;
			}
		} else {
			return 2;
		}
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta los datos por la llave primaria de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdSchema($schecodigon) {
		$data_schema = $this->gateway->getByIdSchema($schecodigon);
		return $data_schema;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllSchema() {
		$data_schema = $this->gateway->getAllSchema($schecodigon);
		return $data_schema;

	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getSchemas() {
		$data_schema = $this->gateway->getSchemas();
		return $data_schema;
	}
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para limpiar los datos de la sesion de la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function UnsetRequest() {

		unset ($_REQUEST["schema__schecodigon"]);
		unset ($_REQUEST["schema__schenombres"]);
		unset ($_REQUEST["schema__schedbusers"]);
		unset ($_REQUEST["schema__schedbkeys"]);
		unset ($_REQUEST["schema__scheobservas"]);
	}
}
?>
