<?php
class FeStRecuseribodeManager
{
    var $gateway;
    function FeStRecuseribodeManager()
    {
     $this->gateway = Application::getDataGateway("recuseribode");
    }
    function addRecuseribode($resbnumedocu,$recucodigos,$resbserirecu,$resbbodeactu,$resbbodeante,$resbfechmovi,$perscodigos)
    {
      if($this->gateway->existRecuseribode() == 0){
          $this->gateway->addRecuseribode($resbnumedocu,$recucodigos,$resbserirecu,$resbbodeactu,$resbbodeante,$resbfechmovi,$perscodigos);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }
    function updateRecuseribode($resbnumedocu,$recucodigos,$resbserirecu,$resbbodeactu,$resbbodeante,$resbfechmovi,$perscodigos)
    {
      if($this->gateway->existRecuseribode() == 1){
          $this->gateway->updateRecuseribode($resbnumedocu,$recucodigos,$resbserirecu,$resbbodeactu,$resbbodeante,$resbfechmovi,$perscodigos);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function deleteRecuseribode()
    {
      if($this->gateway->existRecuseribode() == 1){
          $this->gateway->deleteRecuseribode();
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function getByIdRecuseribode()
    {
	  $data_recuseribode = $this->gateway->getByIdRecuseribode();
      return $data_recuseribode;
    }
    function getAllRecuseribode()
    {
     //$this->gateway->
    }
    function getByRecuseribode_fkey($recucodigos)
    {
     //$this->gateway->
    }
    function UnsetRequest()
    {
     unset($_REQUEST["recuseribode__resbnumedocu"]);
     unset($_REQUEST["recuseribode__recucodigos"]);
     unset($_REQUEST["recuseribode__resbserirecu"]);
     unset($_REQUEST["recuseribode__resbbodeactu"]);
     unset($_REQUEST["recuseribode__resbbodeante"]);
     unset($_REQUEST["recuseribode__resbfechmovi"]);
     unset($_REQUEST["recuseribode__perscodigos"]);
    }
}
?>	
