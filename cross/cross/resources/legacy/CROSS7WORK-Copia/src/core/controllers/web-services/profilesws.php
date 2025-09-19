<?php
/*  $include_path = ini_get("include_path");
  $include_path .= (substr(php_uname(), 0, 3) == "Win") ? ";" : ":";
  $include_path .= "/srv/www/htdocs/[APP]/ASAP/lib/pear";
  ini_set("include_path", $include_path);
*/

require_once dirname(__FILE__)."/../Application.class.php";

/**
	Copyright 2004 � FullEngine
	
	Servicio web del modulo del profiles
	@author creyes <cesar.reyes@parquesoft.com>
	@date 25-ago-2004 10:31:44
	@location Cali-Colombia
*/
class ProfilesWS{

    function ProfilesWS(){
        //Carga los include iniciales desde el modulo general
		$dir_name = dirname(__FILE__)."/../../../applications/general";
		$objTmp = new Application("general", $dir_name);
        include('SOAP/Server.php');
        include('SOAP/Disco.php');
    
        //Set de varibles para el metodo getUser
        $this->__typedef['user'] = 
                    array(
                        'authusernams' => 'string',
                        'authuserpasss' => 'string',
                        'authrealname' => 'string',
                        'authrealape1' => 'string',
                        'authrealape2' => 'string',
                        'authemail' => 'string',
                        'applcodigos' => 'string',
                        'stylcodigos' => 'string',
                        'langcodigos' => 'string',
                        'profcodigos' => 'string',
                        );
        $this->__dispatch_map['getUser'] = array(
                'in'=>array('userName'=>'string'),
                'out'=>array('user'=>'user'));
        // END
        
        //Set de variables para el metodo getProfiles
        $this->__typedef['context'] = 
                    array(
                        'schecodigon' => 'string',
                        'schenombres' => 'string',
                        );
        $this->__dispatch_map['getContext'] = array(
                'in'=>array(),
                'out'=>array('context'=>'context'));
        // END
        
        //Set de variables para el metodo addUser
        $this->__dispatch_map['addUser'] = array(
                'in'=>array('userName'=>'string',
                            'password'=>'string',
                            'firstName'=>'string',
                            'lastNames'=>'string',
                            'context'=>'string',
                            ),
                'out'=>array('action'=>'int'));
                
        //Set de variables para updateUserPassword
        $this->__dispatch_map['updateUserPassword'] = array(
                'in'=>array('userName'=>'string',
                            'newPassword'=>'string',
                            ),
                'out'=>array('action'=>'int'));
        // END
        //Set de variables para updateUserProfile
        /*$this->__dispatch_map['updateUserProfile'] = array(
                'in'=>array('userName'=>'string',
                            'newProfile'=>'string',
                            ),
                'out'=>array('action'=>'int'));*/
        // END
        //Set de variables para activeUserState
        $this->__dispatch_map['activeUserState'] = array(
                'in'=>array('userName'=>'string'),
                'out'=>array('action'=>'int'));
        // END
        //Set de variables para inactivateUserState
        $this->__dispatch_map['inactivateUserState'] = array(
                'in'=>array('userName'=>'string'),
                'out'=>array('action'=>'int'));
        // END
        return true;
    }
	/**
	* Copyright 2004 � FullEngine
	
	* Carga el controlador frontal
	* @param string $module
	* @return boolean
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 25-ago-2004 13:53:25
	* @location Cali-Colombia		
	*/
    function loadApplication($module){
		$dir_name = dirname(__FILE__)."/../../../applications/$module";
		$objTmp = new Application($module, $dir_name,true);
        return true;
    }
	/**
	* Copyright 2004 � FullEngine
	
	* Obtiene el registro de un usuario
	* @param string $userName
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 25-ago-2004 13:53:25
	* @location Cali-Colombia		
	*/
	function getUser($userName) {
        $this->loadApplication("profiles");
   		$auth_manager = Application :: getDomainController('AuthManager');
        $rcUser = $auth_manager->getByIdAuth($userName);
        if(!is_array($rcUser))
            return -1;
		return $rcUser;
    }
	/**
	* @Copyright 2004 � FullEngine
	*
	* Obtiene los contextos desde la aplicacion
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 17-dic-2004 11:26:11
	* @location Cali - Colombia
	*/
	function getContext() {
        $this->loadApplication("profiles");
		$schemaManager = Application :: getDomainController('SchemaManager');
        return $schemaManager->getSchemas();
	}
    /**
    * Copyright 2005 FullEngine
    *
    * Crea un usuario en cross
    * @author creyes
    * @param string $userName
    * @param string $password
    * @param string $personalCode
    * @param string $profile
    * @return type name desc
    * @date 11-August-2005 15:40:26
    * @location Cali-Colombia
    */
    function addUser($userName, $password, $firstName, $lastNames, $context){
        if(!$userName || !$password || !$firstName || !$lastNames)
            return -1;
            
        $this->loadApplication("profiles");
        $dataType = Application::loadServices('Data_type');
        //Valida el formato y el tama�o de la clave
        if(!$dataType->formatPrimaryKey($password) || (strlen($password) < 4) )
            return -1;
        //Valida el formato y el tama�o del nombre de usuario
        if(!$dataType->formatPrimaryKey($userName) || (strlen($userName) < 4) )
            return -1;
        $authManager = $styleManager = Application :: getDomainController('AuthManager');
        $rcLastnames = explode(' ', $lastNames);
        $result = $authManager->addAuth2Ws($userName, $password, $firstName, $rcLastnames[0], $rcLastnames[1], $context);
        if($result == false)
            return -1;
        return 1;
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
        if(!$userName || !$newPassword)
            return -1;
        $this->loadApplication("profiles");
        $dataType = Application::loadServices('Data_type');
        //Valida el formato y el tama�o de la clave
        if(!$dataType->formatPrimaryKey($newPassword) || (strlen($newPassword) < 4) )
            return -1;
        $authManager = $styleManager = Application :: getDomainController('AuthManager');
        $result = $authManager->updateUserPassword($userName, $newPassword);
        if($result == false)
            return -1;
        return 1;
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
    /*function updateUserProfile($userName, $newProfile){
        if(!$userName || !$newProfile)
            return -1;
        $this->loadApplication("profiles");
        $authManager = $styleManager = Application :: getDomainController('AuthManager');
        $result = $authManager->updateUserProfile($userName, $newProfile);
        if($result == false)
            return -1;
        return 1;
    }*/
    /**
    * Copyright 2005 FullEngine
    *
    * Permite activar un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newProfile
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function activeUserState($userName){
        if(!$userName)
            return -1;
        $this->loadApplication("profiles");
        $authManager = $styleManager = Application :: getDomainController('AuthManager');
        $state = Application::getConstant('REG_ACTIVE');
        $result = $authManager->updateUserState($userName,$state);
        if($result == false)
            return -1;
        return 1;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite inactivar un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newProfile
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function inactivateUserState($userName){
        if(!$userName)
            return -1;
        $this->loadApplication("profiles");
        $authManager = $styleManager = Application :: getDomainController('AuthManager');
        $state = Application::getConstant('REG_INACT');
        $result = $authManager->updateUserState($userName,$state);
        if($result == false)
            return -1;
        return 1;
    }
}


$webservice = new ProfilesWS();
$server = new SOAP_Server();
$server->addObjectMap($webservice, 'http://schemas.xmlsoap.org/soap/envelope/');

if (isset($_SERVER['REQUEST_METHOD'])  &&
    $_SERVER['REQUEST_METHOD']=='POST') {
    $server->service($HTTP_RAW_POST_DATA);
} else {
    // Create the DISCO server
    $disco = new SOAP_DISCO_Server($server,'ProfilesWS');
    header("Content-type: text/xml");
    if (isset($_SERVER['QUERY_STRING']) &&
       strcasecmp($_SERVER['QUERY_STRING'],'wsdl') == 0) {
       echo $disco->getWSDL();
    } else {
       echo $disco->getDISCO();
    }
}
?> 