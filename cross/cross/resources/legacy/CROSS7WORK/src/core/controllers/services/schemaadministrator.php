<?php

/**
	Copyright 2004  FullEngine
	
	Servicio que permite serializar los datos propios de un esquema de acuerdo 
	a el modulo seleccionado
	@author freina <freina@parquesoft.com>
	@date 21-Mar-2004 16:46:00
	@location Cali-Colombia
*/
class SchemaAdministrator {

	function SchemaAdministrator() {
		return true;
	}
	function setModule($sbModule) {
		$this->sbModule = $sbModule;
	}
	function setId($nuId) {
		$this->nuId = $nuId;
	}
	function setNameFile($sbFile) {
		$this->sbFile = $sbFile;
	}
	function setNewData($rcNewData) {
		$this->rcNewData = $rcNewData;
	}
	/**
		Copyright 2004  FullEngine
		
		Cambia la aplicacion a la configuracion del modulo pasado como parametro
		@author freina<freina@parquesoft.com>
		@date 21-Mar-2004 16:46:00
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function loadModule() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		if ($this->sbModule) {
			$dir_name = dirname(__FILE__)."/../../../applications/".$this->sbModule;
			$name = $this->sbModule;
			$objTmp = new Application($name, $dir_name, true);
		}
	}
	/**
		Copyright 2004  FullEngine
		
		Regresa a la aplicacion su configuracion
		@author freina<freina@parquesoft.com>
		@date 21-Mar-2004 16:46:00
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Escribe en un archivo serializado la informacion pasada como parametro
	* @author freina<freina@parquesoft.com>
	* @return true or false
	* @date 21-Mar-2006 16:52
	* @location Cali-Colombia
	*/
	function _setFile() {

		settype($sbPath, "string");
		settype($sbResult, "string");

		$sbPath = Application :: getBaseDirectory().'/config/'.$this->sbFile;
		$sbResult = & Serializer :: save($this->rcData, $sbPath);
		if (PEAR :: isError($sbResult)) {
			return false;
		}

		return true;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la lista de la conf de esquemas
	* @return true or false
	* @author freina<freina@parquesoft.com>
	* @date 21-Mar-2006 16:52
	* @location Cali-Colombia
	*/
	function _getFile() {

		settype($sbPath, "string");

		$sbPath = Application :: getBaseDirectory().'/config/'.$this->sbFile;

		if (file_exists($sbPath)) {
			$this->rcData = Serializer :: load($sbPath);
			return true;
		}
		return false;

	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Ingresa una nueva posicion a el serializado del archivo pasado como parametros
	* @return true or false
	* @author freina<freina@parquesoft.com>
	* @date 21-Mar-2006 16:52
	* @location Cali-Colombia
	*/
	function AddData() {

		settype($sbResult, "string");

		if ($this->nuId && $this->sbFile) {

			//se obtiene los datos del archivo serializado
			$sbResult = $this->_getFile();
			
			if ($sbResult) {

				$this->rcData[$this->nuId] = $this->rcData[0];
				$sbResult = $this->_setFile();

				if ($sbResult) {
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Elimina una posicion del serializado del archivo pasado como parametro
	* @return true or false
	* @author freina<freina@parquesoft.com>
	* @date 22-Mar-2006 08:44
	* @location Cali-Colombia
	*/
	function deleteData() {

		settype($sbResult, "string");

		if ($this->nuId && $this->sbFile) {
			
			//se obtiene los datos del archivo serializado
			$sbResult = $this->_getFile();

			if ($sbResult) {

				unset ($this->rcData[$this->nuId]);
				$sbResult = $this->_setFile();

				if ($sbResult) {
					return true;
				}
			}
		}

		return false;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Guarda los nuevos params en el serializado
	* @return true or false
	* @author mrestrepo<mrestrepo@parquesoft.com>
	* @date 23-Mar-2006 16:52
	* @location Cali-Colombia
	*/
	function saveParams()
	{
		settype($sbResult, "string");
		if (($this->nuId != "" && $this->nuId!=null) && $this->sbFile)
		{
			//se obtiene los datos del archivo serializado
			$sbResult = $this->_getFile();
			if ($sbResult) 
			{
				$this->rcData[$this->nuId] = $this->rcNewData;
				$sbResult = $this->_setFile();

				if ($sbResult)
					return true;
			}
		}
		return false;
	}
}
?>