<?php
class FeScScheduleManager
{
	//array $rcVizParam arreglo con las opciones de visualización (E,O,A) o (O,A)
    var $rcVizParam;
    var $rcExpedientes;
    var $rcOrdenes;
    var $rcActas;
    var $rcEntes;
    var $rcFiscales;
    var $gateway;
    var $gatewayEntrada;
    var $blJudge = false;
    
    function FeScScheduleManager()
    {
     	$this->gateway = Application::getDataGateway("sqlExtended");
     	$this->gatewayEntrada = Application::getDataGateway("entradaExtended");
    }

    /**
		Copyright 2004  FullEngine
		
		Obtiene los datos necesarios para agendar una sesion de mediación, seguimiento, etc.
		@param array $rcEntes arreglo indexado numérico con los códigos de los entes organizacionales
		@param array $rcValoresOpciones arreglo indexado numérico con los valores de las opciones de visualización (config)
		@return array con la colección de expedientes,casos y actas, ó sólo casos y actas
		@author mrestrepo <mrestrepo@parquesoft.com>
		@date 19-Apr-2007 20:02
		@location Cali-Colombia		
	*/
    function getDataOrder($rcValoresOpciones,$orgacodigos)
    {
    	settype($rcValoresOpciones,"array");
    	settype($rcOrdenes,"array");
    	settype($objCross,"object");
    	
    	//Si está encendida la opción de ver_expedientes, iniciamos la búsqueda en los expedientes de los entes
    	//sino, la iniciamos en las órdenes de los entes
    	if(in_array($rcValoresOpciones["VER_ORD"],$this->rcVizParam))
    	{
    		//Cargamos el servicio cross300 para tener acceso directo a los datos de los expedientes y casos
    		$objWF = Application::loadServices("Workflow");
    	
    		//Hallamos las órdenes a cargo de los entes
    		$this->rcOrdenes = $objWF->getOrdenes($orgacodigos);
    		$objWF->close();
    	}
    	else
    		return false;

    	//Cerramos el servicio
    	return true;
    }
    
    function getDetallesEventosDependencia($user,$startdate,$enddate,$nuCateg,$username)
    {
    	settype($rcReturn,"array");
    	$objDate = Application::loadServices("DateController");
    	
    	$rcHours = $this->gatewayEntrada->getDetallesEventosDependencia($user,$startdate,$enddate,$nuCateg,$username);
    	if(is_array($rcHours))
    	{
    		$nuSize = count($rcHours);
    		for($nuCont=0;$nuCont<$nuSize;$nuCont++)
    		{
    			$nuDateApp = $rcHours[$nuCont]["entrfechorun"];
    			if(is_array($rcHours["orga"]))
    				if(array_key_exists($rcHours[$nuCont]["entrcodigon"],$rcHours["orga"]))
    					$rcHours[$nuCont]["orga"] = $rcHours["orga"][$rcHours[$nuCont]["entrcodigon"]];
    			for ($nuDay=$startdate;$nuDay<=$enddate;)
    			{
    				$nuDay += $objDate->nuSecsHour;
	    			if($nuDay <= $nuDateApp && $nuDateApp < ($nuDay+$objDate->nuSecsHour))
	    			{
	    				$rcReturn[$nuDay][] = $rcHours[$nuCont];
	    				break;
	    			}
    			}
    		}
    	}
    	return $rcReturn;
    }  
    
    function getDetallesEventosUsuario($orgacodigos,$startdate,$enddate,$nuCateg,$username)
    {
    	settype($rcReturn,"array");
    	$objDate = Application::loadServices("DateController");
    	
    	$rcHours = $this->gatewayEntrada->getDetallesEventosUsuario($orgacodigos,$startdate,$enddate,$nuCateg,$username);
    	if(is_array($rcHours))
    	{
    		$nuSize = count($rcHours);
    		for($nuCont=0;$nuCont<$nuSize;$nuCont++)
    		{
    			$nuDateApp = $rcHours[$nuCont]["entrfechorun"];
    			if(is_array($rcHours["orga"]))
    				if(array_key_exists($rcHours[$nuCont]["entrcodigon"],$rcHours["orga"]))
    					$rcHours[$nuCont]["orga"] = $rcHours["orga"][$rcHours[$nuCont]["entrcodigon"]];
    			for ($nuDay=$startdate;$nuDay<=$enddate;)
    			{
    				$nuDay += $objDate->nuSecsHour;
	    			if($nuDay <= $nuDateApp && $nuDateApp < ($nuDay+$objDate->nuSecsHour))
	    			{
	    				$rcReturn[$nuDay][] = $rcHours[$nuCont];
	    				break;
	    			}
    			}
    		}
    	}
    	return $rcReturn;
    }    
    
