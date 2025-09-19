<?php  
/**
	Copyright 2004  FullEngine
	
	Servicio de manejo de productos
	@author cazapata <cazapata@parquesoft.com>
	@date 14-Sep-2004 12:53:44
	@location Cali-Colombia
*/
class Schedule {

	var $appName;
	var $appDir;
	var $rcEntradas;
	var $rcEntes;
	var $ordenumeros;
	var $entrfechorun;
	
	function Schedule(){
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/schedule";
		$name = "schedule";
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
		$rcinfo = array ("updEndAllEvents" => "Copyright 2007  FullEngine<br>
											Finaliza todas las citas asociadas a un acta <br>
											@return array<br>
											@author muñe<mrestreepo@parquesoft.com><br>
											@date 29-Apr-2007 12:57<br>
											@location Cali-Colombia",
						  "updEndOneEvents" =>	"Copyright 2007  FullEngine<br>
											Finaliza una cita asociadas a un acta <br>
											@return array<br>
											@author muñe<mrestreepo@parquesoft.com><br>
											@date 29-Apr-2007 12:57<br>
											@location Cali-Colombia",);

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
		Copyright 2007  FullEngine
		Finaliza todas las citas asociadas a un acta <br>
		@return array<br>
		@author muñe<mrestreepo@parquesoft.com><br>
		@date 29-Apr-2007 12:57<br>
		@location Cali-Colombia
	*/
	function updEndAllEvents($entrcodigon,$actacodigos)
	{
		$objSchedule = Application::getDomainController("ScheduleManager");
		$objSchedule->updEndAllEvents($entrcodigon,$actacodigos);
		$this->close();
	}
	
	/**
		Copyright 2007  FullEngine
		Finaliza todas las citas asociadas a un acta <br>
		@return array<br>
		@author muñe<mrestreepo@parquesoft.com><br>
		@date 29-Apr-2007 12:57<br>
		@location Cali-Colombia
	*/
	function updEndOneEvent($entrcodigon,$actacodigos,$nuDateHour)
	{
		$objSchedule = Application::getDomainController("ScheduleManager");
		$objSchedule->updEndOneEvent($entrcodigon,$actacodigos,$nuDateHour);
		$this->close();
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
    * Copyright 2007 FullEngine
    * 
    * Carga una compuerta de esta modulo
    * @author mrestrepo
    * @param type actacodigos desc
    * @return type true,false bool
    * @date 28-May-2007 15:50
    * @location Cali-Colombia
    */
    function blHasEntries($actacodigos){
        $objExtended = $this->getGateWay("entradaExtended");
        $this->rcEntradas = $objExtended->getRelatedEventsByActa($actacodigos);
        return is_array($this->rcEntradas);
    }

    /**
    * Copyright 2007 FullEngine
    * 
    * Carga una compuerta de esta modulo
    * @author mrestrepo
    * @param type actacodigos desc
    * @return type true,false bool
    * @date 28-May-2007 15:50
    * @location Cali-Colombia
    */
    function blHasAvailability($orgacodigos)
    {
    	settype($blAvailable,"boolean");
    	settype($nuCont,"integer");
    	
    	$objExtended = Application::getDomainController("EntradaManager");
    	foreach ($this->rcEntradas as $rcRow) 
    	{
    		$blAvailable = $objExtended->blHasAvailability($rcRow["entrcodigon"],$orgacodigos);
    		if($blAvailable === false)
    			return false;
    		$nuCont++;
    	}
    	if($nuCont)
    		$blAvailable = true;
        return $blAvailable;
    }
    
    function updateEntesEntrada($rcCitasAgenda,$newOrgacodigos,$oldOrgacodigos)
    {
    	settype($rcEntradas,"array");
    	settype($sbEntradas,"string");
    	
    	if(is_array($rcCitasAgenda))
    	{
    		foreach ($rcCitasAgenda as $rcRow) {
    			$rcEntradas[] = $rcRow["entrcodigon"];
    		}
    		$sbEntradas = join(",",$rcEntradas);
    		$objExtended = $this->getGateWay("entradaExtended");
    		$objExtended->updateEntesEntrada($sbEntradas,$newOrgacodigos,$oldOrgacodigos);
    	}
    }
    
    /**
    * Copyright 2007 FullEngine
    * 
    * Agrega una entrada a la agenda, se puede disparar desde cualquier módulo (API)
    * los datos de expediente y rcorgacodigos son opcionales
    * los datos de ordenumeros, actacodigos y orgacodigosTarea son necesarios para afectar la agenda del mediador
    * @author mrestrepo
    * @param type $rcDatosCita array compuesto de "actacodigos","actafechingn","ordenumeros","orgacodigos",
    * 											  "ordenumexps" si aplica, "rcOrgacodigos": lista de RRFF o RRHH si aplica
    * @return type true,false bool
    * @date 13-Jun-2007 11:50
    * @location Cali-Colombia
    */
    function AddEntradaAPI($ircDatosCita)
    {
    	settype($blResult,"boolean");
    	
    	//Si por alguna razón desconocida esta tarea ya tiene entradas en la agenda, pues para qué la programamos??
    	if($this->blHasEntries($ircDatosCita["actacodigos"])) {
    		$this->close();
    		return false;
    	}
    		
    	$objEntrada = Application::getDomainController("EntradaManager");
    	$blResult = $objEntrada->AddEntradaAPI($ircDatosCita);
    	
    	$this->close();
    	return $blResult;
    }
    
    /**
    * Copyright 2007 FullEngine
    * 
    * Devuelve la fecha hora de la sesión de mediación activa dado el número del caso
    * @author mrestrepo
    * @param type $isbOrdenumeros string con el número del caso
    * @return type integer con el timestamp o con cero
    * @date 07-Aug-2007 16:41
    * @location Cali-Colombia
    */
    function getDateHourSession()
    {
    	if($this->ordenumeros)
    	{
	    	$objEntrada = Application::getDomainController("EntradaManager");
	    	$this->entrfechorun = $objEntrada->getDateHourSession($this->ordenumeros);
    	}
    	else 
    		$this->entrfechorun = 0;
    }
    
    function getCagetories()
    {
    	$gateway = $this->getGateWay("categoria");
    	$rcTmp = $gateway->getAllCategoria();
    	$this->close();
    	return $rcTmp;
    }
}
?>