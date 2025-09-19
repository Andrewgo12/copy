<?php
   				
/**
* @Copyright 2005 Parquesoft
*
* Clase manager de la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
class FeWFEstadotareaManager{
    var $gateway;
    
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function FeWFEstadotareaManager(){
     $this->gateway = Application::getDataGateway("estadotarea");
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo adicion de datos tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
   	function addEstadotarea($tarecodigos,$esaccodigos){
      if($this->gateway->existEstadotarea($tarecodigos,$esaccodigos) == 0){
          $result = $this->gateway->addEstadotarea($tarecodigos,$esaccodigos);
		  if($result == false)
			return 100;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de actualizacion de datos tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function updateEstadotarea($tarecodigos,$esaccodigos){
      if($this->gateway->existEstadotarea($tarecodigos,$esaccodigos) == 1){
          $result = $this->gateway->updateEstadotarea($tarecodigos,$esaccodigos);
		  if($result == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
 	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de eliminacion de datos tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function deleteEstadotarea($tarecodigos,$esaccodigos){
      if($this->gateway->existEstadotarea($tarecodigos,$esaccodigos) == 1){
          $result = $this->gateway->deleteEstadotarea($tarecodigos,$esaccodigos);
		  if($result){
    		 $this->UnsetRequest();
             return 3;
          }else{
             return 2;
          }
      }else{
          return 2;
      }
    }
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta los datos por la llave primaria de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function getByIdEstadotarea($tarecodigos,$esaccodigos){
	  $data_estadotarea = $this->gateway->getByIdEstadotarea($tarecodigos,$esaccodigos);
      return $data_estadotarea;
    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo consulta todos los datos de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function getAllEstadotarea(){
	  $data_estadotarea = $this->gateway->getAllEstadotarea($tarecodigos,$esaccodigos);
      return $data_estadotarea;

    }

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para limpiar los datos de la sesion de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
    function UnsetRequest(){
    
		unset($_REQUEST["estadotarea__tarecodigos"]);
		unset($_REQUEST["estadotarea__esaccodigos"]);
    }

}

?>	
 	