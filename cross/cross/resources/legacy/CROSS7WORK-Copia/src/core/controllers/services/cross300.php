<?php  
/**
	Copyright 2004  FullEngine
	
	Servicio de manejo de productos
	@author cazapata <cazapata@parquesoft.com>
	@date 14-Sep-2004 12:53:44
	@location Cali-Colombia
*/
class Cross300 {

	var $appName;
	var $appDir;
	function Cross300(){
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/cross300";
		$name = "cross300";
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
		$rcinfo = array ("getAllOrden" => "Copyright 2004  FullEngine<br>
											Obtiene el listado de las ordenes <br>
											@return array<br>
											@author cazapata<cazapata@parquesoft.com><br>
											@date 14-Sep-2004 12:57<br>
											@location Cali-Colombia",
						  "getOrden" =>	"Copyright 2004  FullEngine<br>
											Obtiene la orden buscada <br>
											@param string \$ordenumeros (Numero de orden)<br>
											@return array<br>
											@author cazapata<cazapata@parquesoft.com><br>
											@date 14-Sep-2004 12:57<br>
											@location Cali-Colombia",
						"getContrato"=>"Copyright 2004  FullEngine
											Obtiene el contrato de un requerimiento
											@param string $isbordenumeros (Cadena con el codigo de la orden)
											@param boolean $iblflag (Indica si el servicio se debe dejar abierto)
											@return string $osbresult (Cadena con el codigo del contrato)
											@author freina <freina@parquesoft.com>
											@date 08-Oct-2004 06:11
											@location Cali-Colombia",
						"InitiateClass"=>"Copyright 2004  FullEngine
											Inicia una clase (Regla)
											@param string $isbclass (Cadena con el nombre de la clase)
											@author freina <freina@parquesoft.com>
											@date 15-Oct-2004 14:16
											@location Cali-Colombia",
						"getDataEmail"=>"Copyright 2004  FullEngine		
											Obtiene los datos del email
											@param array $ircdata (Arreglo con el conjunto de parametros)
		 									@return array $orcresult (Arreglo con la data)
											$orcresult[tipo] = tipo del e-mail (requerido)
											$orcresult[asunto] = Asunto (requerido)
											$orcresult[texto] = mensaje (requerido)
											$orcresult[requerimiento] = Numero de requerimiento (opcional)
											$orcresult[responsable] = Responsable (requerido)
											$orcresult[dir_origen] = Direccion electronica origen (requerido)
											$orcresult[dir_destino] = Direccion electronica destino (requerido)
											$orcresult[usuario] = Usuario quien registra el email (requerido)
											$orcresult[adjunto] = Direccion absoluta de los documentos adjuntos opcional)
											@author freina <freina@parquesoft.com>
											@date 16-Oct-2004 14:21
											@location Cali-Colombia	",
						"fncValidateExistenceOrder"=>"Copyright 2004  FullEngine
																		 Valida la existencia de un requerimiento
																		 @param string $isbordenumeros (Cadena con el codigo del requerimiento)
																		 @param boolean $blflag (boolean, cierra el servicio)
																		 @return $osbresult boolean (true o false)
																		 @author freina <freina@parquesoft.com>
																		 @date 19-Oct-2004 14:58
																		@location Cali-Colombia",
					     "fncDataRequirementCommunication"=>"Copyright 2004  FullEngine	
	  																				  Obtiene los datos para la comunicacio (estos datos pueden variar de acuerdo a la implementacion)
	  																				  @param string $isbordenumeros (Cadena con el codigo de requerimiento)
	  																				  @return array $orcresult (Arreglo con la data del requerimiento)
	  																				  @author freina <freina@parquesoft.com>
	  																				  @date 28-Oct-2004 07:49
	  																				  @location Cali-Colombia",
	  					  "DetermineRelationsGroup"=>"Copyright 2004  FullEngine
	  					  												   Determina si el grupo ha sido relacionado en alguna instancia de proceso
	  					  												   @param string $isbgrupo (Cadena con el codigo del grupo)
	  					  												   @param string $isbflag (Cadena que determina si se cierra o no el servicio)
	  					  												   @return array $orcresult (Arreglo con la data del requerimiento)
	  					  												   @author freina <freina@parquesoft.com>
	  					  												   @date 12-Nov-2004 15:04
	  					  												   @location Cali-Colombia",
	  					  "getSqlActiveEvento"=>"Copyright 2004  FullEngine" .
	  					  									  "Obtiene	 el sql de los eventos activos de acuerdo a un tipo de" .
	  					  									  "	requerimiento	 especificado (Servicio Generico)" .
	  					  									  "@return string" .
	  					  									  "@author freina <freina@parquesoft.com>" .
	  					  									  "@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)".
	  					  									  "@date 12-Ene-2005 15:01" .
	  					  									  "@location Cali-Colombia",
	  					  "getSqlActiveTipoorden"=>"Copyright 2004  FullEngine" .
	  					  									  "Obtiene el sql de los tipos de requerimientos activos (Servicio Generico)" .
	  					  									  "@return string" .
	  					  									  "@author freina <freina@parquesoft.com>" .
	  					  									  "@date 12-Ene-2005 15:31" .
	  					  									  "@location Cali-Colombia",
	  					  "getDataActiveEvento"=>"Copyright 2004  FullEngine" .
	  					  										 "Obtiene el registro de una clasificacion por medio de su llave (Servicio generico)" .
	  					  										 "@return	 array" .
	  					  										 "@author	 freina <freina@parquesoft.com>" .
	  					  										 "@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)" .
	  					  										 "@param	 string $isbevencodigos (Cadena cn el codigo de laclasificacion)" .
	  					  										 "@date	 14-Ene-2005 16:44" .
	  					  										 "@location	 Cali-Colombia",
	  					  "getDataActiveTipoorden"=>"Copyright 2004  FullEngine" .
	  					  											 "Obtiene	 el registro de un tipo de requerimiento activo (Servicio generico)" .
	  					  											 "	@return	 array" .
	  					  											 "@author	 freina <freina@parquesoft.com>" .
	  					  											 "@param	 string $isbtiorcodigos (Cadena con el tipo de requerimiento)" .
	  					  											 "@date	 14-Ene-2005 16:52" .
	  					  											 "@location	 Cali-Colombia",
	  					  "getSqlActiveCausa"=>"Copyright 2004  FullEngine" .
	  					  									 "Obtiene	 el sql de las subclasificacoines activas de acuerdo a un tipo de requerimiento " .
	  					  									 "y a una clasificacion especificados (Servicio Generico)" .
	  					  									 "	@return	 string" .
	  					  									 "@author	 freina <freina@parquesoft.com>" .
	  					  									 "@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)" .
	  					  									 "@param	 string $isbevencodigos (Cadena con el codigo de clasificacion)" .
	  					  									 "@date	 18-Ene-2005 09:52" .
	  					  									 "@location	 Cali-Colombia",
	  					  "getDataActiveCausa"=>"Copyright 2004  FullEngine" .
	  					  									   "Obtiene el registro de una subclasificacion por medio de su llave" .
	  					  									   "@return	 array" .
	  					  									   "@author	 freina <freina@parquesoft.com>" .
	  					  									   "@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)" .
	  					  									   "@param	 string $isbevencodigos (Cadena cn el codigo de la clasificacion)" .
	  					  									   "	@param	 string $isbcauscodigos (Cadena con el codigo de la subclasificacion)" .
	  					  									   "@date	 18-Ene-2005 09:54" .
	  					  									   "@location	 Cali-Colombia",
	  					  "existTipoordenBySchecodigon"=>"Copyright 2004  FullEngine" .
	  					  	  "Determina si existen tipos de caso asociados a un contexto" .
	  					  	  "@return true or false" .
	  					  	  "@author freina <freina@parquesoft.com>" .
	  					  	  "@param Integer $nuSchecodigon Entero con el id del contexto" .
	  					  	  "@date 22-Mar-2006 12:29" .
	  					  	  "@location Cali-Colombia");

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
	/**
		Copyright 2004  FullEngine
		
		Obtiene el listado de las ordenes
		@return array
		@author cazapata <cazapata@parquesoft.com>
		@date 14-Sep-2004 13:02
		@location Cali-Colombia		
	*/
	function getAllOrden(){
		//Instancio la compuerta de ordenes
		$gateway = Application :: getDataGateway("Orden");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getAllOrden();
		$this->close();
		return $rcElemens;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene la orden de la tabla orden
		@param string $ordenumeros Codigo de orden
		@return array
		@author cazapata <cazapata@parquesoft.com>
		@date 15-Sep-2004 17:02
		@location Cali-Colombia		
	*/
	function getOrden($ordenumeros,$blflag=true) {
		//Instancio la compuerta de ordenes
		$gateway = Application :: getDataGateway("Orden");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getByIdOrden($ordenumeros);
		if($blflag==true)
			$this->close();
		return $rcElemens;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene la orden de la tabla ordenempresa
		@param string $ordenumeros Codigo de orden
		@return array
		@author cazapata <cazapata@parquesoft.com>
		@date 28-Sep-2004 09:31
		@location Cali-Colombia		
	*/
	function getOrdenEmpresa($ordenumeros) {
		//Instancio la compuerta de ordenes
		$gateway = Application :: getDataGateway("OrdenempresaExtended");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getByIdOrdenempresajoin($ordenumeros);
		$this->close();
		return $rcElemens;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene la orden de la tabla actaempresa
		@param string $actacodigoss numero de la acta
		@return array
		@author cazapata <cazapata@parquesoft.com>
		@date 28-Sep-2004 09:31
		@location Cali-Colombia		
	*/
	function getListadoActaEmpresa($actacodigos,$blflag=true) {
		//Instancio la compuerta de ordenes
		$gateway = Application :: getDataGateway("SqlExtended");
		//Llamo el metodo que hace la consulta
		$rcElemens = $gateway->getListActaempresa($actacodigos);
		if($blflag==true)
			$this->close();
		return $rcElemens;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene el contrato de un requerimiento
		@param string $isbordenumeros (Cadena con el codigo de la orden)
		@param boolean $iblflag (Indica si el servicio se debe dejar abierto)
		@return string $osbresult (Cadena con el codigo del contrato)
		@author freina <freina@parquesoft.com>
		@date 08-Oct-2004 06:11
		@location Cali-Colombia		
	*/
	function getContrato($isbordenumeros,$iblflag=false) {
		settype($objgateway,"object");
		settype($rctmp,"array");
		settype($osbresult,"string");
		//Instancio la compuerta de ordenempresa
		$objgateway = Application :: getDataGateway("Ordenempresa");
		//Llamo el metodo que hace la consulta
		$rctmp = $objgateway->getByIdOrdenempresa($isbordenumeros);
		if($iblflag){
			$this->close();
		}
		if($rctmp){
			$osbresult = $rctmp[0]["contnics"];
		}
		return $osbresult;
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
		
		Obtiene los datos del email
		@param array $ircdata (Arreglo con el conjunto de parametros)
		* @return array $orcresult (Arreglo con la data)
		*$ircdata["tipo"] = tipo del e-mail (requerido)
		*$ircdata["asunto"] = Asunto (requerido)
		*$ircdata["texto"] = mensaje (requerido)
		*$ircdata["requerimiento"] = Numero de requerimiento (opcional)
		*$ircdata["responsable"] = Responsable (requerido)
		*$ircdata["dir_origen"] = Direccion electronica origen (requerido)
		*$ircdata["dir_destino"] = Direccion electronica destino (requerido)
		*$ircdata["usuario"] = Usuario quien registra el email (requerido)
		*$ircdata["adjunto"] = Direccion absoluta de los documentos adjuntos opcional)
		@author freina <freina@parquesoft.com>
		@date 16-Oct-2004 14:21
		@location Cali-Colombia		
	*/
	function getDataEmail($ircdata) {
		
		settype($objtmp,"object");
		settype($orcresult,"array");
		
		//Instancio la clase
		$objtmp = Application :: getDomainController("DataEmailManager");
		$orcresult = $objtmp->getDataEmail($ircdata);
		$this->close();
		return $orcresult;
	}
	/**
		Copyright 2004  FullEngine
		
		Valida la existencia de un requerimiento
		@param string $isbordenumeros (Cadena con el codigo del requerimiento)
		@param boolean $blflag (boolean, cierra el servicio)
		@return $osbresult boolean (true o false)
		@author freina <freina@parquesoft.com>
		@date 19-Oct-2004 14:58
		@location Cali-Colombia		
	*/
	function fncValidateExistenceOrder($isbordenumeros,$blflag=true) {
		
		settype($gateway,"object");
		settype($osbresult,"string");
		settype($nuresult,"integer");
		
		//Instancio la compuerta de ordenes
		$gateway = Application :: getDataGateway("Orden");
		//Llamo el metodo que hace la consulta
		$nuresult = $gateway->existOrden($isbordenumeros);
		if($blflag==true){
			$this->close();
		}
		if($nuresult){
			$osbresult = true;
		}
		else{
			$osbresult = false;
		}
		return $osbresult;
	}
	/**
	*	Copyright 2004  FullEngine
	*	
	*	Obtiene los datos para la comunicacio (estos datos pueden variar de acuerdo a la implementacion)
	*	@param string $isbordenumeros (Cadena con el codigo de requerimiento)
	*	@return array $orcresult (Arreglo con la data del requerimiento)
	*	@author freina <freina@parquesoft.com>
	*	@date 28-Oct-2004 07:49
	*	@location Cali-Colombia		
	*/
	function fncDataRequirementCommunication($isbordenumeros,$flag=true) {
		
		settype($objtmp,"object");
		settype($orcresult,"array");
		
		//Instancio la clase
		$objtmp = Application :: getDomainController("DataComunicacionManager");
		$orcresult = $objtmp->getDataComunicacion($isbordenumeros);
		if($flag){
			$this->close();
		}
		return $orcresult;
	}
	/**
	*	Copyright 2004  FullEngine
	*	
	*	Determina si el grupo ha sido relacionado en alguna instancia de proceso
	*	@param string $isbgrupo (Cadena con el codigo del grupo)
	*	@param string $isbflag (Cadena que determina si se cierra o no el servicio)
	*	@return array $orcresult (Arreglo con la data del requerimiento)
	*	@author freina <freina@parquesoft.com>
	*	@date 12-Nov-2004 15:04
	*	@location Cali-Colombia		
	*/
	function DetermineRelationsGroup($isbgrupo,$isbflag=true) {
		
		settype($objtmp,"object");
		settype($orcresult,"array");
		
		//Instancio la clase
		$objtmp = Application :: getDataGateway("ActaempresaExtended");
		$orcresult = $objtmp->DetermineGroupRelatedProcess($isbgrupo);
		if($isbflag){
			$this->close();
		}
		if($orcresult){
			return true;
		}
		return false;
	}
	
	/**Copyright 2004  FullEngine
		
		*	Obtiene	 el sql de los eventos activos de acuerdo a un tipo de
		*	requerimiento	 especificado (Servicio Generico)
		*	@return	 string
		*	@author	 freina <freina@parquesoft.com>
		*	@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)
		*	@date	 12-Ene-2005 15:01
		*	@location	 Cali-Colombia
	*/
	function getSqlActiveEvento($isbtiorcodigos) {
		
		settype($objgateway,"object");
		settype($osbsql,"string");
		//Instancio la compuerta de eventos (clasificaciones)
		$objgateway = Application :: getDataGateway("eventoExtended");
		//Llamo el metodo que obtiene el sql
		$osbsql = $objgateway->getAllActiveEvento($isbtiorcodigos);
		$this->close();
		return $osbsql;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene el sql de los tipos de requerimientos activos (Servicio Generico)
		@return string
		@author freina <freina@parquesoft.com>
		@date 12-Ene-2005 15:31
		@location Cali-Colombia		
	*/
	function getSqlActiveTipoorden() {
		
		settype($objgateway,"object");
		settype($osbsql,"string");
		//Instancio la compuerta de tipos de requerimiento (clasificaciones)
		$objgateway = Application :: getDataGateway("tipoordenExtended");
		//Llamo el metodo que obtiene el sql
		$osbsql = $objgateway->getAllActiveTipoorden();
		$this->close();
		return $osbsql;
	}
	/**Copyright 2004  FullEngine
		
		*	Obtiene el registro de una clasificacion por medio de su llave
		*	@return	 array
		*	@author	 freina <freina@parquesoft.com>
		*	@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)
		*	@param	 string $isbevencodigos (Cadena cn el codigo de la
		*clasificacion)
		*	@date	 14-Ene-2005 16:44
		*	@location	 Cali-Colombia
	*/
	function getDataActiveEvento($isbtiorcodigos,$isbevencodigos) {
		
		settype($objgateway,"object");
		settype($orcresult,"array");
		//Instancio la compuerta de eventos (clasificaciones)
		$objgateway = Application :: getDataGateway("eventoExtended");
		//Llamo el metodo que obtiene la data
		$orcresult = $objgateway->getActiveEvento($isbtiorcodigos,$isbevencodigos);
		$this->close();
		return $orcresult;
	}
	/**Copyright 2004  FullEngine
		
		*	Obtiene	 el registro de un tipo de requerimiento activo (Servicio
		*generico)
		*	@return	 array
		*	@author	 freina <freina@parquesoft.com>
		*	@param	 string $isbtiorcodigos (Cadena con el tipo de
		*requerimiento)
		*	@date	 14-Ene-2005 16:52
		*	@location	 Cali-Colombia
	*/
	function getDataActiveTipoorden($isbtiorcodigos) {
		
		settype($objgateway,"object");
		settype($orcresult,"array");
		//Instancio la compuerta de tipos de requerimiento (clasificaciones)
		$objgateway = Application :: getDataGateway("tipoordenExtended");
		//Llamo el metodo que obtiene la data
		$orcresult = $objgateway->getActiveTipoorden($isbtiorcodigos);
		$this->close();
		return $orcresult;
	}
	/**Copyright 2004  FullEngine
		
		*	Obtiene		 el sql de las subclasificacoines activas de acuerdo a
		* un tipo de requerimientoy a una clasificacion especificados (Servicio
		* Generico)
		*	@return	 string
		*	@author	 freina <freina@parquesoft.com>
		*	@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)
		*	@param	 string $isbevencodigos (Cadena con el codigo de
		* clasificacion)
		*	@date	 18-Ene-2005 09:52
		*	@location	 Cali-Colombia
	*/
	function getSqlActiveCausa($isbtiorcodigos,$isbevencodigos) {
		
		settype($objgateway,"object");
		settype($osbsql,"string");
		//Instancio la compuerta de eventos (clasificaciones)
		$objgateway = Application :: getDataGateway("causaExtended");
		//Llamo el metodo que obtiene el sql
		$osbsql = $objgateway->getAllActiveCausa($isbtiorcodigos,$isbevencodigos);
		$this->close();
		return $osbsql;
	}
	/**Copyright 2004  FullEngine
		
		*	Obtiene el registro de una subclasificacion por medio de su llave
		*	@return	 array
		*	@author	 freina <freina@parquesoft.com>
		*	@param string $isbtiorcodigos (Cadena con el tipo de requerimiento)
		*	@param	 string $isbevencodigos (Cadena cn el codigo de la
		*clasificacion)
		*	@param	 string $isbcauscodigos (Cadena con el codigo de la
		*subclasificacion)
		*	@date	 18-Ene-2005 09:54
		*	@location	 Cali-Colombia
	*/
	function getDataActiveCausa($isbtiorcodigos,$isbevencodigos,$isbcauscodigos) {
		
		settype($objgateway,"object");
		settype($orcresult,"array");
		//Instancio la compuerta de eventos (clasificaciones)
		$objgateway = Application :: getDataGateway("causaExtended");
		//Llamo el metodo que obtiene la data
		$orcresult = $objgateway->getActiveCausa($isbtiorcodigos,$isbevencodigos,$isbcauscodigos);
		$this->close();
		return $orcresult;
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
    
    /**Copyright 2004  FullEngine
		
	* Determina si existen tipos de caso asociados a un contexto 
	* @return true or false
	* @author freina <freina@parquesoft.com>
	* @param Integer $nuSchecodigon Entero con el id del contexto
	* @date	 22-Mar-2006 12:29
	* @location	 Cali-Colombia
	*/
	function existTipoordenBySchecodigon($nuSchecodigon) {
		
		settype($objGateway,"object");
		settype($objGatewayC,"object");
		
		$objGateway = Application :: getDataGateway("changeScheme");
		if($objGateway->amountTipoordenBySchecodigon($nuSchecodigon) == 0){
			$this->close();
    		return false;
    	}
    	$this->close();
    	return true;
	}
	
		function existsAtentionByActa($isbActacodigos) 
	{
		settype($objGateway,"object");
		
		$objGateway = Application :: getDataGateway("actaempresaExtended");
		if($objGateway->getActaempresaByActacodigos($isbActacodigos))
		{
			$this->close();
    		return true;
		}
    	else
    	{
    		$this->close();
	    	return false;
    	}
	}
}
?>