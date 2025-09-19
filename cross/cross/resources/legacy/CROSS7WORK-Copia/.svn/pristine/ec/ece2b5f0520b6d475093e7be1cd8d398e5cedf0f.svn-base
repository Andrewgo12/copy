<?php
require_once('../../../lib/nusoap/nusoap.php');
settype($objServer,"object");
settype($sbNameSpace,"string");

//$sbNameSpace="http://www.fullengine.com/apps/171070501/ASAP/system/classes/WS";
$sbNameSpace="http://www.cvoss.dev/CVOSS/ASAP/system/classes/WS";
$objServer = new soap_server();
$objServer->configureWSDL('CVOSS',$sbNameSpace);
$objServer->wsdl->schemaTargetNamespace=$sbNameSpace;

// REGISTRANDO EL ARRAY A DE INGRESO(array de usuarios)
$objServer->wsdl->addComplexType(
		'rcTickets', 	// Nombre
		'complexType', 	// Tipo de Clase
		'array', 		// Tipo de PHP
		'', 			// definición del tipo secuencia(all|sequence|choice)
		'SOAP-ENC:Array', // Restricted Base
		array(),
		array(
			array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Ticket[]') // Atributos
		),
		'tns:Ticket'
);
$objServer->wsdl->addComplexType(
		'rcCustomer', 	// Nombre
		'complexType', 	// Tipo de Clase
		'array', 		// Tipo de PHP
		'', 			// definición del tipo secuencia(all|sequence|choice)
		'SOAP-ENC:Array', // Restricted Base
		array(),
		array(
			array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Customer[]') // Atributos
		),
		'tns:Customer'
);
$objServer->wsdl->addComplexType('Ticket',
		'complexType', 
		'struct', 
		'all', 
		'',
		array(
			'basic_data'    => array('name' => 'basic_data','type' => 'xsd:string'),
			'dynamic_data'  => array('name' => 'dynamic_data','type' => 'xsd:string')
		)
);
$objServer->wsdl->addComplexType('Customer',
		'complexType', 
		'struct', 
		'all', 
		'',
		array(
			'basic_data'    => array('name' => 'basic_data','type' => 'xsd:string')
		)
);
$objServer->wsdl->addComplexType('Campaign',
		'complexType', 
		'struct', 
		'all', 
		'',
		array(
			'campaign'  => array('name' => 'campaign','type' => 'xsd:string'),
			'employee'  => array('name' => 'employee','type' => 'xsd:string'),
			'config'    => array('name' => 'config',  'type' => 'xsd:string'),
			'detail'    => array('name' => 'detail',  'type' => 'xsd:string'),
			'master'    => array('name' => 'master',  'type' => 'xsd:string')
		)
);
// REGISTRANDO EL ARRAY B DE RESPUESTA (array de RESULTADOS)
$objServer->wsdl->addComplexType(
		'rcResult', 		// Nombre
		'complexType', 	// Tipo de Clase
		'array', 		// Tipo de PHP
		'', 			// definición del tipo secuencia(all|sequence|choice)
		'SOAP-ENC:Array', // Restricted Base
array(),
array(
array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Result[]') // Atributos
),
	'tns:Result'
);
$objServer->wsdl->addComplexType(
		'rcResultCust', 		// Nombre
		'complexType', 	// Tipo de Clase
		'array', 		// Tipo de PHP
		'', 			// definición del tipo secuencia(all|sequence|choice)
		'SOAP-ENC:Array', // Restricted Base
array(),
array(
array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:ResultCust[]') // Atributos
),
	'tns:Result'
);
$objServer->wsdl->addComplexType('Result',
			'complexType', 
			'struct', 
			'all', 
			'',
			array(
				'status'    => array('name' => 'status','type' => 'xsd:string'),
				'new_ticket'    => array('name' => 'new_ticket',    'type' => 'xsd:string'),
				'old_ticket'    => array('name' => 'old_ticket',    'type' => 'xsd:string'),
				'message'    => array('name' => 'message',    'type' => 'xsd:string')
			)
);
$objServer->wsdl->addComplexType('ResultCust',
			'complexType', 
			'struct', 
			'all', 
			'',
			array(
				'status'    => array('name' => 'status','type' => 'xsd:string')
			)
);
$objServer->wsdl->addComplexType('ResultCamp',
			'complexType', 
			'struct', 
			'all', 
			'',
			array(
				'status'    => array('name' => 'status','type' => 'xsd:string'),
				'schema'    => array('name' => 'schema','type' => 'xsd:string'),
				'message'   => array('name' => 'message','type' => 'xsd:string'),
				'emp'  => array('name' => 'emp','type' => 'xsd:string')
			)
);
$objServer->register('synchTickets',array('rcInfo' => 'tns:rcTickets'),array('return' => 'tns:rcResult'),$sbNameSpace);
$objServer->register('synchCustomer',array('rcInfo' => 'tns:rcCustomer'),array('return' => 'tns:rcResultCust'),$sbNameSpace);
$objServer->register('synchCampaign',array('rcInfo' => 'tns:Campaign'),array('return' => 'tns:ResultCamp'),$sbNameSpace);

