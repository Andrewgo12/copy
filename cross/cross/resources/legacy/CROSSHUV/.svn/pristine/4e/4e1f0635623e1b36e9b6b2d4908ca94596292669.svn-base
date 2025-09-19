<?php
   				
/**
* @Copyright 2005 Parquesoft
*
* Clase manager de la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
class FeCuContratoprodManager{
    var $gateway;
    
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function FeCuContratoprodManager(){
     $this->gateway = Application::getDataGateway("contratoprod");
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo adicion de datos tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
   	function addContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris){
        if($this->gateway->existContratoprod($contnics,$prodcodigos) == 0){
            //Trae la garantia del prodducto y el producto para conocer el valor nominal
            $service = Application :: loadServices("Products");
            $rcWarranty = $service->getWarrantyByProd($prodcodigos,$closeService=false);
            $rcProducto = $service->getProducto($prodcodigos);
            if($coprcantidan == "NULL")
                $coprcantidan = 1;
            if($coprvalunidn == "NULL"){
                if($rcProducto[0]["prodvalorn"])
                    $coprvalunidn = $rcProducto[0]["prodvalorn"];
            }
            if(is_array($rcWarranty)){
                if($copovigencn == "NULL")
                    $copovigencn = $rcWarranty[0]["garavigencn"];
                if(!$copodefinis)
                    $copodefinis = $rcWarranty[0]["garadefinis"];
                if(!$copoclausus)
                    $copoclausus = $rcWarranty[0]["garaclausus"];
                if(!$coporestris)
                    $coporestris = $rcWarranty[0]["gararestris"];
            }
            
            $result = $this->gateway->addContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris);
            if($result == false)
                return 5;
            $this->UnsetRequest();
            return 3;
        }else{
            return 1;
        }
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de actualizacion de datos tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function updateContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris){
      if($this->gateway->existContratoprod($contnics,$prodcodigos) == 1){
          $result = $this->gateway->updateContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris);
		  if($result == false)
			return 5;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
 	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de eliminacion de datos tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function deleteContratoprod($contnics,$prodcodigos){
      if($this->gateway->existContratoprod($contnics,$prodcodigos) == 1){
          $result = $this->gateway->deleteContratoprod($contnics,$prodcodigos);
		  if($result){
    		 $this->UnsetRequest();
             return 3;
          }else{
             return 5;
          }
      }else{
          return 2;
      }
    }
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta los datos por la llave primaria de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function getByIdContratoprod($contnics,$prodcodigos){
	  $data_contratoprod = $this->gateway->getByIdContratoprod($contnics,$prodcodigos);
      return $data_contratoprod;
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function getAllContratoprod(){
	  $data_contratoprod = $this->gateway->getAllContratoprod($contnics,$prodcodigos);
      return $data_contratoprod;

    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para limpiar los datos de la sesion de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function UnsetRequest(){
    
		unset($_REQUEST["contratoprod__contnics"]);
		unset($_REQUEST["contratoprod__prodcodigos"]);
		unset($_REQUEST["contratoprod__coprcantidan"]);
		unset($_REQUEST["contratoprod__coprvalunidn"]);
		unset($_REQUEST["contratoprod__coprserials"]);
		unset($_REQUEST["contratoprod__copovigencn"]);
		unset($_REQUEST["contratoprod_copodefinis"]);
		unset($_REQUEST["contratoprod_copoclausus"]);
		unset($_REQUEST["contratoprod_coporestris"]);
    }

}

?>	
 	