<?php
   				

class FeScUsuarentradaManager
{
    var $gateway;
    
    function FeScUsuarentradaManager()
    {
     $this->gateway = Application::getDataGateway("usuarentrada");
    }

    function addUsuarentrada($entrcodigon,$usenlogins)
    {
      if($this->gateway->existUsuarentrada($entrcodigon,$usenlogins) == 0){
          $this->gateway->addUsuarentrada($entrcodigon,$usenlogins);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateUsuarentrada($entrcodigon,$usenlogins)
    {
      if($this->gateway->existUsuarentrada($entrcodigon,$usenlogins) == 1){
          $this->gateway->updateUsuarentrada($entrcodigon,$usenlogins);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteUsuarentrada($entrcodigon,$usenlogins)
    {
      if($this->gateway->existUsuarentrada($entrcodigon,$usenlogins) == 1){
          $this->gateway->deleteUsuarentrada($entrcodigon,$usenlogins);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdUsuarentrada($entrcodigon,$usenlogins)
    {
	  $data_usuarentrada = $this->gateway->getByIdUsuarentrada($entrcodigon,$usenlogins);
      return $data_usuarentrada;
    }

    function getAllUsuarentrada()
    {
     //$this->gateway->
    }
     
    function deleteAllUsuarentrada($entrcodigon)
    {
	     return $this->gateway->deleteAllUsuarentrada($entrcodigon);
    }
     
    function getByUsuarentrada_usenlogins_fkey($usenlogins)
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["usuarentrada__entrcodigon"]);
     unset($_REQUEST["usuarentrada__usenlogins"]);
    }

}

?>	
 	