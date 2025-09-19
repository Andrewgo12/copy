<?php
require_once "Web/WebRequest.class.php";
Class FeScCmdAddEntradaWeb 
{
    function execute()
    {
		extract($_REQUEST);

		if (($contacto__contcodigon != NULL) && ($contacto__contcodigon != "") 
		&& ($catecodigon != NULL) && ($catecodigon != "") 
		&& ($orden__ordeobservs != NULL) && ($orden__ordeobservs != "")){
			
			$serviceDate = Application :: loadServices("DateController");
			$now = $serviceDate->fncintdate();

			$numerador = Application::getDomainController("NumeradorManager");
			$preencodigon = $numerador->fncgetByIdNumerador("preentrada");
			$manager = Application::getDataGateway("sqlExtended");
			$manager->addPreEntrada($preencodigon,$catecodigon,$contacto__contcodigon,$orden__ordeobservs,$now);
			if($manager->consult) {
				$message = 3;
			
				//ENVIAR EMAIL A LA DEPENDENCIA??  SI, A LA DEFAULT
				//PRUEBA EMAIL
				$rcDatosEmail = Application::getConstant("DATOS_EMAIL");
				$objGeneral = Application::loadServices("General");
				$rcDefault = $objGeneral->getParam("human_resources","ASAPPOINTS_DEFAULT",false);
				$rcDatosEmpresa = $objGeneral->getParam("general","empresa");
					
				$objHR = Application::loadServices("Human_resources");
				$rcGrupo = $objHR->getActiveGroup($rcDefault[0],false);
				$rcPersona = $objHR->getGrupoDetalle($rcGrupo[0]["grupcodigon"],false);
				$rcPersona = $objHR->getPersonal($rcPersona[0]["perscodigos"]);
				
				$objGeneral = Application::loadServices("General");
				$objsendemail = $objGeneral->InitiateClass("SendMailManager");
					
				//Ajusta los archivos adjuntos
				$objsendemail->rchdrs = array ("from" => $rcDatosEmpresa["empremail"],	"subject" => $rcDatosEmail["subject"]);
				$objsendemail->sbrecipient = $rcPersona[0]["persemails"];
				$objsendemail->sbhtml = $rcDatosEmail["body"].$preencodigon;
				$sbResult = $objsendemail->ComposeEmail();
				$objGeneral->close();
				//HASTA AQUÍ
			}
			else
				$message = 100;
			
			unset($_REQUEST["contacto__contcodigon"]);
			unset($_REQUEST["catecodigon"]);
			unset($_REQUEST["orden__ordeobservs"]);
			WebRequest :: setProperty('cod_message', $message=34);
			WebRequest :: setProperty('param', $preencodigon);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
    }
}
?>