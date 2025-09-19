<?php
require_once "PEAR.php";
require_once "ASAP.class.php";
require_once "Data/Serializer.class.php";
require_once "Web/WebRegistry.class.php";
require_once "Web/WebSession.class.php";
class Application {

	function Application($name, $dir_name, $flag = false) {
		// load the configuration file from the directory
        Application :: __loadConfig($dir_name, $flag);

		// set the application name and directory
		Application :: setBaseDirectory($dir_name);
		Application :: setName($name);

		// initialize the static variables
		Application :: init();
	}

	function getDataODBC() {
		return Application :: __getVar('odbc');
	}

	//funcion adicionada por Hemerson para optener el lenguaje de la aplicacion.
	function getLanguage() {
		return Application :: getSingleLang();
	}
	//Metodo adicionada por Cesar Reyes para extraer el solo el nombre del lenguaje
	function getSingleLang() {
		return Application :: __getVar('language');
	}
	function getBaseDirectory() {
		return Application :: __getVar('base_dir');
	}

	function setBaseDirectory($dir_name) {
		Application :: __setVar('base_dir', $dir_name);
	}

	function getName() {
		return Application :: __getVar('name');
	}

	function setName($name) {
		Application :: __setVar('name', $name);
	}
	/**
		Copyright 2004 � FullEngine
		
		Obtiene el directorio de cache
		@return string PATH del directorio de cache
		@author creyes <cesar.reyes@parquesoft.com>
		@date 27-ago-2004 9:41:05
		@location Cali-Colombia
	*/
	function getDirCache() {
		return Application :: __getVar('cache_dir');
	}
	/**
		Copyright 2004 � FullEngine
		
		Obtiene la vida del cache
		@return integer Cantidad de segundos
		@author creyes <cesar.reyes@parquesoft.com>
		@date 29-sep-2004 10:33:05
		@location Cali-Colombia
	*/
	function getCacheLife() {
		return Application :: __getVar('cache_life');
	}
	/**
		Copyright 2004 � FullEngine
		
		Obtiene la identificacion de la aplicacion
		@return integer Cantidad de segundos
		@author creyes <cesar.reyes@parquesoft.com>
		@date 29-sep-2004 10:33:05
		@location Cali-Colombia
	*/
	function getAppId() {
		return Application :: __getVar('app_id');
	}

	function getDescription() {
		return Application :: __getVar('description');
	}

	function getVersion() {
		return Application :: __getVar('version');
	}

	function & getIncludePath() {
		return Application :: __getVar('include_path');
	}