/**
 * Copyright 2009 FullEngine

 * sincroniza las canpanhas
 * @param array
 * @return array
 * @author freina<freina@parquesoft.com>
 * @date 02-Feb-2010 17:30:00
 * @location Cali-Colombia
 */
function synchCampaign ($rcInfo){

	 settype($objManager,"object");
	 settype($rcResult,"array");
	 settype($rcTmp_E,"array");
	 settype($rcTmp_Ca,"array");
	 settype($rcTmp_Co,"array");
	 settype($rcTmp_D,"array");
	 settype($rcTmp_M,"array");
	 settype($rcTmp,"array");
	 settype($sbResult,"string");
	 settype($nuCont,"integer");

	if($rcInfo == ''){
		return new soap_fault('Client','','Must supply a valid build array.');
	}

	$sbResult = loadApplication("profiles");

	if($sbResult){
		$sbResult = setSessionDataUser("Admin",1);
		if($sbResult){
			if(is_array($rcInfo) && $rcInfo){
				if($rcInfo["campaign"]){
					$rcTmp_Ca = unserialize(urldecode($rcInfo["campaign"]));
					if(is_array($rcTmp_Ca) && $rcTmp_Ca){
						foreach($rcTmp_Ca as $nuCont=>$rcTmp){
							foreach($rcTmp as $sbIndex=>$sbValue){
								$rcTmp[$sbIndex] = urldecode($sbValue);
							}
							$rcTmp_Ca[$nuCont] = $rcTmp;
						}
					}
				}
				if($rcInfo["employee"]){
					$rcTmp_E = unserialize(urldecode($rcInfo["employee"]));
					if(is_array($rcTmp_E) && $rcTmp_E){
						foreach($rcTmp_E as $nuCont=>$rcTmp){
							foreach($rcTmp as $sbIndex=>$sbValue){
								$rcTmp[$sbIndex] = urldecode($sbValue);
							}
							$rcTmp_E[$nuCont] = $rcTmp;
						}
					}
				}
				if($rcInfo["config"]){
				$rcTmp_Co = unserialize(urldecode($rcInfo["config"]));
					if(is_array($rcTmp_Co) && $rcTmp_Co){
						foreach($rcTmp_Co as $nuCont=>$rcTmp){
							foreach($rcTmp as $sbIndex=>$sbValue){
								$rcTmp[$sbIndex] = urldecode($sbValue);
							}
							$rcTmp_Co[$nuCont] = $rcTmp;
						}
					}
				}
				if($rcInfo["detail"]){
					$rcTmp_D = unserialize(urldecode($rcInfo["detail"]));
					if(is_array($rcTmp_D) && $rcTmp_D){
						foreach($rcTmp_D as $nuCont=>$rcTmp){
							foreach($rcTmp as $sbIndex=>$sbValue){
								$rcTmp[$sbIndex] = urldecode($sbValue);
							}
							$rcTmp_D[$nuCont] = $rcTmp;
						}
					}
				}
				if($rcInfo["master"]){
					$rcTmp_M = unserialize(urldecode($rcInfo["master"]));
					if(is_array($rcTmp_M) && $rcTmp_M){
						foreach($rcTmp_M as $nuCont=>$rcTmp){
							foreach($rcTmp as $sbIndex=>$sbValue){
								$rcTmp[$sbIndex] = urldecode($sbValue);
							}
							$rcTmp_M[$nuCont] = $rcTmp;
						}
					}
				}
					
				// una vez los arreglos formados entonces
				$objManager = Application :: getDomainController('CampaignManager');
				$objManager->setData(array("rcCampaign"=>$rcTmp_Ca[0],"rcEmployee"=>$rcTmp_E,
				"rcConfig"=>$rcTmp_Co,"rcDetail"=>$rcTmp_D,"rcMaster"=>$rcTmp_M));
				$objManager->createCampaign();
				$rcTmp = $objManager->getResult();
					
				if($rcTmp["result"]){
					$rcResult["status"] = "succes";
					$rcResult["schema"] = $rcTmp["schema"];
					$rcResult["message"] = $rcTmp["message"];
					$rcResult["emp"] = $rcTmp["rcEmployee"];
				}else{
					$rcResult["status"] = "fail";
					$rcResult["schema"] = "fail";
					$rcResult["message"] = $rcTmp["message"];
					$rcResult["emp"] = "fail";
				}
			}else{
				$rcResult["status"] = "fail";
				$rcResult["schema"] = "fail";
				$rcResult["message"] = urlencode(trim("Data Not Found"));
				$rcResult["emp"] = "fail";
			}
		}else{
			$rcResult["status"] = "fail";
			$rcResult["schema"] = "fail";
			$rcResult["message"] = urlencode(trim("Session User Error"));
			$rcResult["emp"] = "fail";
		}
	}else{
		$rcResult["status"] = "fail";
		$rcResult["schema"] = "fail";
		$rcResult["message"] = urlencode(trim("Load Application Error"));
		$rcResult["emp"] = "fail";
	}

	return $rcResult;
}
/**
 * Copyright 2009 FullEngine

 * sincroniza los tickets
 * @param array
 * @return array
 * @author freina<freina@parquesoft.com>
 * @date 20-Aug-2009 02:41:00
 * @location Cali-Colombia
 */
