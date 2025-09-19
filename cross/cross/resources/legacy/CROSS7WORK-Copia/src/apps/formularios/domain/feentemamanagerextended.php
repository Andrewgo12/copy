<?php
   				

class FeEnTemaManagerExtended
{
    var $gateway;
    
    function FeEnTemaManagerExtended()
    {
     $this->gateway = Application::getDataGateway("temaExtended");
    }

    function addTema($temacodigon,$ejtecodigon,$temanombres,$temadescri)
    {
      if($this->gateway->existTema($temacodigon,$ejtecodigon) == 0){
          $this->gateway->addTema($temacodigon,$ejtecodigon,$temanombres,$temadescri);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescri)
    {
      if($this->gateway->existTema($temacodigon,$ejtecodigon) == 1){
          $this->gateway->updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescri);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteTema($temacodigon,$ejtecodigon)
    {
      if($this->gateway->existTema($temacodigon,$ejtecodigon) == 1){
          $this->gateway->deleteTema($temacodigon,$ejtecodigon);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdTemaAll($temacodigon,$ejtecodigon)
    {
	  $data_tema = $this->gateway->getByIdTemaAll($temacodigon,$ejtecodigon);
      return $data_tema;
    }

    function getAllTemaByEje($ejtecodigon)
    {
	  $data_tema = $this->gateway->getAllTemaByEje($ejtecodigon);
      return $data_tema;
    }

    function getAllTema()
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["tema__temacodigon"]);
     unset($_REQUEST["tema__ejtecodigon"]);
     unset($_REQUEST["tema__temanombres"]);
     unset($_REQUEST["tema__temadescri"]);
    }

}

?>	
 	