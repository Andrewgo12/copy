<?php
class FeGeConfigarchivManager
{
    var $gateway;
    function FeGeConfigarchivManager()
    {
     $this->gateway = Application::getDataGateway("configarchiv");
    }
    function addConfigarchiv($cogacodigos,$coganombres,$cogaobservas,$tiarcodigos,$cogamarmaess,$cogamardetas,$cogaposmaess,$cogaposdetas,$cogasepainis,$cogasepafins,$coarencabezs,$coarextencis)
    {
      if($this->gateway->existConfigarchiv($cogacodigos) == 0){
          $this->gateway->addConfigarchiv($cogacodigos,$coganombres,$cogaobservas,$tiarcodigos,$cogamarmaess,$cogamardetas,$cogaposmaess,$cogaposdetas,$cogasepainis,$cogasepafins,$coarencabezs,$coarextencis);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }
    function updateConfigarchiv($cogacodigos,$coganombres,$cogaobservas,$tiarcodigos,$cogamarmaess,$cogamardetas,$cogaposmaess,$cogaposdetas,$cogasepainis,$cogasepafins,$coarencabezs,$coarextencis)
    {
      if($this->gateway->existConfigarchiv($cogacodigos) == 1){
          $this->gateway->updateConfigarchiv($cogacodigos,$coganombres,$cogaobservas,$tiarcodigos,$cogamarmaess,$cogamardetas,$cogaposmaess,$cogaposdetas,$cogasepainis,$cogasepafins,$coarencabezs,$coarextencis);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function deleteConfigarchiv($cogacodigos)
    {
      if($this->gateway->existConfigarchiv($cogacodigos) == 1){
          $this->gateway->deleteConfigarchiv($cogacodigos);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function getByIdConfigarchiv($cogacodigos)
    {
	  $data_configarchiv = $this->gateway->getByIdConfigarchiv($cogacodigos);
      return $data_configarchiv;
    }
    function getAllConfigarchiv()
    {
     //$this->gateway->
    }
    function getByConfigarchiv_fkey($tiarcodigos)
    {
     //$this->gateway->
    }
    function UnsetRequest()
    {
     unset($_REQUEST["configarchiv__cogacodigos"]);
     unset($_REQUEST["configarchiv__coganombres"]);
     unset($_REQUEST["configarchiv__cogaobservas"]);
     unset($_REQUEST["configarchiv__tiarcodigos"]);
     unset($_REQUEST["configarchiv__cogamarmaess"]);
     unset($_REQUEST["configarchiv__cogamardetas"]);
     unset($_REQUEST["configarchiv__cogaposmaess"]);
     unset($_REQUEST["configarchiv__cogaposdetas"]);
     unset($_REQUEST["configarchiv__cogasepainis"]);
     unset($_REQUEST["configarchiv__cogasepafins"]);
     unset($_REQUEST["configarchiv__coarencabezs"]);
     unset($_REQUEST["configarchiv__coarextencis"]);
    }
}
?>	
