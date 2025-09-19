<?php    
/**
	Copyright 2004  FullEngine
	
	Servicio de manejo de perfiles de usuario
	@author freina <freina@parquesoft.com>
	@date 02-Sep-2004 12:53:44
	@location Cali-Colombia
*/
class Customers {

	var $appName;
	var $appDir;
	function Customers() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/customers";
		$name = "customers";
		$objTmp = new Application($name, $dir_name, true);
	}
	/**
		Copyright 2004  FullEngine
		
		Muestra toda la informacion del servicio
		@author cazapata <cazapata@parquesoft.com>
		@date 12-Sep-2004 09:56
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array ("getAllContrato" => "Copyright 2004  FullEngine<br>
															Obtiene el listado de los contratos <br>
															@return array<br>
															@author cazapata<cazapata@parquesoft.com><br>
															@date 12-Sep-2004 09:57<br>
															@location Cali-Colombia", "getDataCustomerByContrato" => "Copyright 2004  FullEngine
															Obtiene la data de un cliente por medio de un contrato (generico)
															@param string $isbcontnics (Cadena con el codigo del contrato)
															@param boolean $iblflag (Indica si el servicio se debe dejar abierto)
															@return array $orcresult (Arreglo con el nombre y email de un cliente)
															[nombre] Nombre del ente
															[email] e-mail
															@author freina <freina@parquesoft.com>
															@date 08-Oct-2004 06:25
															@location Cali-Colombia", "getAllActiveContrato" => "Copyright 2004  FullEngine
																						Obtiene el listado de los contratos activos
																						@return array
																						@author freina <freina@parquesoft.com>
																						@date 04-Nov-2004 18:59
																						@location Cali-Colombia", "getActiveCustomers" => "@copyright Copyright 2004 &copy; FullEngine
												 Consulta todos los clientes activos y ordenados por el nombre
												 @return array
												 @author creyes <cesar.reyes@parquesoft.com>
												 @date 24-nov-2004 12:01:04
												 @location Cali-Colombia", 
		"loadManager" => "@copyright Copyright 2004 &copy; FullEngine
		Crea una interfaz con un manager del modulo 
		Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
		@param string \$manager nombre del manager a cargar
		@return object
		@author creyes <cesar.reyes@parquesoft.com>
		@date 24-nov-2004 12:11:38
		@location Cali-Colombia",
		 "loadGateway" => "@copyright Copyright 2004 &copy; FullEngine
		Crea una interfaz con un manager del modulo 
		Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
		@param string \$manager nombre del manager a cargar
		@return object
		@author creyes <cesar.reyes@parquesoft.com>
		@date 24-nov-2004 12:11:38
		@location Cali-Colombia", 
		 "getGateWay" => "@copyright Copyright 2004 &copy; FullEngine
		Crea una interfaz con un manager del modulo 
		Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
		@param string \$manager nombre del manager a cargar
		@return object
		@author creyes <cesar.reyes@parquesoft.com>
		@date 24-nov-2004 12:11:38
		@location Cali-Colombia", 
		"getByIdcontindentis" => "@copyright Copyright 2004 &copy; FullEngine
		Consulta los datos de un contacto
		@param string $contindentis 
		@return array
		@author creyes <cesar.reyes@parquesoft.com>
		@date 24-nov-2004 12:11:38
		@location Cali-Colombia",
		"getAllTipoidentifi"=>'@copyright Copyright 2004 &copy; FullEngine' .
				'Consulta todos los tipos de identificacion activos' .
				'@param boolean $sbFlag True o False, indica si se debe cerrar el servicio' .
				'@return array' .
				'@author freina <freina@parquesoft.com>' .
				'@date 10-Jan-2007 17:37' .
				'@location Cali-Colombia',
		"getAllTipocliente"=>'@copyright Copyright 2010 &copy; FullEngine
		Consulta todos los tipos de cliente activos
		@param boolean $sbFlag True o False, indica si se debe cerrar el servicio
		@return array
		@author freina <freina@parquesoft.com>
		@date 30-Oct-2010 10:43
		@location Cali-Colombia',
		"existActiveSolicitanteByIdentis"=>' @copyright Copyright 2004 &copy; FullEngine
	 	Determina si el solicitante existe y esta activo, por medio de su id
		@param string $sbSolicodigos Identificacion del contacto
		@param boolean $sbFlag Indica si se cierra o no el servicio
		@return boolean true  existe false no existe
		@author freina<freina@parquesoft.com>
		@date 04-Sep-2012 16:40
		@location Cali-Colombia');

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data)
			echo "<tr><td>$key</td><td>$data</td></td>";
		echo "</table>";
	}
	/**
		Copyright 2004  FullEngine
		
		Regresa a la aplicacion su configuracion
		@author creyes <cesar.reyes@parquesoft.com>
		@date 02-Sep-2004 13:01
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene el listado de los contratos
		@return array
		@author cazapata <cazapata@parquesoft.com>
		@date 12-Sep-2004 09:57
		@location Cali-Colombia		
	*/
	function getAllContrato() {
		//Instancio la compuerta de contrato
		$gateway = Application :: getDataGateway("Contrato");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getAllContrato();
		$this->close();
		return $rcElemens;
	}
	/**
	* Copyright 2004  FullEngine
	*
	*	Obtiene el listado de los contratos activos
	*	@return array
	*	@author freina <freina@parquesoft.com>
	*	@date 04-Nov-2004 18:59
	*	@location Cali-Colombia		
	*/
	function getAllActiveContrato() {
		//Instancio la compuerta de contrato
		$gateway = Application :: getDataGateway("contratoExtended");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getAllActiveContrato();
		$this->close();
		return $rcElemens;
	}
	/**
		Copyright 2004  FullEngine
		
		*Obtiene la data de un cliente por medio de un contrato (generico)
		*@param string $isbcontnics (Cadena con el codigo del contrato)
		*@param boolean $iblflag (Indica si el servicio se debe dejar abierto)
		*@return array $orcresult (Arreglo con el nombre y email de un cliente)
		*@author freina <freina@parquesoft.com>
		*@date 08-Oct-2004 06:25
		*@location Cali-Colombia		
	*/
	function getDataCustomerByContrato($isbcontnics, $iblflag = false) {

		settype($objgateway, "object");
		settype($rctmp, "array");
		settype($orcresult, "array");

		//Instancio la compuerta Sql extendida
		$objgateway = Application :: getDataGateway("SqlExtendedCustomers");
		//Llamo el metodo que hace la consulta
		$rctmp = $objgateway->getClienteByContrato($isbcontnics);
		if ($iblflag) {
			$this->close();
		}
		if ($rctmp) {
			$orcresult["nombre"] = $rctmp[0]["clienombres"];
			$orcresult["email"] = $rctmp[0]["cliemails"];
		}
		return $orcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta todos los clientes activos y ordenados por el nombre
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:01:04
	* @location Cali-Colombia
	*/
	function getActiveCustomers() {
		$objgateway = Application :: getDataGateway("SqlExtended");
		$rcResult = $objgateway->getActiveCustomers();
		$this->close();
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Crea una interfaz con un manager del modulo
	* Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $manager nombre del manager a cargar
	* @return object
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function loadManager($manager) {
		$manager = Application :: getDomainController($manager);
		return $manager;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Crea una interfaz con una compuerta del modulo Nota: despues de usar este
	* motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $manager nombre del manager a cargar
	* @return object
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function loadGateway($gateway) {
		return  Application :: getDataGateway($gateway);
	}
	/**
    * Copyright 2005 FullEngine
    * 
    * Carga una compuerta de esta modulo
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 23-December-2005 12:56:3
    * @location Cali-Colombia
    */
    function getGateWay($gatewayName){
        return Application :: getDataGateway($gatewayName);
    }
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un contacto
	* @param string $contindentis 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function getByIdcontindentis($contindentis, $flag = false) {
		$objgateway = Application :: getDataGateway("Contacto");
		$rcResult = $objgateway->getByIdContacto($contindentis);
		
		if($rcResult[0]["cliecodigon"])
		{
			$objgateway = Application :: getDataGateway("cliente");
			$rcTmp = $objgateway->getByIdCliente($rcResult[0]["cliecodigon"]);
			if(is_array($rcTmp))
				$rcResult[0]["cliecodigos"] = "(".$rcTmp[0]["clieidentifs"].")<br>".$rcTmp[0]["clienombres"]."<br>Tels: ".$rcTmp[0]["clietelefons"]."<br>".$rcTmp[0]["clielocalizs"];
		}
		if ($flag == false)
			$this->close();
		return $rcResult;
	}
	
	function getByIdContacto($contindentis, $flag = false) {
		$objgateway = Application :: getDataGateway("Contacto");
		$rcResult = $objgateway->getByIdContacto($contindentis);
		
		if ($flag == false)
			$this->close();
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un contacto
	* @param string $contindentis 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function getByIdInfractor($infrcodigos, $flag = false) {
		$objgateway = Application :: getDataGateway("infractor");
		$rcResult = $objgateway->getByIdInfractor($infrcodigos);
		if ($flag == false)
			$this->close();
		return $rcResult;
	}

	function getByIdContratoCLiente($contnics, $flag = false) {
		$objgateway = Application :: getDataGateway("CentroConsulta");
		$rcResult = $objgateway->getContratoByNic($contnics);
		if ($flag == false)
			$this->close();
		return $rcResult;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un cliente
	* @param string $contindentis 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function getByIdCliente($cliecodigos, $flag = false) {
		$objgateway = Application :: getDataGateway("Cliente");
		$rcResult = $objgateway->getByIdCliente($cliecodigos);
		if ($flag == false)
			$this->close();
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de un cliente
	* @param string $contindentis 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function getCliente($clieidentifs, $flag = false) {
		$objgateway = Application :: getDataGateway("CentroConsulta");
		$rcResult = $objgateway->getCliente($clieidentifs);
		if ($flag == false)
			$this->close();
		return $rcResult;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta un producto de un contrato
	* @param string $contnics 
	* @param string $prodcodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 12-may-2005 10:24:41
	* @location Cali-Colombia
	*/
    function getProdByContnicByProdcodigos($contnics,$prodcodigos,$flag = false){
		$objgateway = Application :: getDataGateway("CentroConsulta");
		$rcResult = $objgateway->getProdByContnicByProdcodigos($contnics,$prodcodigos);
		if ($flag == false)
			$this->close();
		return $rcResult;
    }
	/**
	* @Copyright 2004 � FullEngine
	*
	* Consulta todos los caontactos activos ordenados por el nombre
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 12:36:46
	* @location Cali - Colombia
	*/
	function getAllActiveContacto(){
		$gateway = Application :: getDataGateway("sqlExtended");
		$rcResult = $gateway->getDataCombo("contacto");
		$this->close();
		return $rcResult;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Consulta todos los caontactos 
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 12:36:46
	* @location Cali - Colombia
	*/
	function getAllContacto(){
		$gateway = Application :: getDataGateway("contacto");
		$rcResult = $gateway->getAllContacto();
		$this->close();
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el contacto existe y esta activo, por medio de su identificacion
	* @param string $sbContindentis Identificacion del contacto
	* @param boolean $sbFlag Indica si se cierra o no el servicio
	* @return integer 0 no existe 1 existe
	* @author freina<freina@parquesoft.com>
	* @date 25-Oct-2006 15:59
	* @location Cali-Colombia
	*/
	function existActiveContactoByIdentis($sbContindentis, $sbFlag = true) {
		
		settype($objGateway,"object");
		settype($nuResult,"integer");
		$objGateway = Application :: getDataGateway("Contacto");
		$nuResult = $objGateway->existActiveContactoById($sbContindentis);
		if ($sbFlag){
			$this->close();
		}
		if($nuResult){
			return true;
		}
		return false;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta todos los tipos de identificacion activos
	* @param boolean $sbFlag True o False, indica si se debe cerrar el servicio
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 15-Jan-2007 17:22
	* @location Cali-Colombia
	*/
	function getAllTipoidentifi($sbFlag=true) {
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		$objGateway = Application :: getDataGateway("sqlExtended");
		$rcResult = $objGateway->getAllTipoidentifi();
		if($sbFlag){
			$this->close();
		}
		return $rcResult;
	}
	/**
	* @copyright Copyright 2010 &copy; FullEngine
	*
	* Consulta todos los tipos de cliente activos
	* @param boolean $sbFlag True o False, indica si se debe cerrar el servicio
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 30-Oct-2010 10:43
	* @location Cali-Colombia
	*/
	function getAllTipocliente($sbFlag=true) {
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		$objGateway = Application :: getDataGateway("tipocliente");
		$rcResult = $objGateway->getAllTipocliente();
		if($sbFlag){
			$this->close();
		}
		return $rcResult;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el solicitante existe y esta activo, por medio de su id
	* @param string $sbSolicodigos Identificacion del contacto
	* @param boolean $sbFlag Indica si se cierra o no el servicio
	* @return boolean true  existe false no existe
	* @author freina<freina@parquesoft.com>
	* @date 04-Sep-2012 16:40
	* @location Cali-Colombia
	*/
	function existActiveSolicitanteByIdentis($sbSolicodigos, $sbFlag = true) {
		
		settype($objGateway,"object");
		settype($rcTmp,"array");
		settype($sbStatus,"string");
		
		$sbStatus = Application :: getConstant("REG_ACT");
		$objGateway = Application :: getDataGateway("Solicitante");
		$objGateway->setData(array("solicodigos"=>$sbSolicodigos,"soliactivos"=>$sbStatus));
		$objGateway->getSolicitante();
		$rcTmp = $objGateway->getResult();
		if ($sbFlag){
			$this->close();
		}
		if(is_array($rcTmp) && $rcTmp){
			return true;
		}
		return false;
	}
}
?>