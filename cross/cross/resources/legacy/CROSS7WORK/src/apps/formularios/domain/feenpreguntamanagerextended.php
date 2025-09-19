<?php
   				

class FeEnPreguntaManagerExtended
{
    var $gateway;
    
    function FeEnPreguntaManagerExtended()
    {
     $this->gateway = Application::getDataGateway("preguntaExtended");
    }

    function addPregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon)
    {
      if($this->gateway->existPregunta($pregcodigon) == 0){
          $this->gateway->addPregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updatePregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon)
    {
      if($this->gateway->existPregunta($pregcodigon) == 1){
          $this->gateway->updatePregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deletePregunta($pregcodigon)
    {
      if($this->gateway->existPregunta($pregcodigon) == 1){
          $this->gateway->deletePregunta($pregcodigon);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdPregunta($pregcodigon)
    {
	  $data_pregunta = $this->gateway->getByIdPregunta($pregcodigon);
      return $data_pregunta;
    }

    function getPreguntaByTema($temacodigon)
    {
	  $data_pregunta = $this->gateway->getPreguntaByTema($temacodigon);
      return $data_pregunta;
    }

    function getPreguntaByEjetematico($ejtecodigon)
    {
	  $data_pregunta = $this->gateway->getPreguntaByEjetematico($ejtecodigon);
      return $data_pregunta;
    }

    function getPreguntaCompleta($pregcodigon)
    {
	  $data_pregunta = $this->gateway->getPreguntaCompleta($pregcodigon);
      return $data_pregunta;
    }

    function getAllPregunta()
    {
    	return $this->gateway->getDataPregunta();
    }

    function getAllPreguntas()
    {
    	return $this->gateway->getDataPreguntasAgrupadas();
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["pregunta__pregcodigon"]);
     unset($_REQUEST["pregunta__morecodigon"]);
     unset($_REQUEST["pregunta__pregpadren"]);
     unset($_REQUEST["pregunta__pregdescris"]);
     unset($_REQUEST["pregunta__temacodigon"]);
    }

}

?>	
 	