function synchTickets ($rcInfo){

	settype($objTmp,"object");
	settype($rcTmp,"array");
	settype($rcRecord,"array");
	settype($sbIndex,"string");
	settype($sbValue,"string");
	settype($nuIndex,"integer");

	if($rcInfo == ''){
		return new soap_fault('Client','','Must supply a valid build array.');
	}

	$sbResult = loadApplication("general");

	//librerias
	include_once('nusoap.php');

	if(!$sbResult){
		$rcResult[0]["status"] = "fail";
		$rcResult[0]["new_ticket"] = "fail";
		$rcResult[0]["old_ticket"] = "fail";
		$rcResult[0]["message"] = "Load Application Error";
	}else{
		if(is_array($rcInfo) && $rcInfo){

			foreach($rcInfo as $nuIndex=>$rcTmp){

				$rcTmp["basic_data"] = unserialize(urldecode($rcTmp["basic_data"]));
				$rcTmp["dynamic_data"] = unserialize(urldecode($rcTmp["dynamic_data"]));

				if(is_array($rcTmp["basic_data"]) && $rcTmp["basic_data"]){
					foreach($rcTmp["basic_data"] as $sbIndex=>$sbValue){
						$rcTmp["basic_data"][$sbIndex] = urldecode($sbValue);
					}
				}
				if(is_array($rcTmp["dynamic_data"]) && $rcTmp["dynamic_data"]){
					foreach($rcTmp["dynamic_data"] as $sbIndex=>$sbValue){
						$rcTmp["dynamic_data"][$sbIndex] = urldecode($sbValue);
					}
				}
				$rcRecord[$nuIndex] = $rcTmp;
			}

			//entonces se inicia el ingreso de los casos.
			$rcResult = addCaso($rcRecord);

			if(!$rcResult || !is_array($rcResult)){
				unset($rcResult);
				$rcResult[0]["status"] = "fail";
				$rcResult[0]["new_ticket"] = "fail";
				$rcResult[0]["old_ticket"] = "fail";
				$rcResult[0]["message"] = "Not Data Found";
			}

		}else{
			$rcResult[0]["status"] = "fail";
			$rcResult[0]["new_ticket"] = "fail";
			$rcResult[0]["old_ticket"] = "fail";
			$rcResult[0]["message"] = "Not Data Found";
		}
	}
	return $rcResult;
}
/**
 * Copyright 2009 FullEngine

 * sincroniza los tickets
 * @param array
 * @return array
 * @author mrestrepo<mrestrepo@parquesoft.com>
 * @date 10-Oct-2009 02:41:00
 * @location Cali-Colombia
 */
