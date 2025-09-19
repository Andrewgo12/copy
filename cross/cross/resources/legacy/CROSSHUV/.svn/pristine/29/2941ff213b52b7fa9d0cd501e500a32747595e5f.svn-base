<?php
   				

class FeCrMediorecepcionManager
{
    var $gateway;
    
    function FeCrMediorecepcionManager()
    {
     $this->gateway = Application::getDataGateway("mediorecepcion");
    }

    function addMediorecepcion($merecodigos,$merenombres,$mereescrips,$mereactivos)
    {
      if($this->gateway->existMediorecepcion($merecodigos) == 0){
          $this->gateway->addMediorecepcion($merecodigos,$merenombres,$mereescrips,$mereactivos);
		  if($this->gateway->consult == false)
			return 100;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateMediorecepcion($merecodigos,$merenombres,$mereescrips,$mereactivos)
    {
      if($this->gateway->existMediorecepcion($merecodigos) == 1){
          $this->gateway->updateMediorecepcion($merecodigos,$merenombres,$mereescrips,$mereactivos);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteMediorecepcion($merecodigos)
    {
      if($this->gateway->existMediorecepcion($merecodigos) == 1){
            //Valida si es usado el los req
            $gateway = Application::getDataGateway('SqlExtended');
            $rcReq = $gateway->getReqByMediorecepion($merecodigos);
            if(is_array($rcReq))
                return 49;
          $this->gateway->deleteMediorecepcion($merecodigos);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdMediorecepcion($merecodigos)
    {
	  $data_mediorecepcion = $this->gateway->getByIdMediorecepcion($merecodigos);
      return $data_mediorecepcion;
    }

    function getAllMediorecepcion()
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["mediorecepcion__merecodigos"]);
     unset($_REQUEST["mediorecepcion__merenombres"]);
     unset($_REQUEST["mediorecepcion__mereescrips"]);
     unset($_REQUEST["mediorecepcion__mereactivos"]);
    }

}

?>	
 	