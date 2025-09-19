<?php
require_once "Web/WebRequest.class.php";
Class FeEnCmdAddRespuestausu
{
    function execute()
    {
        extract($_REQUEST);
        if(($formcodigon != NULL) && ($formcodigon != "")
        &&($pregmodelo != NULL) && ($pregmodelo != "")
		&&($tisecodigos != NULL) && ($tisecodigos != "")	)
        {

			$serviceDate = Application :: loadServices("DateController");
			$now = $serviceDate->fncintdatehour();

            $manager = Application::getDomainController('RespuestausuManager');
            $rcPreguntas = explode(",",$pregmodelo);
            if(is_array($rcPreguntas))
            {
            	//obtenemos de la tabla general el codigo para la respuestausu
	            $objGeneral = Application::loadServices("General");
	            $objDomain = $objGeneral->InitiateClass('NumeradorManager');
	            $reuscodigon = $objDomain->fncgetByIdNumerador('respuestausu',sizeof($rcPreguntas));
	            $objGeneral->close();
	            
            	foreach ($rcPreguntas as $key=>$value)
            	{
            		$rcPregModelo = explode("_",$value);
            		$pregcodigon = $rcPregModelo[0];
            		
            		//En el $_REQUEST vienen variables $preg_X_Y, donde X es la pregunta, Y el modelo de repuesta
            		// y apuntan a un valor de varecodigon, que es finalmente el valor de la respuesta en la escala
            		//Si alguna pregunta no fue respondida, se asume el valor NS/NR
            		$sbVarRequest = "preg_".$value;
            		if (array_key_exists($sbVarRequest,$_REQUEST))
            		{
            			$sbValRequest = $$sbVarRequest;	
					
						//Finalmente se manda a guardar cada respuesta como un registro en respuestausu   		
	            		$message = $manager->addRespuestausu($usuacodigos,$formcodigon,$pregcodigon,$reuscodigon++,$sbValRequest,$ordenumeros, $now,$tisecodigos,false,$contacto__contindentis);
            		}
					else {
						$sbVarRequest = "preg_".$pregcodigon;
						$sbValRequest = $$sbVarRequest;
						$message = $manager->addRespuestausu($usuacodigos,$formcodigon,$pregcodigon,$reuscodigon++,false,$ordenumeros, $now,$tisecodigos,$sbValRequest,$contacto__contindentis); 
					}
            	}
            }
            else
	        {
	            WebRequest::setProperty('cod_message',$message = 0);
	            return "fail";
	        }
            WebRequest::setProperty('cod_message', $message);
            return "success";
        }
        else
        {
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>