function synchCustomer ($rcInfo){

	settype($objTmp,"object");
	settype($rcTmp,"array");
	settype($rcRecord,"array");
	settype($sbIndex,"string");
	settype($sbValue,"string");
	settype($nuIndex,"integer");

	if($rcInfo == ''){
		return new soap_fault('Client','','Must supply a valid build array.');
	}

	$sbResult = loadApplication("general");

	//librerias
	include_once('nusoap.php');

	if(!$sbResult){
		$rcResult[0]["status"] = "fail";

	}else{
		if(is_array($rcInfo) && $rcInfo){

			foreach($rcInfo as $nuIndex=>$rcTmp){
				$rcTmp["basic_data"] = unserialize(urldecode($rcTmp["basic_data"]));
				if(is_array($rcTmp["basic_data"]) && $rcTmp["basic_data"]){
					foreach($rcTmp["basic_data"] as $sbIndex=>$sbValue){
						$rcTmp["basic_data"][$sbIndex] = urldecode($sbValue);
					}
				}
				$rcRecord[$nuIndex] = $rcTmp;
			}

			//entonces se inicia el ingreso de los casos.
			$rcResult = addCustomer($rcRecord);

			if(!$rcResult || !is_array($rcResult)){
				unset($rcResult);
				$rcResult[0]["status"] = "fail";
			}
		}else{
			$rcResult[0]["status"] = "fail";
		}
	}
	return $rcResult;
}
/**
 * Copyright 2009 FullEngine

 * Carga el controlador frontal
 * @param string $sbModule
 * @return boolean
 * @author freina<freina@parquesoft.com>
 * @date 20-Aug-2009 02:41:00
 * @location Cali-Colombia
 */
function loadApplication($sbModule){
	settype($sbPath,"string");
	$sbPath = dirname(__FILE__)."/../../../applications/$sbModule";
	include_once ("$sbPath/config/config.inc.php");
	require_once "ASAP.class.php";
	$objTmp = new Application($sbModule, $sbPath,true);
	return true;
}
/**
 * Copyright 2009 FullEngine

 * Usuario en sesion
 * @param string $sbUser
 * @return boolean
 * @author freina<freina@parquesoft.com>
 * @date 20-Aug-2009 02:41:00
 * @location Cali-Colombia
 */
function setSessionDataUser($sbUser,$sbSchema){

	settype($objManager,"object");
	settype($rcAuthsession,"array");
	if(WebSession :: issetProperty("_authsession")){
		WebSession :: unsetProperty("_authsession");
	}
	//Crea los datos del usuario
	loadApplication("profiles");
	$objManager = Application :: getDomainController('LoginManager');
	//Consulta los datos del usuario
	$rcAuthsession = $objManager->getSessionDataUser($sbUser);
	if (!is_array($rcAuthsession)) {
		return false;
	}
	$rcAuthsession["schema"] = $sbSchema;
	$rcAuthsession["schecodigon"] = $sbSchema;
	//Pone en sesion los datos del usuario
	WebSession :: setProperty("_authsession", & $rcAuthsession);
	return true;
}
/**
 * Copyright 2009 FullEngine

 * lleva a cabo el ingreso del caso
 * @param array
 * @return array
 * @author freina<freina@parquesoft.com>
 * @date 20-Aug-2009 18:43:00
 * @location Cali-Colombia
 */
