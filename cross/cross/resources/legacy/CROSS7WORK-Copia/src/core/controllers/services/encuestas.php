<?php  
/**
	Copyright 2009  FullEngine
	
	Servicio de manejo de productos
	@author freina<freina@parquesoft.com>
	@date 28-Jul-2009 12:28
	@location Cali-Colombia
*/
class Encuestas {

	var $appName;
	var $appDir;
	function Encuestas(){
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/encuestas";
		$name = "encuestas";
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
		$rcinfo = array ("InitiateClass"=>"Copyright 2004  FullEngine
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
		@author freina <freina@parquesoft.com>
		@date 28-Jul-2009 12:32
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
    /**
    * Copyright 2005 FullEngine
    * 
    * Carga una compuerta de esta modulo
    * @author freina
    * @param type name desc
    * @return type name desc
    * @date 28-July-2009 13:51
    * @location Cali-Colombia
    */
    function getGateWay($gatewayName){
    	
    	settype($objGateway,"object");
    	$objGateway = Application :: getDataGateway($gatewayName);
    	if(method_exists($objGateway,"setReturn")){
    		$objGateway->setReturn(true);	
    	}
        return $objGateway;
	}
}
?>