	function getCommandsDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('commands_dir');
	}

	function getViewsDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('views_dir');
	}

	function getPluginsDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('plugins_dir');
	}

	function getIconsDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('icons_dir');
	}

	function getScriptsDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('scripts_dir');
	}

	function getImagesDirectory() {
		return Application :: __getVar('images_dir');
	}

	function getImagesDirectoryCp() {
		return Application :: getBaseDirectory().Application :: __getVar('images_dir');
	}

	function getTemplatesDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('templates_dir');
	}

	function getTmpDirectory() {
		settype($rcUser,"array");
		settype($sbSchema,"string");
		$rcUser = Application :: getUserParam();
		if(is_array($rcUser) && $rcUser){
			if($rcUser["schema"]){
				$sbSchema = "/".$rcUser["schema"];	
			}
		}
		return Application :: getBaseDirectory().Application :: __getVar('tmp_dir').$sbSchema;
	}
	function getTmpDir() {
		settype($rcUser,"array");
		settype($sbSchema,"string");
		$rcUser = Application :: getUserParam();
		if(is_array($rcUser) && $rcUser){
			if($rcUser["schema"]){
				$sbSchema = "/".$rcUser["schema"];	
			}
		}
		return Application :: __getVar('tmp_dir').$sbSchema;
	}
	
	function getLanguageDirectory() {
		return Application :: getBaseDirectory().Application :: __getVar('language_dir');
	}
	
	function getLanguageFileDirectory() {
		return Application :: getLanguageDirectory()."/".Application :: __getVar('language');
	}

	function getDatabaseType() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		return $config['database']['type'];
	}
	
	function getDatabaseDriver() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		return $config['database']['driver'];
	}

	function getPathImage($directory) {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		return $config[$directory];
	}

	function getDataDirectory() {

		return Application :: getBaseDirectory().Application :: __getVar('data_dir');
	}

	function getApplicationClass() {
		return Application :: __getVar('app_class');
	}

	function & getConfigArray() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		return $config;
	}

	function getDomainDirectory() {
		return Application :: __getVar('domain_dir');
	}
	/** Adicionada por Cesar Reyes para obtener los datos del contenedor del profiles*/
	function getStorage() {
		return Application :: __getVar('auth_storage');
	}
	/** Adicionada por Cesar Reyes para obtener los datos del DSN del profiles*/
	function getDsn() {
		return Application :: __getVar('dsn');
	}

	function & getDomainController($name) {
		$name = Application :: getAppId().$name;
		$filename = Application :: getBaseDirectory().Application :: getDomainDirectory().'/'.$name.'.class.php';
		if (!class_exists($name))
			include_once $filename;

		if (!class_exists($name)) {
			return PEAR :: raiseError('domain controller not found');
		} else {
			$obj = new $name ();
			return $obj;
		}
	}

	function getDataGateway($name) {
		$name_dir = & ASAP :: getStaticProperty('Application', 'config');
		$classname = $name_dir['database']['type'].ucfirst($name);
		$classname = Application :: getAppId().$classname;
		$filename = Application :: getDataDirectory().'/'.$name_dir['database']['type'].'/'.$classname.'.class.php';
		if (!class_exists($classname))
			include_once $filename;

		if (!class_exists($classname)) {
			return PEAR :: raiseError('Gate way not found');
		} else {
			$obj = new $classname ();
			return $obj;
		}
	}

	/*function getDatabaseConnection() {
		$config = & ASAP :: getStaticProperty('Application', 'config');

		if (!isset ($config['dbConn'])) {

			switch ($config['database']['type']) {
				case 'Mysql' :
					$config['dbConn'] = mysql_pconnect($config['database']['host'], $config['database']['user'], $config['database']['password']);
					if (!$config['dbConn']) {
						return PEAR :: raiseError('error connecting to the database');
					}
					// select database name
					if (!mysql_select_db($config['database']['name'], $config['dbConn'])) {
						return PEAR :: raiseError('database name not found');
					}

					break;
				case 'Oracle' :
					$config['dbConn'] = OCIPLogon($config['database']['user'], $config['database']['password'], $config['database']['host']);

					if (!$config['dbConn']) {
						return PEAR :: raiseError('error connecting to the database');
					}

					break;
				case 'Pgsql' :
					$config['dbConn'] = pg_pconnect("host='".$config['database']['host']."'dbname='".$config['database']['name']."'user='".$config['database']['user']."' password='".$config['database']['password']."'");

					if (!$config['dbConn']) {
						return PEAR :: raiseError('error connecting to the database');
					}

					break;
				default :
					return PEAR :: raiseError('database not supported');
			}
			//return connetion
			return $config['dbConn'];
		} else {
			return $config['dbConn'];
		}
	}*/

	function init() {

		restore_include_path();

		$include_path = ini_get('include_path');
		if ($include_path == "") {
			$include_path = ".";
		}
		
		$dir = dirname(dirname(__FILE__))."/classes";
		$include_path .= (substr(php_uname(), 0, 3) == "Win") ? ";" : ":";
		$include_path .= $dir;
		
		foreach (Application :: getIncludePath() as $dir) {
			$include_path .= (substr(php_uname(), 0, 3) == "Win") ? ";" : ":";
			$include_path .= $dir;
		}
		ini_set('include_path', $include_path);
	}

	function & __getVar($nom_var) {

		$config = & ASAP :: getStaticProperty('Application', 'config');

		// if configuration data is not set
		if (!isset ($config)) {
			// load the configuration data
			// filename = <ASAP-dir>/applications/config/application.conf.data
			// @@ use the URL/directory
			$config = & Application :: __loadConfig(dirname(__FILE__));
		}
		if (!is_array($config)) {
			return PEAR :: raiseError('cannot load the configuration file');
		}
		return $config[$nom_var];
	}

	function __setVar($name = "", & $objVar) {
		$obj = & ASAP :: getStaticProperty('Application', 'config');
		$obj[$name] = $objVar;
	}

	function & __loadConfig($dir_name = "", $flag = false) {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		// if configuration data is not set
		if ($flag == false) {
			if (!isset ($config)) {
				$config = Serializer :: load($dir_name.'/config/application.conf.data');
			}
		} else {
			$config = Serializer :: load($dir_name.'/config/application.conf.data');
		}
		if (!is_array($config)) {
			return PEAR :: raiseError('cannot load the configuration file');
		}
		return $config;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Carga el NavigationFile de cualquier aplicaci�n 
	*   @author creyes
	*	@param string $dir_name
	*	@return array (Arreglo con la configuraci�n de la aplicacion)
	*   @date 10-ago-2004 11:58:43
	*   @location Cali-Colombia
	*/
	function & __loadNavApp($dir_name = "") {
		$navigation = Serializer :: load($dir_name.'/config/web.conf.data');
		if (!is_array($navigation)) {
			return PEAR :: raiseError('cannot load the Navigation file');
		}
		return $navigation;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Carga la constante pasada como parametro
	*   @author freina
	*	@param string $nom_var (Nombre de la constante)
	*	@return  (Valor de la constante)
	*   @date 29-Jul-2004 10:35
	*   @location Cali-Colombia
	*/
	function & __getCon($nom_var) {
        $user = Application::getUserParam();
        
        //Ajusta por defecto el esquema del profiles
        if(!is_array($user))
            $user["schema"] = 1;
            
        $rcConstant = Serializer :: load(Application::getBaseDirectory().'/config/application.constant.data'); 
		if (!is_array($rcConstant)) {
			return PEAR :: raiseError('cannot load the constants file');
		}
        $_CONSTANT = $rcConstant[$user["schema"]];
		return $_CONSTANT[$nom_var];
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Carga la constante pasada como parametro
	*   @author freina
	*	@param string $nom_var (Nombre de la constante)
	*	@return  (Valor de la constante)
	*   @date 29-Jul-2004 10:35
	*   @location Cali-Colombia
	*/
	function getConstant($nom_var) {
		return Application :: __getCon($nom_var);
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Carga la configuracion de usuario
	*   @author creyes
	*	@return  (Vector de usuario)
	*   @date 29-Jul-2004 10:35
	*   @location Cali-Colombia
	*/
	function getUserParam() {
		settype($rcUser,"array");
		$rcUser = WebSession :: getProperty("_authsession");
		return $rcUser;
	}
	/**
	*	Copyright 2004 � FullEngine
	*	
	*	Carga un servicio
	*	@param string $nameService Nombre del servicio
	*	@author creyes <cesar.reyes@parquesoft.com>
	*	@date 25-ago-2004 10:43:34
	*	@location Cali-Colombia
	*/
	function loadServices($nameService) {
		require_once dirname(__FILE__)."/Services/".$nameService.".class.php";
		return new $nameService;
	}
	/**
	*	Copyright 2004 � FullEngine
	*	
	* Carga una libreria
	* @param string $sbNameLib Nombre de la libreria
	* @param string $sbNameClass Nombre de la clase
	* @return object Carga el objeto
	* @author freina <freina@parquesoft.com>
	* @date 20-Jun-2005 17:08
	* @location Cali-Colombia
	*/
	function loadLib($sbNameLib, $sbNameClass = null) {
		require_once $sbNameLib.".class.php";
		if ($sbNameClass) {
			return new $sbNameClass;
		} else {
			return new $sbNameLib;
		}
	}
	/**
	*	Copyright 2004 � FullEngine
	*	
	*	Retorna un vector con los nombres de los servicios inscritos
	*	@return array Vector con los nombres de los servicios
	*	@author creyes <cesar.reyes@parquesoft.com>
	*	@date 25-ago-2004 10:55:43
	*	@location Cali-Colombia
	*/
	function viewServices() {
		$handle = opendir(dirname(__FILE__)."/Services/");
		$nuCont = 0;
		while (false !== ($file = readdir($handle)))
			if (!preg_match("#^\.#", $file))
				if (preg_match("#\.class\.php$#", $file)) {
					$rcTmp = explode(".", $file);
					$rcServices[$nuCont] = $rcTmp[0];
					$nuCont ++;
				}
		return $rcServices;
	}
	/**
		Copyright 2004 � FullEngine
		
		Valida los comandos con la aplicaci�n PROFILES, si en el configuration file no esta habilitada esta funcionalidad
		o si el comando no esta habilitado para se validado o no existe en la PROFILES retornara true.
		@param string $command nombre del comando 
		@author creyes <cesar.reyes@parquesoft.com>
		@date 26-ago-2004 13:55:19
		@location Cali-Colombia 	
	*/
	function validateProfiles($command) {
		//Valida si la aplicac�n tiene activada la opcion de manejo de perfiles
		$var = & Application :: __getVar("profiles");
		if ($var != "enabled")
			return true;
		//Valida si el comando es se�alado para validaci�n
		$var = & Application :: __loadNavApp(Application :: getBaseDirectory());
		$rcCommand = $var["commands"][$command];
		if ($rcCommand["validated"] != "true")
			return true;

		//Descarga el perfil de la sesion
		$profiles = WebSession :: getProperty("profiles");

		if (!is_array($profiles)) {
			//Si no existe en sesion el perfil lo carga desde la App de PROFILES y los pone en sesi�n
			$profiles = & Application :: __loadProfiles();
			WebSession :: setProperty("profiles", $profiles);
		}
		//Hace la validaci�n de perfil
		if (!is_array($profiles))
			return false;
		if (in_array($command, $profiles))
			return true;
		return false;
	}
	/**
		Copyright 2004 � FullEngine
		
		Consulta el perfil desde PROFILES
		@param string $appCode C�digo de la aplicaci�n 
		@param string $profCode C�digo del perfil 
		@return array Vector de indices n�mericos con los nombres de lso comandos 
		@author creyes <cesar.reyes@parquesoft.com>
		@date 26-ago-2004 14:45:50
		@location Cali-Colombia
	*/
	function & __getProfile($appCode, $profCode) {
		$service = Application :: loadServices("Profiles");
		return $service->getCommands($appCode, $profCode);
	}
	/**
		Copyright 2004 � FullEngine
		
		Crea la static con el perfil	
		@author creyes <cesar.reyes@parquesoft.com>
		@date 26-ago-2004 15:11:07
		@location Cali-Colombia
	*/
	function & __loadProfiles() {
		$profiles = & ASAP :: getStaticProperty('Application', 'profiles');
		if (!isset ($profiles)) {
			//Carga desde prfofiles el perfil
			$rcUser = Application :: getUserParam();
			$profiles = & Application :: __getProfile($rcUser["app_code"], $rcUser["prof_code"]);
		}
		if (!is_array($profiles)) {
			return null;
		}
		return $profiles;
	}
	function getCharset() {
		return Application :: __getVar('charset');
	}
	function getTimezone() {
		return Application :: __getVar('timezone');
	}
}
?>