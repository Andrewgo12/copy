<?php      
/**
	Copyright 2004 © FullEngine
	
	Servicio de manejo de perfiles de usuario
	@author creyes <cesar.reyes@parquesoft.com>
	@date 25-ago-2004 10:31:44
	@location Cali-Colombia
*/

class Profiles {

	var $appName;
	var $appDir;
	function Profiles() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();
		
        //Modifica los datos 
        $rcUser = Application::getUserParam();
        $this->userSchema = $rcUser['schema'];
        $rcUser['schema'] = 1;
        WebSession::setProperty("_authsession",$rcUser);
        
		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/profiles";
		$name = "profiles";
		$objTmp = new Application($name, $dir_name, true);
	}
	/**
		Copyright 2004 © FullEngine
		
		Muestra toda la informacion del servicio
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 13:55:48
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array ("getUser" => "Copyright 2004 © FullEngine<br>
				Optiene el registro de un usuario<br>
				@param string \$userName<br>
				@return array<br>
				@author creyes <cesar.reyes@parquesoft.com><br>
				@date 25-ago-2004 13:53:25<br>
				@location Cali-Colombia<br>", "getAllUser" => "Copyright 2004 © FullEngine
				Obtiene los nombres de usuario<br>
				@param string  \$applcodigos codigo de aplicacion<br>
				@return array<br>
				@author creyes <cesar.reyes@parquesoft.com><br>
				@date 25-ago-2004 13:53:25<br>
				@location Cali-Colombia", "getCommands" => "Copyright 2004 © FullEngine<br>
					Carga el todos los comandos de un perfil<br>
					@param string \$codApp Codigo de la aplicacion<br>
					@param string \$codProfile Codigo del perfil<br>
					@param string \$command nombre del comando<br>
					@author creyes <cesar.reyes@parquesoft.com><br>
					@date 26-ago-2004 14:04:33
					@location Cali-Colombia", "getAuth" => "@Copyright 2004 © FullEngine
						Hace la autenticacion del usuario y retorna un vector con los datos
						basicos del usuario en caso de autenticacion valida o false en caso de la
						autenticacion no valida
						@param \$username 
						@param \$password
						@return boolean  
						@author creyes <cesar.reyes@parquesoft.com>
						@date 15-dic-2004 15:18:12
						@location Cali - Colombia", 
		"loadManager" => "@copyright Copyright 2004 &copy; FullEngine
						 Crea una interfaz con un manager del modulo
						 Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
						 @param string $manager nombre del manager a cargar
						 @return object
						 @author creyes <cesar.reyes@parquesoft.com>
						 @date 24-nov-2004 12:11:38
						 @location Cali-Colombia",
			"getGateWay" => "@copyright Copyright 2004 &copy; FullEngine
						 Crea una interfaz con un manager del modulo
						 Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
						 @param string $manager nombre del manager a cargar
						 @return object
						 @author creyes <cesar.reyes@parquesoft.com>
						 @date 24-nov-2004 12:11:38
						 @location Cali-Colombia",
			"loadGateWay" => "@copyright Copyright 2004 &copy; FullEngine
						 Crea una interfaz con un manager del modulo
						 Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
						 @param string $manager nombre del manager a cargar
						 @return object
						 @author creyes <cesar.reyes@parquesoft.com>
						 @date 24-nov-2004 12:11:38
						 @location Cali-Colombia",
			"getByStyleByAppl" => "@Copyright 2004 © FullEngine
	Obtiene los estilos desde la aplicacion
	@param string $applcodigos
	@return array 
	@author creyes <cesar.reyes@parquesoft.com>
	@date 17-dic-2004 11:26:11
	@location Cali - Colombia",
    "getMetaProfilesLabels"=>"@Copyright 2004 © FullEngine
	Obtiene el archivo de lenguaje de los metaprofiles
     @params string $isbLanguage Cadena con el lenguaje del usuario
     @params string $isbFlag Cadena con el lenguaje del usuario
    @return array $orcResult Arreglo con los labels del metaprofiles
	@author freina<freina@parquesoft.com>
	@date 27-Dec-2005 10:33:00
	@location Cali - Colombia",
     "getWebUser"=>"@Copyright 2004 FullEngine" .
			"Obtiene los esquemas creados en el sistema" .
			"@return array $orcResult Arreglo con los esquemas" .
			"@author freina<freina@parquesoft.com>" .
			"@date 14-Mar-2005 13:49:00" .
			"@location Cali - Colombia",
    "getSchema"=>"@Copyright 2004 FullEngine" .
			"Obtiene los esquemas creados en el sistema" .
			"@return array $orcResult Arreglo con los esquemas" .
			"@author freina<freina@parquesoft.com>" .
			"@date 14-Mar-2005 13:49:00" .
			"@location Cali - Colombia",
    "getSessionSchema"=>"@Copyright 2004 FullEngine" .
			"Obtiene los esquemas creados en el sistema" .
			"@return array $orcResult Arreglo con los esquemas" .
			"@author freina<freina@parquesoft.com>" .
			"@date 14-Mar-2005 13:49:00" .
			"@location Cali - Colombia  ",
	"getUserSchema"=>'@Copyright 2011 FullEngine
						Obtiene los usuarios de un esquema
						@param $rcParam Array Arreglo con parametros
						@param $sbFlag boolean true cierra el servicio, false no
						@return array $rcResult Arreglo con la informacion de los usuarios
						@author freina<freina@parquesoft.com>
						@date 01-Apr-2011 07:48:00
						@location Cali - Colombia',
			);

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data)
			echo "<tr><td>$key</td><td>".str_replace("\t", "", $data)."</td></td>";
		echo "</table>";
	}
	/**
		Copyright 2004 © FullEngine
		
		Regresa a la aplicacion su configuracion
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 14:32:20
		@location Cali-Colombia
		@note NOTA: Este metodo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
        $rcUser = Application::getUserParam();
        $rcUser['schema'] = $this->userSchema;
        WebSession::setProperty("_authsession",$rcUser);
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
	/**
		Copyright 2004 © FullEngine
		
		Obtiene el registro de un usuario
		@param string $userName
		@return array
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 13:53:25
		@location Cali-Colombia		
	*/
	function getUser($userName) {
		if (!$userName)
			return null;
		$auth_manager = Application :: getDomainController('AuthManager');
		$rcReturn = $auth_manager->getByIdAuth($userName);
		$this->close();
		return $rcReturn;
	}
	/**
		Copyright 2004 © FullEngine
		
		Obtiene los nombres de usuario
		@param string  $applcodigos codigo de aplicacion
		@return array
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 13:53:25
		@location Cali-Colombia		
	*/
	function getAllUser($applcodigos, $schecodigon) {
		$auth_manager = Application :: getDomainController('AuthManager');
		$rcReturn = $auth_manager->getAllAuthByApp($applcodigos,$schecodigon);
		$this->close();
		return $rcReturn;
	}
    
	/**
		Copyright 2004 © FullEngine
		
		Obtiene los nombres de usuario activos
		@param string  $applcodigos codigo de aplicacion
		@return array
		@author creyes <cesar.reyes@parquesoft.com>
		@date 25-ago-2004 13:53:25
		@location Cali-Colombia		
	*/
	function getActiveUser($applcodigos, $schecodigon) {
		$auth_manager = Application :: getDomainController('AuthManager');
		$rcReturn = $auth_manager->getActiveAuthByApp($applcodigos,$schecodigon);
		$this->close();
		return $rcReturn;
	}
    
	/**
		Copyright 2004 © FullEngine
		
		Carga el todos los comandos de un perfil
		@param string $codApp Codigo de la aplicacion
		@param string $codProfile Codigo del perfil
		@param string $command nombre del comando
		@return array Vector de indices numericos con los nombres de los comandos
		@return null Si no existe configuracion para este perfil
		@author creyes <cesar.reyes@parquesoft.com>
		@date 26-ago-2004 14:04:33
		@location Cali-Colombia 
	*/
	function getCommands($codApp, $codProfile) {
		$comm_manager = Application :: getDomainController('PermisionsManager');
		$rcReturn = $comm_manager->getByPermisions_fkeycache($codProfile, $codApp);
		$this->close();
		return $rcReturn;
	}
	/**
	* @Copyright 2004 © FullEngine
	*
	* Hace la autenticacion del usuario y retorna un vector con los datos
	* basicos del usuario en caso de autenticacion valida o false en caso de la
	* autenticacion no valida
	* @param $username 
	* @param $password
	* @return boolean  
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-dic-2004 15:18:12
	* @location Cali - Colombia
	*/
	function getAuth($username) {
		if (!$username) {
			$this->close();
			return false;
		}
		$login_manager = Application :: getDomainController('LoginManager');
		
        //Consulta los datos del usuario
		$_authsession = $login_manager->getSessionDataUser($username);
		if (!is_array($_authsession)) {
			$this->close();
			return false;
		}
		$this->close();
		return $_authsession;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Crea una interfaz con un manager del modulo
	* Nota: despues de usar este motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $manager nombre del manager a cargar
	* @return object
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function loadManager($manager) {
		$manager = Application :: getDomainController($manager);
		return $manager;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Crea una interfaz con una compuerta del modulo Nota: despues de usar este
	* motodo se debe cerrar este servicio manual mente con el metodo close()
	* @param string $manager nombre del manager a cargar
	* @return object
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:11:38
	* @location Cali-Colombia
	*/
	function loadGateway($gateway) {
		return  Application :: getDataGateway($gateway);
	}
	/**
    * Copyright 2005 FullEngine
    * 
    * Carga una compuerta de esta modulo
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 23-December-2005 12:56:3
    * @location Cali-Colombia
    */
    function getGateWay($gatewayName){
        return Application :: getDataGateway($gatewayName);
    }
	/**
	* @Copyright 2004 © FullEngine
	*
	* Obtiene los estilos desde la aplicacion
	* @param string $applcodigos
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 17-dic-2004 11:26:11
	* @location Cali - Colombia
	*/
	function getByStyleByAppl($applcodigos) {
		if (!$applcodigos)
			return null;
		$styleManager = Application :: getDomainController('StyleManager');
		$rcReturn = $styleManager->getByStyle_fkey($applcodigos);
		$this->close();
		return $rcReturn;
	}
	/**
	* @Copyright 2004 © FullEngine
	*
	* Obtiene los idiomas
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 17-dic-2004 11:26:11
	* @location Cali - Colombia
	*/
	function getAllLanguage() {
		$styleManager = Application :: getDomainController('LanguageManager');
		$rcReturn = $styleManager->getAllLanguage();
		$this->close();
		return $rcReturn;
	}
    /**
	* @Copyright 2004 © FullEngine
	*
	* Obtiene el archivo de lenguaje de los metaprofiles
     *@params string $isbLanguage Cadena con el lenguaje del usuario
     *@params string $isbFlag Cadena con el lenguaje del usuario
	* @return array $orcResult Arreglo con los labels del metaprofiles
	* @author freina<freina@parquesoft.com>
	* @date 27-Dec-2005 10:33:00
	* @location Cali - Colombia
	*/
	function getMetaProfilesLabels($isbLanguage,$isbFlag=true) {
        
        settype($orcResult,"array");
         
         if($isbLanguage){
             include($isbLanguage."/".$isbLanguage.".metaprofiles.php");
             $orcResult = $rclabels;
             if($isbFlag){
                 $this->close();
             }
         }
         return $orcResult;
	}
	/**
	* @Copyright 2004FullEngine
	*
	* Obtiene los esquemas creados en el sistema
	* @return array $orcResult Arreglo con los esquemas
	* @author freina<freina@parquesoft.com>
	* @date 14-Mar-2005 13:49:00
	* @location Cali - Colombia
	*/
	function getSchema(){
		settype($objGateway,"object");
		settype($orcResult,"array");
		$objGateway = Application :: getDataGateway("SqlExtended");
		$orcResult = $objGateway->getDataCombo("schema");
		$this->close(); 
		return $orcResult;
	}

	function getSchemasUsuario(){
		settype($objGateway,"object");
		settype($orcResult,"array");

		$objGateway = Application :: getDataGateway("SqlExtended");
		$orcResult = $objGateway->getDataCombo("schemasusuario");
		$this->close(); 
		return $orcResult;
	}
	
	/**
	* @Copyright 2004FullEngine
	*
	* Obtiene los esquemas creados en el sistema
	* @return array $orcResult Arreglo con los esquemas
	* @author freina<freina@parquesoft.com>
	* @date 14-Mar-2005 13:49:00
	* @location Cali - Colombia
	*/
	function getSessionSchema(){
		settype($objGateway,"object");
		settype($orcResult,"array");
		$objGateway = Application :: getDataGateway("SqlExtended");
		$orcResult = $objGateway->getDataCombo("sessionschema");
		$this->close(); 
		return $orcResult;
	}
    
        function getWebUser(){
            settype($objGateway,"object");
            settype($orcResult,"array");
            
            $sbWebUser = Application::getConstant('WEB_USER');
            $rcUserParam = Application::getUserParam();
            $schecodigon = $rcUserParam['schecodigon'];
            
            $objGateway = Application::getDataGateway('Authschema');
            $orcResult = $objGateway->getAuthAuthSchema($sbWebUser,$schecodigon);
            $this->close();
            return $orcResult;
        }
    /**
	* @Copyright 2011 FullEngine
	*
	* Obtiene los usuarios de un esquema
	* @param $rcParam Array Arreglo con parametros
	* @param $sbFlag boolean true cierra el servicio, false no
	* @return array $rcResult Arreglo con la informacion de los usuarios
	* @author freina<freina@parquesoft.com>
	* @date 01-Apr-2011 07:48:00
	* @location Cali - Colombia
	*/
	function getUserSchema($rcParam,$sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		
		if(is_array($rcParam) && $rcParam){
			if($rcParam["schecodigon"]){
				$rcTmp['schecodigon'][0] = $rcParam["schecodigon"];
			}
		if($rcParam["user"]){
				$rcTmp['user'][0] = $rcParam["user"];
			}
		}

		$objGateway = Application :: getDataGateway("SqlExtended");
		$rcResult = $objGateway->getDataCombo("userschema",$rcTmp);
		if($sbFlag){
			$this->close();	
		} 
		return $rcResult;
	}
}
?>