    function getBusyDaysByDep($user,$startdate,$enddate,$nuCateg)
    {
    	settype($rcReturn,"array");
    	$objDate = Application::loadServices("DateController");
    	
    	$rcDays = $this->gatewayEntrada->getBusyDaysByDep($user,$startdate,$enddate,$nuCateg);
    	if(is_array($rcDays))
    	{
    		$nuSize = count($rcDays);
    		for($nuCont=0;$nuCont<$nuSize;$nuCont++)
    		{
    			$nuDateApp = $rcDays[$nuCont]["entrfechorun"];
    			$nuDay=$startdate;
    			while($nuDay<=$enddate)
    			{
	    			if($nuDay <= $nuDateApp && $nuDateApp <= ($nuDay+$objDate->nuSecsDay))
	    			{
	    				$rcReturn[$nuDay][] = $nuDateApp;
	    				break;
	    			}
	    			$nuDay += $objDate->nuSecsDay;
    			}
    		}
    	}
    	return $rcReturn;
    }
    
    function getBusyDaysByUser($user,$startdate,$enddate,$nuCateg)
    {
    	settype($rcReturn,"array");
    	$objDate = Application::loadServices("DateController");
    	
    	$rcDays = $this->gatewayEntrada->getBusyDaysByUser($user,$startdate,$enddate,$nuCateg);
    	if(is_array($rcDays))
    	{
    		$nuSize = count($rcDays);
    		for($nuCont=0;$nuCont<$nuSize;$nuCont++)
    		{
    			$nuDateApp = $rcDays[$nuCont]["entrfechorun"];
    			$nuDay=$startdate;
    			while($nuDay<=$enddate)
    			{
	    			if($nuDay <= $nuDateApp && $nuDateApp <= ($nuDay+$objDate->nuSecsDay))
	    			{
	    				$rcReturn[$nuDay][] = $nuDateApp;
	    				break;
	    			}
	    			$nuDay += $objDate->nuSecsDay;
    			}
    		}
    	}
    	return $rcReturn;
    }
    
    function updEndAllEvents($entrcodigon,$actacodigos)
    {
    	if($entrcodigon)
    		$rcEntradas = $this->gatewayEntrada->getRelatedEvents($entrcodigon);
    	else if($actacodigos)
    		$rcEntradas = $this->gatewayEntrada->getRelatedEventsByActa($actacodigos);
    	if(is_array($rcEntradas))
    		foreach ($rcEntradas as $nuCont=>$rcRow)
    			$this->updEndOneEvent($rcRow["entrcodigon"],false,false);
    }
    
    function updEndOneEvent($entrcodigon,$actacodigos,$nuDateHour)
    {
    	//manager de entradas
    	$objEntrada = Application::getDomainController("EntradaManager");
    	
    	//Estados que toman las entradas
    	$sbOK = Application::getConstant("ENTRY_CONFIR_STATUS");
    	$sbCancel = Application::getConstant("ENTRY_CANCEL_STATUS");
    	
    	// 1 -  CUMPLIMENTAR LAS ENTRADAS ANTERIORES O IGUALES A LA FECHAHORA DE ATENCIÓN
    	if($entrcodigon)
    		$objEntrada->updateStatusEvent($entrcodigon,$sbOK);
    	elseif ($actacodigos)
    		$objEntrada->updateStatusEventByActa($actacodigos,$sbOK,$nuDateHour,"<=");
    		
    	// 2 -  CANCELAR LAS ENTRADAS ESTRICTAMENTE POSTERIORES A LA FECHAHORA DE ATENCIÓN
    	if($actacodigos)
    		$objEntrada->updateStatusEventByActa($actacodigos,$sbCancel,$nuDateHour,">");
    }
}
?>