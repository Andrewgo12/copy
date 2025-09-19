<?php  
/**
	Copyright 2010  FullEngine
	
	Servicio de manejo de productos
	@author freina <freina@parquesoft.com>
	@date 24-Oct-2010 11:19:00
	@location Cali-Colombia
*/
class Products {

	var $appName;
	var $appDir;
	function Products() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/products";
		$name = "products";
		$objTmp = new Application($name, $dir_name, true);
	}
	/**
		Copyright 2004  FullEngine
		
		Muestra toda la informacion del servicio
		@author freina <freina@parquesoft.com>
		@date 14-Sep-2004 12:56
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array ("loadManager" => '@copyright Copyright 2010 FullEngine
											Crea una interfaz con un manager del modulo
											Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
											@param string $sbManager nombre del manager a cargar
											@return object
											@author freina <freina@parquesoft.com>
											@date 24-Oct-2010 11:02
											@location Cali-Colombia',
						"loadGateway"=>'@copyright Copyright 2010 FullEngine
											Crea una interfaz con una compuerta del modulo Nota: despues de usar este
											motodo se debe cerrar este servicio manual mente con el metodo close()
											@param string $sbGateway nombre de la compuerta a cargar
											@return object
											@author freina <freina@parquesoft.com>
											@date 24-Oct-2010 11:02
											@location Cali-Colombia',);

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data) echo "<tr><td>$key</td><td>$data</td></td>";
		echo "</table>";
	}
	/**
		Copyright 2010  FullEngine
		
		Regresa a la aplicacion su configuracion
		@author freina <freina@parquesoft.com>
		@date 24-Oct-2010 11:02
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
	
    /**
	* @copyright Copyright 2010 FullEngine
	*
	* Crea una interfaz con un manager del modulo
	* Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $sbManager nombre del manager a cargar
	* @return object
	* @author freina <freina@parquesoft.com>
	* @date 24-Oct-2010 11:02
	* @location Cali-Colombia
	*/
	function loadManager($sbManager) {
		$manager = Application :: getDomainController($manager);
		return $manager;
	}
	/**
	* @copyright Copyright 2010 FullEngine
	*
	* Crea una interfaz con una compuerta del modulo Nota: despues de usar este
	* motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $sbGateway nombre de la compuerta a cargar
	* @return object
	* @author freina <freina@parquesoft.com>
	* @date 24-Oct-2010 11:02
	* @location Cali-Colombia
	*/
	function loadGateway($sbGateway) {
		return  Application :: getDataGateway($gateway);
	}
}
?>