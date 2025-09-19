<?php
class FeStTipobodegaManager
{
    var $gateway;
    function FeStTipobodegaManager()
    {
     $this->gateway = Application::getDataGateway("tipobodega");
    }
    function addTipobodega($tibocodigos,$tibonombres,$tibodescrips)
    {
      if($this->gateway->existTipobodega($tibocodigos) == 0){
          $this->gateway->addTipobodega($tibocodigos,$tibonombres,$tibodescrips);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }
    function updateTipobodega($tibocodigos,$tibonombres,$tibodescrips)
    {
      if($this->gateway->existTipobodega($tibocodigos) == 1){
          $this->gateway->updateTipobodega($tibocodigos,$tibonombres,$tibodescrips);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function deleteTipobodega($tibocodigos)
    {
      if($this->gateway->existTipobodega($tibocodigos) == 1){
          $this->gateway->deleteTipobodega($tibocodigos);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function getByIdTipobodega($tibocodigos)
    {
	  $data_tipobodega = $this->gateway->getByIdTipobodega($tibocodigos);
      return $data_tipobodega;
    }
    function getAllTipobodega()
    {
     //$this->gateway->
    }
    function UnsetRequest()
    {
     unset($_REQUEST["tipobodega__tibocodigos"]);
     unset($_REQUEST["tipobodega__tibonombres"]);
     unset($_REQUEST["tipobodega__tibodescrips"]);
    }
}
?>	
