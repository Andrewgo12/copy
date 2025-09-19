<?php
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrCommandsManager
{
    var $gateway;
    
    function FePrCommandsManager()
    {
     $this->gateway = Application::getDataGateway("commands");
    }

    function addCommands($commnombres,$applcodigos,$commobservas)
    {
      if($this->gateway->existCommands($commnombres,$applcodigos) == 0){
          $this->gateway->addCommands($commnombres,$applcodigos,$commobservas);
		  if($this->gateway->consult == false)
			return 100;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateCommands($commnombres,$applcodigos,$commobservas)
    {
      if($this->gateway->existCommands($commnombres,$applcodigos) == 1){
          $this->gateway->updateCommands($commnombres,$applcodigos,$commobservas);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteCommands($commnombres,$applcodigos)
    {
      if($this->gateway->existCommands($commnombres,$applcodigos) == 1){
          $this->gateway->deleteCommands($commnombres,$applcodigos);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdCommands($commnombres,$applcodigos)
    {
	  $data_commands = $this->gateway->getByIdCommands($commnombres,$applcodigos);
      return $data_commands;
    }

    function getAllCommands()
    {
     //$this->gateway->
    }
     
    function getByCommands_fkey($applcodigos)
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["commands__commnombres"]);
     unset($_REQUEST["commands__applcodigos"]);
     unset($_REQUEST["commands__commobservas"]);
    }

}

?>	
 	