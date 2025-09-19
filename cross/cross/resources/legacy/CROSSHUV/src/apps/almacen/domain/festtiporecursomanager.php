<?php
class FeStTiporecursoManager
{
    var $gateway;
    function FeStTiporecursoManager()
    {
     $this->gateway = Application::getDataGateway("tiporecurso");
    }
    function addTiporecurso($tirecodigos,$tirenombres,$tiredescrips)
    {
      if($this->gateway->existTiporecurso($tirecodigos) == 0){
          $this->gateway->addTiporecurso($tirecodigos,$tirenombres,$tiredescrips);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }
    function updateTiporecurso($tirecodigos,$tirenombres,$tiredescrips)
    {
      if($this->gateway->existTiporecurso($tirecodigos) == 1){
          $this->gateway->updateTiporecurso($tirecodigos,$tirenombres,$tiredescrips);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function deleteTiporecurso($tirecodigos)
    {
      if($this->gateway->existTiporecurso($tirecodigos) == 1){
          $this->gateway->deleteTiporecurso($tirecodigos);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
    function getByIdTiporecurso($tirecodigos)
    {
	  $data_tiporecurso = $this->gateway->getByIdTiporecurso($tirecodigos);
      return $data_tiporecurso;
    }
    function getAllTiporecurso()
    {
     //$this->gateway->
    }
    function UnsetRequest()
    {
     unset($_REQUEST["tiporecurso__tirecodigos"]);
     unset($_REQUEST["tiporecurso__tirenombres"]);
     unset($_REQUEST["tiporecurso__tiredescrips"]);
    }
}
?>	
