<?php
   				

class FeScCategoriaManager
{
    var $gateway;
    
    function FeScCategoriaManager()
    {
     $this->gateway = Application::getDataGateway("categoria");
    }

    function addCategoria($catecodigon,$catenombres,$catedescris,$cateactivas)
    {
      if($this->gateway->existCategoria($catecodigon) == 0){
          $this->gateway->addCategoria($catecodigon,$catenombres,$catedescris,$cateactivas);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateCategoria($catecodigon,$catenombres,$catedescris,$cateactivas)
    {
      if($this->gateway->existCategoria($catecodigon) == 1){
          $this->gateway->updateCategoria($catecodigon,$catenombres,$catedescris,$cateactivas);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteCategoria($catecodigon)
    {
      if($this->gateway->existCategoria($catecodigon) == 1){
          $this->gateway->deleteCategoria($catecodigon);
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdCategoria($catecodigon)
    {
	  $data_categoria = $this->gateway->getByIdCategoria($catecodigon);
      return $data_categoria;
    }

    function getAllCategoria()
    {
     //$this->gateway->
    }
      

    function UnsetRequest()
    {
     unset($_REQUEST["categoria__catecodigon"]);
     unset($_REQUEST["categoria__catenombres"]);
     unset($_REQUEST["categoria__catedescris"]);
     unset($_REQUEST["categoria__cateactivas"]);
    }

}

?>	
 	