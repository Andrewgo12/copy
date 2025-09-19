<?php 
/**
*   Propiedad intelectual del FullEngine.
*	
*	Compuertas extendidas
*	@param array  
*	@author creyes
*	@date 02-ago-20049:15:54
*	@location Cali-Colombia
*/
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePrPgsqlExtend {
	var $connection;
	var $consult;
	var $objdb;
	function FePrPgsqlExtend() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Trae los datos del usuario para el login
	*	@param array  
	*	@author creyes
	*	@date 02-ago-20049:15:54
	*	@location Cali-Colombia
	*/
	function GetDataUser($authusernams){
		$sql = 'SELECT DISTINCT
					"auth"."profcodigos",
					"auth"."applcodigos",
					"auth"."langcodigos",
					"applications"."applnombres",
					"applications"."applcodigos",
					"style"."stylnombres",
                "auth"."authestados"
				FROM 
					"auth","applications","style"
				WHERE 
					"auth"."authusernams"=\''.$authusernams.'\' AND
					"auth"."applcodigos"="applications"."applcodigos" AND
					"auth"."applcodigos"="style"."applcodigos" AND
					"auth"."stylcodigos"="style"."stylcodigos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @Copyright 2004  FullEngine
	*
	* Consulta los esquemas del usuario
	* @param $username
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 08-Abr-2006
	* @location Cali - Colombia
	*/
	function getUserSchecodigon($authusernams){
		$regActive = Application::getConstant('REG_ACTIVE');
		$sql = 'SELECT 
					"authschema"."schecodigon"
				FROM 
					"authschema","schema"
				WHERE 
					"authschema"."authusernams"=\''.$authusernams.'\' AND
					"authschema"."schecodigon" = "schema"."schecodigon" AND 
					"schema"."scheestados" = \''.$regActive.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @Copyright 2004  FullEngine
	*
	* Consulta los esquemas del usuario
	* @param $username
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 08-Abr-2006
	* @location Cali - Colombia
	*/
	function getUserSchemas($authusernams){
		$regActive = Application::getConstant('REG_ACTIVE');
		$sql = 'SELECT 
					"authschema"."schecodigon", 
					"schema"."schenombres",
					"schema"."scheobservas"
				FROM 
					"authschema","schema"
				WHERE 
					"authschema"."authusernams"=\''.$authusernams.'\' AND
					"authschema"."schecodigon"="schema"."schecodigon" AND
					"schema"."scheestados" = \''.$regActive.'\'		
					ORDER BY "schema"."schenombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}


	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Arma y ejecuta los sql para el ingreso de los nuevos comandos a la DB
	*	@param array  
	*	@author creyes
	*	@date 10-ago-2004 15:49:31
	*	@location Cali-Colombia
	*/
	function actCommands($rcCommands,$AppCode){
		if(!is_array($rcCommands))
			return null;
		foreach($rcCommands as $key => $command){
			$rcSql[$key] = 'INSERT INTO "commands" ("commnombres","applcodigos")'
			.' VALUES(\''.$command.'\',\''.$AppCode.'\')';
		}
		$this->objdb->fncadoexecutercsql($rcSql);
		return $this->objdb->rcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Ejecuta sql a la DB en un transaccion
	*	@param array  
	*	@author creyes
	*	@date 20-ago-2004 13:12:58
	*	@location Cali-Colombia
	*/
	function exeRcSql($rcSql)
	{
		$this->objdb->fncadoexecutetrans($rcSql);
		return $this->objdb->objresult; 
	}
    
	function getAllAuthByApp($applcodigos,$schecodigon) {
		$sql = 'SELECT "auth.authusernams" FROM "auth","authschema" WHERE "auth.authusernams"="authschema.authusernams" AND "applcodigos"=\''.$applcodigos.'\' AND "schecodigon"='.$schecodigon;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Trae los nombres de usuario activos
	*	@param $profcodigos  
	*	@author creyes
	*	@date 20-ago-2004 13:12:58
	*	@location Cali-Colombia
	*/
	function getActiveAuthByApp($applcodigos,$schecodigon) {
        $regActive = Application::getConstant('REG_ACTIVE');
		$sql = 'SELECT ' .
						'"auth"."authusernams" ' .
					'FROM "auth","authschema" ' .
					'WHERE ' .
						'"authschema"."schecodigon"=\''.$schecodigon.'\' AND ' .
						'"authschema"."authusernams"="auth"."authusernams" AND ' .
						'"auth"."applcodigos"=\''.$applcodigos.'\' AND ' .
						'"auth"."authestados"=\''.$regActive.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Elimina los permisos de un perfil en una aplicacion
	*	@param $profcodigos  
	*	@author creyes
	*	@date 20-ago-2004 13:12:58
	*	@location Cali-Colombia
	*/
	function deletePermisions($profcodigos, $applcodigos) {
		$sql = 'DELETE FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*   Consulta los usuarios de un perfil y enu aplicacion
	*   @param string $applcodigos
	*	@param string $profcodigos  
	*	@author creyes
	*	@date 20-ago-2004 13:12:58
	*	@location Cali-Colombia
	*/
	function getAuthByApplProf($profcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "auth" WHERE "applcodigos"=\''.$applcodigos.'\' AND "profcodigos"=\''.$profcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>