<?php      
/**
*   Propiedad intelectual del FullEngine.
*	
*	Manejador del ligin de usuario
*	@param array  
*	@author creyes
*	@date 02-ago-20049:15:54
*	@location Cali-Colombia
*/
class FePrLoginManager {
	var $gateway;
	function FePrLoginManager() {
		$this->gateway = Application :: getDataGateway("Extend");
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Hace la autenticaci�n del usuario
	* @param $username 
	* @param $password
	* @return boolean  
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-dic-2004 15:18:12
	* @location Cali - Colombia
	*/
	function getAuth($username, $password) {
		
		settype($sbMethodName,"string");
		
		//El usuario no tiene login
		$webUser = Application::getConstant('WEB_USER');
		if($username == $webUser)
			return false;
			
		$sbStorage = Application :: getStorage();
		$rcdsn = Application :: getDsn();
		
		$sbMethodName = "AUTH_".$sbStorage;
		$_auth = $this->$sbMethodName($username, $password, $rcdsn);
		
		//Si la Autenticacion exitosa
		if ($_auth === true) {
			return true;
		}
		return false;
	}
	
	/**
	* @Copyright 2004  FullEngine
	*
	* Hace la autenticacion del usuario contra la base de datos
	* @param $isbUsername String con el nombre del usuario 
	* @param $isbPassword String con el password del usuario
	* @return boolean true o false
	* @author freina<freina@parquesoft.com>
	* @date 18-Nov-2005 17:06
	* @location Cali - Colombia
	*/
	function AUTH_DB($isbUsername, $isbPassword, $ircDsn=null){
		
		settype($objGateway,"object");
		settype($nuResult,"integer");
		
		$objGateway = Application :: getDataGateway("SqlExtended");
		
		$nuResult = $objGateway->existAuth($isbUsername,$isbPassword);
		if($nuResult){
			return true;
		}
		return false;
	}
	
	/**
	* @Copyright 2004 � FullEngine
	*
	* Consulta los datos del usuario para poner en la sesion
	* @param $username
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-dic-2004 15:31:27
	* @location Cali - Colombia
	*/
	function getSessionDataUser($username) {
		if (!$username)
			return null; //msg_error 2
		$rcuserdata = $this->gateway->GetDataUser($username);
		$rcuserdata = $rcuserdata[0];
		
		$_authsession["application"] = $rcuserdata["applnombres"];
		$_authsession["style"] = $rcuserdata["stylnombres"];
		$_authsession["lang"] = $rcuserdata["langcodigos"];
		$_authsession["app_code"] = $rcuserdata["applcodigos"];
		$_authsession["prof_code"] = $rcuserdata["profcodigos"];
		$_authsession["username"] = $username;
		$_authsession["estate"] = $rcuserdata["authestados"];
		$_authsession["estate"] = $rcuserdata["authestados"];
		$_authsession["schema_prefix"] = Application::getConstant('SUFIJO_SCHEMA');
		
		//Consulta los esquemas del usuario
		$rcSchemas = $this->getUserSchecodigon($username);
		if(!is_array($rcSchemas))
			return 17;
		$nuSchemas = sizeof($rcSchemas);
		if($nuSchemas == 1){
			$_authsession["schema"] = $rcSchemas[0]["schecodigon"];
			$_authsession["schecodigon"] = $rcSchemas[0]["schecodigon"];
		}else if ($nuSchemas > 1){
			$_authsession["schema"] = $rcSchemas;
			$_authsession["schecodigon"] = $rcSchemas;
		}else{
			//Esquema del profiles
			$_authsession["schema"] = 1;
			$_authsession["schecodigon"] = 1;
		}
		return $_authsession;
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
	function getUserSchecodigon($username){
		$rcSchemas = $this->gateway->getUserSchecodigon($username);
		return $rcSchemas; 
	}
}
?>