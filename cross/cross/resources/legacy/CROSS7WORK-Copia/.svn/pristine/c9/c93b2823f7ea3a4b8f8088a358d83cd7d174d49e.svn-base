<?php
class FeScRefercrossManager
{
    var $gateway;
    
    function FeScRefercrossManager()
    {
     	$this->gateway = Application::getDataGateway("refercross");
    }

    function addRefercross($entrcodigon,$recrcodigon,$ordenumexps,$ordenumeros,$actacodigos)
    {
      	if($this->gateway->existRefercross($recrcodigon) == 0)
      	{
          	$this->gateway->addRefercross($entrcodigon,$recrcodigon,$ordenumexps,$ordenumeros,$actacodigos);
		  	$this->UnsetRequest();
          	return 3;
      	}
      	else
	        return 1;
    }
    
    function deleteAllRefercrossEntrada($entrcodigon)
    {
    	return $this->gateway->deleteAllRefercrossEntrada($entrcodigon);
    }
    
    function unsetRequest()
    {
    	unset($_REQUEST["ordenumeros"]);
    	unset($_REQUEST["ordenumexps"]);
    	unset($_REQUEST["actacodigos"]);
    	unset($_REQUEST["orgacodigos"]);
    }
}
?> 	