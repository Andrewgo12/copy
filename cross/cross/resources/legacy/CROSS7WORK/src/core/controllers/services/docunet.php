<?php  
/**
	Copyright 2010  FullEngine
	MÓDULO DE INTEGRACIÓN CON DOCUNET
	@author mrestrepo <cazapata@parquesoft.com>
	@date 06-Apr-2010 10:57:44
	@location Cali-Colombia
*/
class Docunet {

	var $appName;
	var $appDir;
	var $rcData;
	
	function Docunet(){
		
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/docunet";
		$name = "docunet";
		$objTmp = new Application($name, $dir_name, true);
	}
	/**
		Copyright 2004  FullEngine
		Muestra toda la informacion del servicio
		@author cazapata <cazapata@parquesoft.com>
		@date 14-Sep-2004 12:56
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array (
						"InitiateClass"=>"Copyright 2010 FullEngine
											Inicia una clase (Regla)
											@param string $isbclass (Cadena con el nombre de la clase)
											@author mrestrepo <mrestrepo@parquesoft.com>
											@date 06-Apr-2010 14:16
											@location Cali-Colombia",
						
						"close" => "		Copyright 2004  FullEngine
											Regresa a la aplicacion su configuracion
											@author cazapata <cazapata@parquesoft.com>
											@date 14-Sep-2004 13:01
											@location Cali-Colombia
											@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase",
						
						"setData" => "		Copyright 2004  FullEngine
											Carga los datos de ambiente en $this->rcData
											@author cazapata <cazapata@parquesoft.com>
											@date 14-Sep-2004 13:01
											@location Cali-Colombia",
						
						"IntegrarDocunet" => "Copyright 2010 FullEngine
											Regla de integración - conecta con un módulo que está configurado para conectarse
											al OCI de docunet, envía un llamado a un STPROC y devuelve dicha respuesta a cross300
											@param string $this->rcData (array previamente poblado con vbles de ambiente)
											@author mrestrepo <mrestrepo@parquesoft.com>
											@date 06-Apr-2010 24:16
											@location Cali-Colombia	",
						
						"getGateway" => "Copyright 2004  FullEngine
											Inicia una clase (Regla)
											@param string $isbclass (Cadena con el nombre de la clase)
											@author freina <freina@parquesoft.com>
											@date 15-Oct-2004 14:16
											@location Cali-Colombia",
	  					 );

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data) echo "<tr><td>$key</td><td>$data</td></td>";
		echo "</table>";
	}
	
	/**
		Copyright 2004  FullEngine
		Regresa a la aplicacion su configuracion
		@author cazapata <cazapata@parquesoft.com>
		@date 14-Sep-2004 13:01
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
	
	function setData($rcData) {
		$this->rcData = $rcData;
	}
	
	/**
		Copyright 2004  FullEngine
		Inicia una clase (Regla)
		@param string $isbclass (Cadena con el nombre de la clase)
		@author freina <freina@parquesoft.com>
		@date 15-Oct-2004 14:16
		@location Cali-Colombia		
	*/
	function InitiateClass($isbclass) {
		
		settype($objtmp,"object");
		
		//Instancio la clase
		$objtmp = Application :: getDomainController($isbclass);
		
		if(is_object($objtmp)){
			return $objtmp;
		}
		return null;
	}
	
	/**
		Copyright 2004  FullEngine
		Inicia una clase (Regla)
		@param string $isbclass (Cadena con el nombre de la clase)
		@author freina <freina@parquesoft.com>
		@date 15-Oct-2004 14:16
		@location Cali-Colombia		
	*/
	function getGateway($isbclass) {
		
		settype($objtmp,"object");
		
		//Instancio la clase
		$objtmp = Application :: getDataGateway($isbclass);
		if(is_object($objtmp)){
			return $objtmp;
		}
		return null;
	}
	
	/**
		Copyright 2010 FullEngine
		Regla de integración - conecta con un módulo que está configurado para conectarse
		al OCI de docunet, envía un llamado a un STPROC y devuelve dicha respuesta a cross300
		@param string $this->rcData (array previamente poblado con vbles de ambiente)
		@author mrestrepo <mrestrepo@parquesoft.com>
		@date 06-Apr-2010 24:16
		@location Cali-Colombia		
	*/
	function IntegrarDocunet() {
		
		$gateway = $this->getGateway("sqlExtended");
		$gateway->setData($this->rcData);
		return $gateway->ingresarDocumento();
	}
}
?>