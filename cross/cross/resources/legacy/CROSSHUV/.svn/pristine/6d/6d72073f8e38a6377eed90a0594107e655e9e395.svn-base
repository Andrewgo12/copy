<?php
   				

class FeCrCompromisoManager
{
    var $gateway;
    
    function FeCrCompromisoManager()
    {
     $this->gateway = Application::getDataGateway("compromiso");
    }

    function addCompromiso($compcodigos,$compdescris,$compactivos)
    {
      	if($this->gateway->existCompromiso($compcodigos) == 0)
      	{
          	$this->gateway->addCompromiso($compcodigos,$compdescris,$compactivos);
		  	if ($this->gateway->consult == true)
		  	{
				$this->UnsetRequest();
				return 3;
		  	}
		  	else
				return 100;
      	}
      	else
      	{
          	return 1;
      	}
    }

    function updateCompromiso($compcodigos,$compdescris,$compactivos)
    {
      if($this->gateway->existCompromiso($compcodigos) == 1){
          $this->gateway->updateCompromiso($compcodigos,$compdescris,$compactivos);
		  if ($this->gateway->consult == true){
		  	$this->UnsetRequest();
				return 3;
		 }else
			return 100;
      }else{
          return 2;
      }
    }
  
    function deleteCompromiso($compcodigos)
    {
      if($this->gateway->existCompromiso($compcodigos) == 1){
          $this->gateway->deleteCompromiso($compcodigos);
		  
		if ($this->gateway->consult == true){
			$this->UnsetRequest();
			return 3;
		}else
			return 100;
	}else{
          return 2;
      }
    }
  
    function getByIdCompromiso($compcodigos)
    {
	  $data_compromiso = $this->gateway->getByIdCompromiso($compcodigos);
      return $data_compromiso;
    }

    function getAllCompromiso($compcodigos)
    {
     	return $this->gateway->getAllCompromiso($compcodigos);
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["compromiso__compcodigos"]);
     unset($_REQUEST["compromiso__compdescris"]);
     unset($_REQUEST["compromiso__compactivos"]);
    }

}

?>	
 	