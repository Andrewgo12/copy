<?php
class FeScEntradaManager
{
    var $gateway;
    var $gatewayext;
    var $gatewayref;
    
    function FeScEntradaManager()
    {
     $this->gateway = Application::getDataGateway("entrada");
     $this->gatewayext = Application::getDataGateway("entradaExtended");
     $this->sqlExtended = Application :: getDataGateway("sqlExtended");
     $this->gatewayref = Application::getDataGateway("refercross");
    }

    function addEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris)
    {
      if($this->gateway->existEntrada($entrcodigon) == 0){
          $this->gateway->addEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris)
    {
      if($this->gateway->existEntrada($entrcodigon) == 1){
          $this->gateway->updateEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }

    function updateStatusEntrada($entrcodigon,$sbStatus)
    {
    	if($this->gateway->existEntrada($entrcodigon) == 1)
    	{
    		//Necesitamos saber si la cita ya pasó o no
    		$objDate = Application::loadServices("DateController");
    		$rcInfoEntrada = $this->getByIdEntrada($entrcodigon);
    		
    		//Necesitamos saber si la cita ya pasó o no. true si ya pasó, false si no
    		$blPasada = ($rcInfoEntrada[0]["entrfechorun"]<$objDate->fncintdatehour());
    			
    		//true si existen datos de cross asociados a la cita, false si no
    		$rcDataCross = $this->gatewayref->getReferCrossByEntrada($entrcodigon);
    		if(is_array($rcDataCross))
    		{
    			$blCross = true;
    			
    			//Verifiquemos si existe alguna atención para el acta asociada a la cita
    			//es decir, si al menos una de las citas relacionadas al acta ha sido cumplida
	    		$objCross = Application::loadServices("Cross300");
		    	$blAtendida = $objCross->existsAtentionByActa($rcDataCross["actacodigos"]);
		    	
		    	//Retomar el control
		    	$this->gatewayext = Application::getDataGateway("entradaExtended");
    		}
    		if($sbStatus == Application::getConstant("ENTRY_CONFIR_STATUS"))
    		{
    			if($blCross)
    			{
	    			//Sólo se puede cumplimentar si existe al menos una atención para el acta
	    			if($blAtendida===false)
	    				return 27;
    			}
    		}
    		elseif($sbStatus == Application::getConstant("ENTRY_CANCEL_STATUS"))
    		{
    			if($blPasada)
    			{
    				if($blCross)
    					return 26;
    			}
    			else if($blAtendida===false)
	    			return 27;
    				
    		}
    		$this->gatewayext->updateStatusEntrada($entrcodigon,$sbStatus);
    		$this->UnsetRequest();
    		return 3;
    	}
    	else
    	{
    		return 2;
    	}
    }
    
	function updateStatusEvent($entrcodigon,$entractivas)
    {
      	if($this->gateway->existEntrada($entrcodigon) == 1){
          	$this->gatewayext->updateStatusEntrada($entrcodigon,$entractivas);
		  	$this->UnsetRequest();
          	return 3;
      	}else{
          	return 2;
      	}
    }
    
	function updateStatusEventByActa($actacodigos,$entractivas,$nuDateHour,$sbOperador)
    {
       	$this->gatewayext->updateStatusEventByActa($actacodigos,$entractivas,$nuDateHour,$sbOperador);
	  	$this->UnsetRequest();
       	return 3;
    }
    
    function addOrganentrada($entrcodigon,$orgacodigos,$perscodigos=false)
    {
    	if($this->gatewayext->existOrganentrada($entrcodigon,$orgacodigos))
    		$this->gatewayext->addOrganentrada($entrcodigon,$orgacodigos,$perscodigos);
        return $this->gatewayext->consult;
    }
    
    function deleteAllOrganentrada($entrcodigon)
    {
        $this->gatewayext->deleteAllOrganentrada($entrcodigon);
        return $this->gatewayext->consult;
    }
    function addDetalleEntrada($entrcodigon,$deenprocesas,$deenvictimas,$deenfiscalis,$deendefensas)
    {
   		$this->gatewayext->addDetalleEntrada($entrcodigon,$deenprocesas,$deenvictimas,$deenfiscalis,$deendefensas);
        return $this->gatewayext->consult;
    }
    
    function deleteDetalleEntrada($entrcodigon)
    {
        $this->gatewayext->deleteDetalleEntrada($entrcodigon);
        return $this->gatewayext->consult;
    }
  
    function deleteEntrada($entrcodigon)
    {
    	if($this->gateway->existEntrada($entrcodigon) == 1)
    	{
    		$this->gateway->deleteEntrada($entrcodigon);
    		if($this->gateway->consult)
    		{
    			$this->UnsetRequest();
    			return 3;
    		}
    		else
    			return 100;
    	}
    	else
    	{
    		return 2;
    	}
    }
  
    function getByIdEntrada($entrcodigon)
    {
    	settype($rcRet,"array");
    	
		$rcRet[0] = $this->gateway->getByIdEntrada($entrcodigon);
		$rcRet[1] = $this->gateway->getByIdReferCross($entrcodigon);
		
		$rcRet[2] = $this->gatewayext->getByIdOrganentrada($entrcodigon);
		//$rcRet[3] = $this->gatewayext->getByIdDetentrada($entrcodigon);
		
	    return $rcRet;
    }
    
    function blHasAvailability($entrcodigon,$orgacodigos)
	{
		$rcData = $this->gateway->getByIdEntrada($entrcodigon);
		if(is_array($rcData)==false)
			return true;
		else
			$blAvailable = $this->gatewayext->blHasAvailability($rcData[0]["entrfechorun"],$rcData[0]["entrduracion"],$orgacodigos);
		
    	return $blAvailable;
	}

    function UnsetRequest()
    {
     unset($_REQUEST["entrada__entrcodigon"]);
     unset($_REQUEST["entrada__entrusucreas"]);
     unset($_REQUEST["entrada__entrfechorun"]);
     unset($_REQUEST["entrfechorun"]);
     unset($_REQUEST["entrada__entrduracion"]);
     unset($_REQUEST["entrduracion"]);
     unset($_REQUEST["entrada__agprcodigos"]);
     unset($_REQUEST["entrada__catecodigon"]);
     unset($_REQUEST["entrada__orgacodigos"]);
     unset($_REQUEST["perscodigos"]);
     unset($_REQUEST["entrada__entrdescris"]);
     unset($_REQUEST["catecodigon"]);
     unset($_REQUEST["ordenumexps"]);
     unset($_REQUEST["ordenumeros"]);
     unset($_REQUEST["actacodigos"]);
    }
    
    function getSesionColision($orgacodigos,$inuFechaHoraIni,$inuFechaHoraFin,$entrcodigon=false)
    {
    	//PRIMERO VERIFICAMOS QUE NO HAYAN SESIONES YA PROGRAMADAS DENTRO DE LAS HORAS PROPUESTAS
    	$objDate = Application::loadServices("DateController");
    	$nuResult = $this->gatewayext->getColisionUserHours($orgacodigos,$inuFechaHoraIni,$inuFechaHoraFin,$entrcodigon);
    	if($nuResult>0)
    		return 29;
    	else
    	{
    		//LUEGO MIRAMOS QUE ESTÉN DENTRO DE EL HORARIO DE MEDIACIÓN
    		$objGeneral = Application::loadServices("General");
    		$rcHorarMed = $objGeneral->getParam("general","horario_atencion");
    		
    		//HALLAMOS LOS HORARIOS DE MEDIACIÓN Y LAS HORAS REQUERIDAS
    		$sbFechaHoraIni = $objDate->fncformatofechahora($inuFechaHoraIni);
    		$sbFechaHoraFin = $objDate->fncformatofechahora($inuFechaHoraFin);
    		$rcFechaIni = explode($objDate->typeSeparator,$sbFechaHoraIni);
    		$rcFechaFin = explode($objDate->typeSeparator,$sbFechaHoraFin);
    		
    		//HACEMOS LAS CONVERSIONES NECESARIAS
    		$nuHoraIni = $objDate->hour2secs($rcFechaIni[1]);
    		$nuHoraFin = $objDate->hour2secs($rcFechaFin[1]);
    		$nuHoraMedIni = $objDate->hour2secs($rcHorarMed["hora_ini"]);
    		$nuHoraMedFin = $objDate->hour2secs($rcHorarMed["hora_fin"]);

    		//LAS COMPARACIONES SON BÁSICAS:  QUE LA HORA PROPUESTA ESTÉ DENTRO DEL HORARIO DE ATENCIÓN
    		if($nuHoraIni<$nuHoraMedIni || $nuHoraFin>$nuHoraMedFin || $nuHoraIni>$nuHoraMedFin)
    			return 30;
    		if ($objDate->fncdatetoint($rcFechaFin[0])>$objDate->fncdatetoint($rcFechaIni[0]))
    			return 30;
    	}
    	return false;
    }
    
    function ordenarDiasInhabiles($rcDiasInhabiles)
    {
    	settype($rcReturn,"array");
    	if(is_array($rcDiasInhabiles))
    		foreach ($rcDiasInhabiles as $rcRow)
    			$rcReturn[] = $rcRow["dipedian"];
    	return $rcReturn;
    }
    
    function getDateHourSession($isbOrdenumeros)
    {
    	return $this->gatewayext->getDateHourSession($isbOrdenumeros);
    }
    
    function updateDescripcionEntrada($entrcodigon,$entrdescris) {
    	$rcTmp = $this->gateway->getByIdEntrada($entrcodigon);
    	$rcTmp = $rcTmp[0];
    	return $this->updateEntrada($entrcodigon,$rcTmp["entrusucreas"],$rcTmp["entrfechorun"],$rcTmp["entrduracion"],$rcTmp["agprcodigos"],$rcTmp["catecodigon"],$rcTmp["entrdescris"]." - R:/ ".$entrdescris);
    }
    
    function NotificarCiudadano($entrcodigon,$preecodigon) {
    	
    	//OBTIENE EL MENSAJE
    	$rcDataMensaje = $this->GetMessage($preecodigon,$entrcodigon);  //[0]=>número cel, [1]=>mensaje
    	$rcData["mensaje"] = $rcDataMensaje[1];
    	$rcData["celular"] = $rcDataMensaje[0];
    	
    	$General = Application::loadServices("General");
    	$result = $General->SendSMS ($rcData);
    	$General->close();
    	return $result;
    }
    
function GetMessage($preecodigon,$entrcodigon) {

		settype($objDate,"object");
		settype($objDependencias,"object");
		settype($objCustomers,"object");
		settype($rcDataEntrada,"array");
		settype($rcPreentrada,"array");
		settype($rcDependencia,"array");
		settype($rcFuncionario,"array");
		settype($rcCiudadano,"array");
		settype($rcUser,"array");
		settype($sbFecha_hora,"string");
		settype($sbCelular,"string");
		settype($sbMensaje,"string");
		settype($sbDependencia,"string");
		
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			$rcUser['lang'] = Application :: getSingleLang();
		}

		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
			
		//DATOS DE LA ENTRADA, PARA ARMAR EL MENSAJE
		$rcDataEntrada = $this->getByIdEntrada($entrcodigon);
		$rcPreentrada = $this->sqlExtended->getByIdPreentrada($preecodigon);
			
		$objDate = Application::loadServices("DateController");
		$sbFecha_hora = $objDate->fncformatofechahora($rcDataEntrada[0][0]["entrfechorun"]);
			
		$objDependencias = Application::loadServices("Human_resources");
		$rcDependencia = $objDependencias->getDataEntesOrg($rcDataEntrada[2][0]["orgacodigos"]);
		$sbDependencia = $rcDependencia["nombre"];
			
		if(strlen($rcDataEntrada[2][0]["perscodigos"])>0) {
			$rcFuncionario = $objDependencias->getPersonal($rcDataEntrada[2][0]["perscodigos"]);
			$sbDependencia .= "(".$rcFuncionario[0]["persnombres"].")";
		}
		$objDependencias->close();
			
		//DATOS DEL CIUDADANO
		$objCustomers = Application::loadServices("Customers");
		$rcCiudadano = $objCustomers->getByIdcontindentis($rcPreentrada[0]["contcodigon"]);
		$sbCelular = $rcCiudadano[0]["contnumcels"];
			
		//A PARTIR DE LA PLANTILLA, ARMAMOS EL MENSAJE
		//<NOMBRE_CIUDADANO>, <CODIGO_CITA>, <FECHA_HORA>, <DEPENDENCIA>
		$sbMensaje = $rcmessages[53];
		
		if(strstr($sbMensaje,"__CODIGO_CITA__")) {
			$sbMensaje = str_replace("__CODIGO_CITA__",$preecodigon,$sbMensaje);
		}
		if(strstr($sbMensaje,"__FECHA_HORA__")) {
			$sbMensaje = str_replace("__FECHA_HORA__",strtoupper($sbFecha_hora),$sbMensaje);
		}
		if(strstr($sbMensaje,"__DEPENDENCIA__")) {
			$sbMensaje = str_replace("__DEPENDENCIA__",strtoupper($sbDependencia),$sbMensaje);
		}

		return array($sbCelular,$sbMensaje);
	}
}
?>