<?php
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrApplicationsManager
{
    var $gateway;
    
    function FePrApplicationsManager()
    {
     $this->gateway = Application::getDataGateway("applications");
    }

    function addApplications($applcodigos,$applnombres,$applobservas)
    {
      if($this->gateway->existApplications($applcodigos) == 0){
          $this->gateway->addApplications($applcodigos,$applnombres,$applobservas);
		  if($this->gateway->consult == false)
			return 100;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateApplications($applcodigos,$applnombres,$applobservas)
    {
      if($this->gateway->existApplications($applcodigos) == 1){
          $this->gateway->updateApplications($applcodigos,$applnombres,$applobservas);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteApplications($applcodigos)
    {
      if($this->gateway->existApplications($applcodigos) == 1){
          $this->gateway->deleteApplications($applcodigos);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdApplications($applcodigos)
    {
	  $data_applications = $this->gateway->getByIdApplications($applcodigos);
      return $data_applications;
    }

    function getAllApplications()
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["applications__applcodigos"]);
     unset($_REQUEST["applications__applnombres"]);
     unset($_REQUEST["applications__applobservas"]);
    }

}

?>	
 	