function addCaso($rcData){

	settype($objManager,"object");
	settype($rcResult,"array");
	settype($rcTmp,"array");
	settype($rcOrden,"array");
	settype($rcExtra,"array");
	settype($sbResult,"string");
	settype($sbMessage,"string");
	settype($sbOrdenumeros,"string");
	settype($nuCont,"integer");

	if(is_array($rcData) && $rcData ){

		//se recorre el arreglo con la informacion a almacenar
		foreach($rcData as $nuCont=>$rcTmp){
			$rcOrden = $rcTmp["basic_data"];
			$rcExtra = $rcTmp["dynamic_data"];
			$sbOrdenumeros = $rcOrden["ordenumeros"];

			$sbResult = setSessionDataUser($rcOrden["usuacodigos"],$rcOrden["tiorcodigos"]);
			if($sbResult){
				$sbResult = loadApplication("cross300");
				unset($rcOrden["ordenumeros"]);
				unset($rcOrden["orgacodigos"]);
				$objManager = Application :: getDomainController('OrdenManager');
				$sbMessage = $objManager->addOrden(null, $rcOrden, $rcExtra);
				if(is_array($sbMessage)){
					$rcResult[$nuCont]["status"] = "succes";
					$rcResult[$nuCont]["new_ticket"] = $sbMessage["ordenumeros"];
					$rcResult[$nuCont]["message"]= "Succes";
				}else{
					$rcResult[$nuCont]["status"]= "fail";
					$rcResult[$nuCont]["new_ticket"]= null;
					$rcResult[$nuCont]["message"]= "Error Message Code: ".$sbMessage;
				}
			}else{
				$rcResult[$nuCont]["status"]= "fail";
				$rcResult[$nuCont]["new_ticket"]= null;
				$rcResult[$nuCont]["message"]= "Session User Error";
			}
			$rcResult[$nuCont]["old_ticket"] = $sbOrdenumeros;
		}
	}
	return $rcResult;
}
/**
 * Copyright 2009 FullEngine

 * lleva a cabo el ingreso del caso
 * @param array
 * @return array
 * @author mrestrepo<mrestrepo@parquesoft.com>
 * @date 10-Oct-2009 18:43:00
 * @location Cali-Colombia
 */
function addCustomer($rcData){

	settype($objManager,"object");
	settype($rcResult,"array");
	settype($rcTmp,"array");
	settype($rcOrden,"array");
	settype($rcExtra,"array");
	settype($sbResult,"string");
	settype($sbMessage,"string");
	settype($sbOrdenumeros,"string");
	settype($nuCont,"integer");

	if(is_array($rcData) && $rcData ){

		//se recorre el arreglo con la informacion a almacenar
		foreach($rcData as $nuCont=>$rcTmp){
			$rcContacto = $rcTmp["basic_data"];
			$sbResult = setSessionDataUser("webuser",$rcContacto["tiorcodigos"]);
			if($sbResult){
				$sbResult = loadApplication("customers");
				$contGateway = Application::getDataGateway("contacto");
				$sbMessage = $contGateway->addContacto($rcContacto["contcodigon"], $rcContacto["contindentis"], $rcContacto["tiidcodigos"], null,
				$rcContacto["contnombre"], null, null, null, null, null,null, null, null,null);

				$numGateway = Application::getDataGateway("numeradorExtended");
				$numGateway->updateNumeradorTrans("contacto",$rcContacto["contcodigon"]);
				if(is_array($sbMessage)){
					$rcResult[$nuCont]["status"] = "succes";
				}else{
					$rcResult[$nuCont]["status"]= "fail";
				}
			}else{
				$rcResult[$nuCont]["status"]= "fail";
			}
		}
	}
	return $rcResult;
}

/******PROCESA LA SOLICITUD Y DEVUELVE LA RESPUESTA*******/
$input = (isset($HTTP_RAW_POST_DATA)) ? $HTTP_RAW_POST_DATA : implode("\r\n", file('php://input'));
$objServer->service($input);
exit;
?>