<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePrPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FePrPgsqlSqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
    /**
    * Copyright 2005 FullEngine
    *
    * Genera un sql generico 
    * @author creyes
    * @param string $table
    * @return string
    * @date 29-August-2005 14:0:51
    * @location Cali-Colombia
    */
    function getGenericSql($table, $viewfields='*'){
        
        settype($rcTmp,"array");
        settype($rcTables,"array");
        settype($rcFields,"array");
        settype($sbValue,"string");
        settype($sbPos,"string");
        
        if($table){
        	$rcTmp = explode(",",$table);
			foreach ($rcTmp as $sbValue) {
				//analiza si es tabla.campo
				$sbPos = strpos($sbValue, ".");
				if (!($sbPos === false)) {
					$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
				} else {
					$sbValue = '"'.$sbValue.'"';
				}
				$rcTables[] = $sbValue; 
			}
			$table = implode(",",$rcTables);
        }else{
        	return null;
        }
            
       
       if ($fields_view !='*'){
			$rcTmp = explode(",",$fields_view);
			foreach ($rcTmp as $sbValue) {
				//analiza si es tabla.campo
				$sbPos = strpos($sbValue, ".");
				if (!($sbPos === false)) {
					$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
				} else {
					$sbValue = '"'.$sbValue.'"';
				}
				$rcFields[] = $sbValue; 
			}
			$fields_view = implode(",",$rcFields);
		}
		return $sbsql = "SELECT $viewfields FROM $table";
        
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Inserta los filtros en un sql
    * @author creyes
    * @param string $sql
    * @param array $rcFilter
    * @return string
    * @date 29-August-2005 14:0:51
    * @location Cali-Colombia
    */
    function setFilterSql($sql, $rcFilter=null){
    	
    	settype($sbPos,"string");
    	
        if(!$sql)
            return null;
        if(!is_array($rcFilter) || !$rcFilter)
            return $sql;
            
        foreach($rcFilter as $field => $value){
        	//-----------------------
        	//analiza si es tabla.campo
			$sbPos = strpos($field, ".");
			if (!($sbPos === false)) {
				$field = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $field);
			} else {
				$field = '"'.$field.'"';
			}
        	//---------------------------
            $rcTmp[] = "$field='$value'";
        }
        if(stripos($sql,'WHERE')===false)
            $sbWere = " WHERE ".implode(" AND ",$rcTmp);
        else $sbWere = " AND ".implode(" AND ",$rcTmp);
		return "$sql $sbWere";
    }    
    /**
    * @copyright Copyright 2004 &copy; FullEngine
	*
	*  Contiene los SQL de las listas despleglables
	* @param string $id Identificador del sql
	* @return string SQL
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 01-oct-2004 16:20:03
	* @location Cali-Colombia
	*/
	function getSqlConsult($id){
    settype($sbAdminApp,"string");
		switch($id){
			case "commands";
				$sql = 'SELECT ' .
							'"commands"."commnombres",' .
							'"commands"."applcodigos",' .
							'"applications"."applnombres" ' .
						'FROM "commands","applications" ' .
						'WHERE ' .
							'"commands"."applcodigos"="applications"."applcodigos"';
			break;
			case "style":
				$sql = 'SELECT ' .
							'"style"."stylcodigos",' .
							'"style"."stylnombres",' .
							'"style"."applcodigos",' .
							'"applications"."applnombres" ' .
						'FROM "style","applications" ' .
						'WHERE ' .
							'"style"."applcodigos"="applications"."applcodigos"';
			break;
			case "auth":
				$sql = 'SELECT ' .
							'"auth"."authusernams",' .
							'"auth"."authrealname",' .
							'"auth"."authrealape1",' .
							'"auth"."authrealape2" ' .
						'FROM "auth"';
			break;
			case "profiles":
                  $sbAdminApp = Application :: getConstant("PROFILES_APP");
				$sql = 'SELECT ' .
							'"profiles"."profcodigos",' .
							'"profiles"."profnombres",' .
							'"profiles"."applcodigos",' .
							'"applications"."applnombres",' .
                            '"profiles"."profdescrips" ' .
						'FROM "profiles","applications" ' .
						'WHERE ' .
							' "profiles"."applcodigos"<> \''.$sbAdminApp.'\'  AND "profiles"."applcodigos"="applications"."applcodigos"';
			break;
			case "schema":
                //No permite consultar el esquema del profiles
                $schemaProfile = Application::getConstant('SCHEMA_PROFILE');
				$sql = 'SELECT ' .
							'"schema"."schecodigon",' .
							'"schema"."schenombres",' .
							'"schema"."scheobservas" ' .
						'FROM "schema" '.
                        'WHERE '.
                            '"schecodigon" != \''.$schemaProfile.'\'';
			break;
			case "application":
                //No permite consultar el esquema del profiles
                $sbAdminApp = Application::getConstant('PROFILES_APP');
				$sql = 'SELECT * FROM "applications" '.
                        'WHERE '.
                            '"applcodigos" != \''.$sbAdminApp.'\'';
			break;
			default: $sql = null;
		}	
		return $sql;
	}
    /**
    * Copyright 2005 FullEngine
    *
    * Adiciona un usuario desde wsb service
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 11-August-2005 16:54:2
    * @location Cali-Colombia
    */
    function addAuth2Ws($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$applcodigos,$stylcodigos,$langcodigos,$profcodigos){
        $this->rcSql[] = 'INSERT INTO "auth" 
                    ("authusernams",
                    "authuserpasss",
                    "authrealname",
                    "authrealape1",
                    "authrealape2",
                    "applcodigos",
                    "stylcodigos",
                    "langcodigos",
                    "profcodigos") 
                VALUES (
                    \''.$authusernams.'\',
                    \''.$authuserpasss.'\',
                    \''.$authrealname.'\',
                    \''.$authrealape1.'\',
                    \''.$authrealape2.'\',
                    \''.$applcodigos.'\',
                    \''.$stylcodigos.'\',
                    \''.$langcodigos.'\',
                    \''.$profcodigos.'\') ';
    }
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: schema
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addAuthschema($authusernams,$schecodigon){
		$this->rcSql[] = 'INSERT INTO "authschema" ("authusernams","schecodigon") VALUES (\''.$authusernams.'\',\''.$schecodigon.'\')';
	}
	
	function execSql(){
		if(!is_array($this->rcSql))
			$this->consult= false;
		$this->objdb->fncadoexecutetrans($this->rcSql);
		$this->consult = $this->objdb->objresult;
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
    function updateUserPassword($userName, $newPassword)
    {
        $sql='UPDATE "auth" SET "authuserpasss"=\''.$newPassword.'\' WHERE "authusernams"=\''.$userName.'\'';
        $this->objdb->fncadoexecute($sql);
        if(!$this->objdb->objresult)
            $this->consult = false;
        else	
            $this->consult = true;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite el estado de un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newState
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function updateUserState($userName, $newState)
    {
        $sql='UPDATE "auth" SET "authestados"=\''.$newState.'\' WHERE "authusernams"=\''.$userName.'\'';
        $this->objdb->fncadoexecute($sql);
        if(!$this->objdb->objresult)
            $this->consult = false;
        else	
            $this->consult = true;
    }
   
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el prefil de un uausrio
    * @author creyes
    * @param string $userName
    * @param string $newProfile
    * @return type name desc
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function updateUserProfile($userName, $newProfile)
    {
        $sql='UPDATE "auth" SET "profcodigos"=\''.$newProfile.'\' WHERE "authusernams"=\''.$userName.'\'';
        $this->objdb->fncadoexecute($sql);
        if(!$this->objdb->objresult)
            $this->consult = false;
        else	
            $this->consult = true;
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Determina si el usuario existe
    * @author freina<freina@parquesoft.com>
    * @param string $authusernams String con el nombre de usuario
    * @param string $authuserpasss String con el password de usuario
    * @return
    * @date 22-August-2005 15:24:55
    * @location Cali-Colombia
    */
    function existAuth($authusernams,$authuserpasss){
    	$sql = 'SELECT * FROM "auth" WHERE "authusernams"=\''.$authusernams.'\' AND "authuserpasss"=\''.$authuserpasss.'\'';
    	$this->objdb->fncadoexecute($sql);
    	return $this->objdb->fncadorowcont();
  	}
    /**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Contiene y ejecuta SQL
	* @param string $sqlId Identificador del sql
	* @return array $rcParams Vector con los parametros.
	* @author freina <freina@parquesoft.com>
	* @date 05-Nov-2004 13:28
	* @location Cali-Colombia
	*/
	function getAutoReference($sqlId, $rcParams = null) {
		
		settype($sbAdminApp,"string");
		switch ($sqlId) {
			case "profiles" :
				$sql = 'SELECT * FROM "profiles" WHERE "applcodigos"=\''.$rcParams[0].'\'';
                   break;
              case "applications" :
                  $sbAdminApp = Application :: getConstant("PROFILES_APP");
				$sql = 'SELECT * FROM "applications" WHERE "applcodigos" <> \''.$sbAdminApp.'\'';
                   break;
			default :
				return null;
		}
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
    /**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combos
	* @param string $sqlId Cadena con el id del sql
    * @param array $ircParams Arreglo con los parametros para el filtrado de la consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 28-Dec-2005 10:00
	* @location Cali-Colombia
	*/
	function getDataCombo($sqlId, $ircParams=null) {
    
        settype($rcUser, "array");
		settype($sbAdminApp,"string");
		settype($sbActive, "string");
		
		switch ($sqlId) {
			case "applications" :
                $sbAdminApp = Application :: getConstant("PROFILES_APP");
				$sql = 'SELECT * FROM "applications" WHERE "applcodigos" <> \''.$sbAdminApp.'\'';
            break;
			case "schema":
                //No permite consultar el esquema del profiles
				$sbActive = Application::getConstant("REG_ACTIVE");
				$profileSchema = Application :: getConstant("SCHEMA_PROFILE");
				$sql='SELECT * FROM "schema" WHERE "schecodigon" != \''.$profileSchema.'\' AND "scheestados"=\''.$sbActive.'\'';
			break;
			case "sessionschema":
                //No permite consultar el esquema del profiles
				$sbActive = Application::getConstant("REG_ACTIVE");
				$rcUser = Application::getUserParam();
				$sql='SELECT * FROM "schema" WHERE "schecodigon" = \''.$rcUser['schecodigon'].'\' AND "scheestados"=\''.$sbActive.'\'';
			break;
			case "schemasusuario":
                //No permite consultar el esquema del profiles
				$sbActive = Application::getConstant("REG_ACTIVE");
				$rcUser = Application::getUserParam();
				$sql='SELECT "schema".* FROM "schema","authschema" 
					WHERE "schema"."schecodigon" = "authschema"."schecodigon" 
					AND "authschema"."authusernams" = \''.$rcUser["username"].'\' 
					AND "scheestados"=\''.$sbActive.'\'';
			break;
			case "userschema" :
	            $sql = 'SELECT "auth".* FROM "auth","authschema"';
	            $sql .= ' WHERE "auth"."authusernams"!=\''.$ircParams['user'][0].'\' AND "auth"."authusernams"="authschema"."authusernams"';
	            $sql .= ' AND "authschema"."schecodigon"=\''.$ircParams['schecodigon'][0].'\' ORDER BY 1';
	        break;
            
		}
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
    * Copyright 2005 FullEngine
    *
    * Determina cuantos usuarios existen con el esquema pasado como parametro
    * @author freina<freina@parquesoft.com>
    * @param integer $nuSchecodigon entero con el id del esquema
    * @return integer
    * @date 22-Mar-2006 12:06
    * @location Cali-Colombia
    */
	function amountAuthBySchecodigon($nuSchecodigon){
		$sql = 'SELECT * FROM "authschema" WHERE "schecodigon"=\''.$nuSchecodigon.'\'';
    	$this->objdb->fncadoexecute($sql);
    	return $this->objdb->fncadorowcont();
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Actualiza el estilo y lenguaje de un usuario
    * @author freina<freina@parquesoft.com>
    * @param string $userName Cadena con el nick del usuario
    * @param string $stylcodigos Cadena con el estilo
    * @param string $langcodigos Cadena con el lenguaje
    * @return true or false
    * @date 26-Apr-2006 14:36:00
    * @location Cali-Colombia
    */
    function updateUserEnvironment($userName, $stylcodigos, $langcodigos){
        $sql='UPDATE "auth" SET "stylcodigos"=\''.$stylcodigos.'\', "langcodigos"=\''
        .$langcodigos.'\' WHERE "authusernams"=\''.$userName.'\'';
        $this->objdb->fncadoexecute($sql);
        if(!$this->objdb->objresult)
            $this->consult = false;
        else	
            $this->consult = true;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Permite cambiar el password de un usuario
    * @author freina<freina@parquesoft.com>
    * @param string $sbAuthusernams Cadena con el nick del usuario
    * @param string $sbAuthuserpass Cadena con el nuevo password
    * @return true or false
    * @date 26-Apr-2006 14:36:00
    * @location Cali-Colombia
    */
    function updateAuthPassword($sbAuthusernams, $sbAuthuserpass){
        $sql='UPDATE "auth" SET "authuserpasss"=\''.$sbAuthuserpass.'\' WHERE "authusernams"=\''.$sbAuthusernams.'\'';
        $this->objdb->fncadoexecute($sql);
        if(!$this->objdb->objresult)
            $this->consult = false;
        else	
            $this->consult = true;
    }
}
?>