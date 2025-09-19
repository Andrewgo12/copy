<?php  
class FeGeDatabasesManager {
	

	function FeGeDatabasesManager() {
        return true;
	}
    
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el backup de la base de datos
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 22-jul-2005 15:01:30
	* @location Cali-Colombia
	*/
    function getBackup(){
    	
    	settype($objDate, "object");
        
        $config = & ASAP :: getStaticProperty('Application', 'config');
   		$params = Application :: getDomainController("ParamsManager");
		$program = $params->getParam("general","dump_program");
		$objDate = Application :: loadServices("DateController");
        $rctoday = $objDate->_getDate();
        $outputFile = "CROSS".$rctoday["year"].$rctoday["mon"].$rctoday["mday"].$rctoday["hours"].$rctoday["minutes"].$rctoday["seconds"];

        $rcUser = Application::getUserParam();
        if(!is_array($rcUser))
            $rcUser['schema'] = 1;

        //Si no es el esquema de profiles
        if($rcUser['schema'] == 1)
	        $schenombres = 'profiles';
	    else
	    	$schenombres = $rcUser['schema_prefix'].$rcUser['schema'];
            
        //Carga los datos de conexion (usuario, clave) desde los 
        //serializados del esquema
		/*
		$file_name = Application::getBaseDirectory().'/../profiles/config/schema.data';
        $rcSchema = Serializer :: load($file_name);
        $rcSchema = $rcSchema[$rcUser['schema']];
        */

        //Inicia la fabrica
        include($config["database"]["driver"]."Export.php");
        $bck = new backup();
        $bck->setUser($config["database"]["user"],$config["database"]["password"]);
        $bck->setDatabase($config["database"]["name"]);
        $bck->setHostname($config["database"]["host"]);
        $bck->setPort($config["database"]["port"]);
        $bck->setProgram($program);
        $bck->settableSpace($schenombres);
        $bck->setOutput("tar", $outputFile);
        $bck->exec();
        return 3;
    }
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Ejecuta el mantenimiento de la base de datos
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 22-jul-2005 15:01:30
	* @location Cali-Colombia
	*/
    function maintenance(){
        $config = & ASAP :: getStaticProperty('Application', 'config');
        include($config["database"]["driver"]."Maintenance.php");
        $maintenance = new maintenance();
        $maintenance->execute();
        return 3;  
    }
    
}
?>