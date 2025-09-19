<?php
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrAuthManager
{
    var $gateway;
    
    function FePrAuthManager()
    {
     $this->gateway = Application::getDataGateway("auth");
    }

    function addAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos)
    {
      if($this->gateway->existAuth($authusernams) == 0){
          $this->gateway->addAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos);
		  if($this->gateway->consult == false)
			return 100;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 1;
      }
    }

    function updateAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos,$authestados)
    {
      if($this->gateway->existAuth($authusernams) == 1){
          $this->gateway->updateAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos,$authestados);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function deleteAuth($authusernams)
    {
      if($this->gateway->existAuth($authusernams) == 1){
          $this->gateway->deleteAuth($authusernams);
		  if($this->gateway->consult == false)
			return 2;
		  $this->UnsetRequest();
          return 3;
      }else{
          return 2;
      }
    }
  
    function getByIdAuth($authusernams)
    {
	  $data_auth = $this->gateway->getByIdAuth($authusernams);
      return $data_auth;
    }
    
    function getAllAuthByApp($applcodigos,$schecodigon)
    {
		$sqlExtended = Application::getDataGateway("Extend");
     	return $sqlExtended->getAllAuthByApp($applcodigos,$schecodigon) ;
    }

    function getActiveAuthByApp($applcodigos,$schecodigon)
    {
		$sqlExtended = Application::getDataGateway("Extend");
     	return $sqlExtended->getActiveAuthByApp($applcodigos,$schecodigon) ;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Crea un usuario para el webservice
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 11-August-2005 16:27:47
    * @location Cali-Colombia
    */

    function addAuth2Ws($authusernams, $authuserpasss, $authrealname, $authrealape1, $authrealape2, $context)
    {   
        if($this->gateway->existAuth($authusernams) == 0){
            $gatewayExtended = Application::getDataGateway("SqlExtended");

            //Carga desde las constantes los datos por defecto 
            $applcodigos = Application::getConstant('DEFAULT_APP');
            $stylcodigos = Application::getConstant('DEFAULT_STYLE');
            $langcodigos = Application::getConstant('DEFAULT_LANG');
            if($context){
                $schemaGateway = Application::getDataGateway('Schema');
                $result = $schemaGateway->existSchema($context);
                if(!$result)
                    return false;
                $schecodigon = $context;
            }else
                $schecodigon = Application::getConstant('DEFAULT_SCHEMA');
            $profcodigos = Application::getConstant('DEFAULT_PROF');
            $gatewayExtended->addAuth2Ws($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$applcodigos,$stylcodigos,$langcodigos,$profcodigos);
            $gatewayExtended->addAuthschema($authusernams,$schecodigon);
            //Ejecuta los sql en un transacción
            $gatewayExtended-> execSql();
            if($gatewayExtended->consult == false)
                return false;
            return true;
        }else{
            return false;
      }
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar la clave de un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newPassword
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function updateUserPassword($userName, $newPassword){
        //Valida la existencia del usuario
        if($this->gateway->existAuth($userName) == 0)
            return false;
        $gatewayExtended = Application::getDataGateway("SqlExtended");
        $gatewayExtended->updateUserPassword($userName, $newPassword);
        if($gatewayExtended->consult == false)
            return false;
        return true;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el estado de un uausrio
    * @author creyes
    * @param string $userName
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function updateUserState($userName, $newState){
        //Valida la existencia del usuario
        if($this->gateway->existAuth($userName) == 0)
            return false;
        $gatewayExtended = Application::getDataGateway("SqlExtended");
        $gatewayExtended->updateUserState($userName, $newState);
        if($gatewayExtended->consult == false)
            return false;
        return true;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el perfil de un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newProfile
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function updateUserProfile($userName, $newProfile, $applcodigos=1){
        //Valida la existencia del usuario
        if($this->gateway->existAuth($userName) == 0)
            return false;
            
        //Valida que exista el perfil
        $gatewayProfiles = Application :: getDataGateway("profiles");
        if($gatewayProfiles->existProfiles($newProfile, $applcodigos) == 0)
            return false;
            
        $gatewayExtended = Application::getDataGateway("SqlExtended");
        $gatewayExtended->updateUserProfile($userName, $newProfile);
        if($gatewayExtended->consult == false)
            return false;
        return true;
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el lokk and fell de un usuario
    * @author freina<freina@parquesoft.com>
    * @param string $userName Cadena con el nick del usuario
    * @param string $stylcodigos Cadena con el estilo
    * @param string $langcodigos Cadena con el lenguaje
    * @return true or false
    * @date 26-Apr-2006 14:38:00
    * @location Cali-Colombia
    */
    function updateUserEnvironment($userName, $stylcodigos, $langcodigos){
        
        settype($objGateway,"object");
        
        //Valida la existencia del usuario
        if($this->gateway->existAuth($userName) == 0){
        	return false;
        }
            
        $objGateway = Application::getDataGateway("SqlExtended");
        $objGateway->updateUserEnvironment($userName, $stylcodigos, $langcodigos);
        if($objGateway->consult == false){
        	return false;
        }
        return true;
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el password de un usuario
    * @author freina<freina@parquesoft.com>
    * @param string $sbAuthusernams Cadena con el nick del usuario
    * @param string $sbAuthuserpass Cadena con el nuevo password
    * @return true or false
    * @date 26-Apr-2006 14:33:00
    * @location Cali-Colombia
    */
    function updateAuthPassword($sbAuthusernams, $sbAuthuserpass){
        
        settype($objGateway,"object");
        
        //Valida la existencia del usuario
        if($this->gateway->existAuth($sbAuthusernams) == 0){
        	return false;
        }
            
        $objGateway = Application::getDataGateway("SqlExtended");
        $objGateway->updateAuthPassword($sbAuthusernams, $sbAuthuserpass);
        if($objGateway->consult == false){
        	return false;
        }
        return true;
    }

    function getAllAuth()
    {
     //$this->gateway->
    }
     
    function getByAuth_fkey($profcodigos,$applcodigos)
    {
     //$this->gateway->
    }
     
    function getByAuth_fkey1($stylcodigos,$applcodigos)
    {
     //$this->gateway->
    }
     
    function getByAuth_fkey2($langcodigos)
    {
     //$this->gateway->
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Valida si existen usuarios en el esquema
    * @author freina<freina@parquesoft.com>
    * @param integer $nuSchecodigon entero con el id del esquema
    * @return true or false
    * @date 22-Mar-2006 12:01
    * @location Cali-Colombia
    */
    function existAuthBySchecodigon($nuSchecodigon){
    	
    	settype($objGateway,"object");
    	$objGateway = Application::getDataGateway("SqlExtended");
    	if($objGateway->amountAuthBySchecodigon($nuSchecodigon) == 0){
    		return false;
    	}
    	return true;
    }
    function UnsetRequest()
    {
        unset($_REQUEST["auth__authusernams"]);
        unset($_REQUEST["auth__authuserpasss"]);
        unset($_REQUEST["auth__authrealname"]);
        unset($_REQUEST["auth__authrealape1"]);
        unset($_REQUEST["auth__authrealape2"]);
        unset($_REQUEST["auth__authemail"]);
        unset($_REQUEST["auth__applcodigos"]);
        unset($_REQUEST["auth__stylcodigos"]);
        unset($_REQUEST["auth__langcodigos"]);
        unset($_REQUEST["auth__profcodigos"]);
        unset($_REQUEST["auth__schecodigon"]);
    }

}
?>