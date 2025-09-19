<?php    
/**Copyright 2004 � FullEngine
	
	 Servicio del m�dulo de human resources
	@author creyes <cesar.reyes@parquesoft.com>
	@date 02-sep-2004 12:06:21
	@location Cali - Colombia*/

class Human_resources {
	var $appName;
	var $appDir;

	function Human_resources() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicaci�n
		$dir_name = dirname(__FILE__)."/../../../applications/human_resources";
		$name = "human_resources";
		$objTmp = new Application($name, $dir_name, true);
	}
	/**
		Copyright 2004 � FullEngine
		
		Muestra toda la informaci�n del servicio
		@author creyes <cesar.reyes@parquesoft.com>
		@date 02-sep-2004 12:06:21
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array ("getEntesOrg" => "Copyright 2004 � FullEngine<br>
																							 Obtiene los entes organizaciones en los cuales el usuario es responsable<br> 
																							@param string \$perscodigos C�digo de personal<br>
																							@param bool \$backControl Indica al m�todo si tiene que regresar o no el control al aplication<br>
																							@return array datos de los entes organizacionales<br>
																							@author creyes <cesar.reyes@parquesoft.com><br>
																							@date 27-ago-2004 11:26:15<br>
																							@location Cali - Colombia", "getPersDatos" => "Copyright 2004 � FullEngine<br>
																							Obtiene el codigo de personal a partir del nombre de usuario<br>
																							@param string \$userName Nombre del usuario desde PROFILES<br>
																							@param bool \$backControl Indica al m�todo si tiene que regresar o no el control al aplication<br>
																							@return array Datos del personal o NULL si no existe<br>
																							@author creyes <cesar.reyes@parquesoft.com><br>
																							@date 27-ago-2004 11:06:54<br>
																							@location Cali-Colombia", "getEntesSon" => "	Copyright 2004 � FullEngine<br>
																							 Busca todos los entes a cargo de un personal y los entes hijos<br>
																							@param string \$perscodigos C�digo del personal<br>
																							@return array <br>
																							@author creyes <cesar.reyes@parquesoft.com><br>
																							@date 02-sep-2004 12:39:29<br>
																							@location Cali - Colombia", "getDataEntesOrg" => "@copyright Copyright 2004 &copy FullEngine	
																							Obtiene los datos de un ente organizacional (generico)
																							@param string $isborgacodigos (Cadena con el codigo del ente organizacional)
																							@param boolean $ibflag (true se cierra el servicio, false se deja abierto)
																							@return array $orcresult (arreglo con el nombre y email del ente)
																							[nombre] Nombre del ente
																							[email] e-mail
																							@author freina <freina@parquesoft.com>
																							@date 07-Oct-2004 14:38
																							@location Cali-Colombia", "getDataEmployeeByNick" => "Copyright 2004 � FullEngine
										  																	  Obtiene el email del empleado y el ente a el cual pertenece a travez de su nick
																											  @param string $isbpersusrnams (Cadena con el nombre del usuario desde profiles)
																											  @param boolean blflag (boolean, indica si se cierra el servicio)
																											  @return array $orcresult (Arreglo con el email del empleado y el codigo del ente a el cual pertenece)
																											  @author freina <freina@parquesoft.com>
																											  @date 19-Oct-2004 15:26
																											 @location Cali-Colombia", "getActiveEntesOrg" => "@copyright Copyright 2004 &copy; FullEngine
																						 Obtiene los entes organizacionales activos
																						 @return array
																						 @author creyes <cesar.reyes@parquesoft.com>
																						 @date 25-oct-2004 11:56:54
																						 @location Cali-Colombia", "getActiveBeingSonEmployee" => "Copyright 2004 FullEngine
																													Busca todos los entes activos a cargo de un personal y los entes hijos
																													@param string $isbperscodigos Codigo del personal
																													@return array
																													@author freina <freina@parquesoft.com>
																													@date 05-Nov-2004 14:10
																													@location Cali - Colombia", "getActiveBeingEmployee" => "Copyright 2004  FullEngine
																											Obtiene los entes organizaciones activos en los cuales el usuario es responsable
																											@param string $isbperscodigos Codigo de personal
																											@param bool $backControl Indica al metodo si tiene que regresar o no el control al aplication
																											@return array datos de los entes organizacionales
																											@author freina <freina@parquesoft.com>
																											@date 05-nov-2004 14:15
																											@location Cali - Colombia", "getActiveEmployee" => "@copyright Copyright 2004 &copy FullEngine
																									Trae todos el personal activo
																									@return array
																									@author freina freina@parquesoft.com>
																									@date 06-Nov-2004 13:40
																									@location Cali-Colombia", "getActiveGroup" => '@copyright Copyright 2004 &copy; FullEngine
																					 Trae el grupo activo en un ente organizacional
																					 @param string \$isborgacodigos" .
																					 "@param boolean $isbflag determina si se cierra o no el servicio
																					 @return array
																					 @author creyes <cesar.reyes@parquesoft.com>
																					 @date 10-nov-2004 14:39:11
																					 @location Cali-Colombia', "getpersonalByOrganizacion" => "@copyright Copyright 2004 &copy; FullEngine
																					 Busca todo el personal de un ente organizacional y tambien de sus entes hijos
																					 @param string \$orgacodigos 
																					 @return array
																					 @author creyes <cesar.reyes@parquesoft.com>
																					 @date 29-nov-2004 13:30:52
																					 @location Cali-Colombia",
		'getActiveBeingsTransfer'=>'Copyright 2004 FullEngine' .
														'Busca todos los entes activos a los cuales puedo transferiri una tarea(este metodo puede cambiar de acuerdo a a la implementacion)' .
														'@param string $isbPerscodigos Codigo del personal' .
														'@return $orcResult arreglo con la data de los entes' .
														'@author freina <freina@parquesoft.com>' .
														'@date 29-Jun-2005 11:51' .
														'@location Cali - Colombia',
		'getGateWay'=>'Copyright 2004 FullEngine' .
														'Busca todos los entes activos a los cuales puedo transferiri una tarea(este metodo puede cambiar de acuerdo a a la implementacion)' .
														'@param string $isbPerscodigos Codigo del personal' .
														'@return $orcResult arreglo con la data de los entes' .
														'@author freina <freina@parquesoft.com>' .
														'@date 29-Jun-2005 11:51' .
														'@location Cali - Colombia',
														
		'getOrganizacionActiveByOrgacodigos'=>'@copyright Copyright 2005 &copy FullEngine' .
																'Obtiene los datos de un ente organizacional activo (generico)' .
																'@param string $isbOrgacodigos (Cadena con el codigo del ente organizacional)' .
																' @param boolean $isbFlag (true se cierra el servicio, false se deja abierto)' .
																'@return array $orcResult (arreglo con el id y el nombre del ente)' .
																'@author freina <freina@parquesoft.com>' .
																'@date 08-Jul-2005 10:00' .
																'@location Cali-Colombia',
		'getOrderedByGrupo'=>'@copyright Copyright 2004 &copy; FullEngine' .
				'Obtiene el responsable del grupo' .
				'@param integer $nuGrupcodigon' .
				'@param boolean $sbFlag Determina si se debe cerrar o no el servicio'.
				'@return string con el nombre completo del responsable del grupo' .
				'@author freina<freina@parquesoft.com>' .
				'@date 08-Apr-2006 16:30' .
				'@location Cali-Colombia',
		"getByIdEntesOrg"=>'@copyright Copyright 2012 &copy FullEngine
		Obtiene los datos de un ente organizacional (generico)
		@param string $isborgacodigos (Cadena con el codigo del ente organizacional)
		@param boolean $ibflag (true se cierra el servicio, false se deja abierto)
		@return array $orcresult (arreglo con el nombre y email del ente)
		@author freina <freina@parquesoft.com>
		@date 14-Mar-2012 16:43
		@location Cali-Colombia',
		"existOrganizacion"=>'@copyright Copyright 2016 &copy FullEngine	
	Determina si un ente organizacional existe y esta activo
	@param string $sbOrgacodigos (Cadena con el codigo del ente organizacional)
	@param boolean $sbFlag (true se cierra el servicio, false se deja abierto)
	@return array $sbResult true existe y esta activa, false no existe o esta inactiva
	@author freina <freina@fullengine.com>
	@date 14-Oct-2016 10:43
	@location Cali-Colombia');

		echo "<table border=1>";
		foreach ($rcinfo as $key => $data)
			echo "<tr><td>$key</td><td><pre>$data</pre></td></td>";
		echo "</table>";
	}
	/**
		Copyright 2004 � FullEngine
		
		Regresa a la aplicaci�n su configuracion
		@author creyes <cesar.reyes@parquesoft.com>
		@date 02-sep-2004 12:06:21
		@location Cali-Colombia
		@note NOTA: Este m�todo debe ser ejecutado una vez termine la ejecucion de esta clase
	*/
	function close() {
		$objTmp = new Application($this->appName, $this->appDir, true);
	}
	/**
	Copyright 2004 � FullEngine
	
	Busca todos los entes a cargo de un personal y los entes hijos
	@param string $perscodigos C�digo del personal
	@return array 
	@author creyes <cesar.reyes@parquesoft.com>
	@date 02-sep-2004 12:39:29
	@location Cali - Colombia
	*/
	function getEntesSon($perscodigos) {
		//Obtiene los entes a cargo del personal
		$rcEntes = $this->getEntesOrg($perscodigos, true);
		if (!is_array($rcEntes)) {
			$this->close();
			return null;
		}
		//Instancia la clase de recorrido de arboles
		$arbolManager = Application :: getDomainController('ArbolManager');
		$arbolManager->fncArbolManager("organizacion");
		//Busca ciclicamente todos lo hijos de los entes
		foreach ($rcEntes as $nuKey => $rcValue) {
			$rcArbol[$nuKey] = $arbolManager->getArbol("orgacgpads", "orgacodigos", $rcValue["orgacodigos"]);
		}
		$rcReturn = $this->setLista($rcArbol);
		$this->close();
		return $rcReturn;
	}
	/**
	*Copyright 2004 FullEngine
	*
	* Busca todos los entes activos a cargo de un personal y los entes hijos
	* @param string $isbperscodigos Codigo del personal
	* @return array 
	* @author freina <freina@parquesoft.com>
	* @date 05-Nov-2004 14:10
	* @location Cali - Colombia
	*/
	function getActiveBeingSonEmployee($isbperscodigos) {

		settype($objOrganizacion, "object");
		settype($rcEntes, "array");
		settype($rcArbol, "array");
		settype($orcReturn, "array");
		settype($rcResult, "array");
		settype($rcValue, "array");
		settype($rcTmp, "array");
		settype($rcTmpFather, "array");
		settype($nuKey, "integer");

		//Obtiene los entes activos a cargo del personal
		$rcEntes = $this->getActiveBeingEmployee($isbperscodigos, true);
		if (!is_array($rcEntes)) {
			$this->close();
			return null;
		}
		//Instancia la clase de recorrido de arboles
		$objOrganizacion = Application :: getDomainController('OrganizacionManager');
		//Busca ciclicamente todos lo hijos de los entes
		foreach ($rcEntes as $nuKey => $rcValue) {
			$rcTmpFather[0] = $rcValue;
			$rcTmp = $objOrganizacion->fncinicio($rcValue["orgacodigos"]);
			if($rcTmp){
				$rcTmp = array_reverse($rcTmp,true);
				$rcResult = array_merge($rcTmpFather, $rcTmp);	
			}else{
				$rcResult = $rcTmpFather;
			}
			$rcArbol = array_merge($rcArbol, $rcResult);
		}

		if ($rcArbol) {
			foreach ($rcArbol as $rcValue) {
				$orcReturn[$rcValue["orgacodigos"]] = $rcValue["organombres"];
			}
		}

		$this->close();
		return $orcReturn;
	}
	/**	
	*	Copyright 2004  FullEngine
	*	
	*	 Obtiene los entes organizaciones activos en los cuales el usuario es responsable 
	*	@param string $isbperscodigos Codigo de personal
	*	@param bool $backControl Indica al metodo si tiene que regresar o no el control al aplication
	*	@return array datos de los entes organizacionales
	*	@author freina <freina@parquesoft.com>
	*	@date 05-nov-2004 14:15
	*	@location Cali - Colombia
	*/
	function getActiveBeingEmployee($isbperscodigos, $backControl = false) {
		$OrganizacionManager = Application :: getDomainController('OrganizacionManager');
		$rcResult = $OrganizacionManager->getActiveByOrganizacion_fkey2($isbperscodigos);
		if ($backControl == false)
			$this->close();
		return $rcResult;
	}
	/**Copyright 2004 � FullEngine
	
	 Crea el vector para pintar la lista desplegable con los entes organizaciones
	@param array $rcEntes Vector con los padres
	@return array
	@author creyes <cesar.reyes@parquesoft.com>
	@date 31-ago-2004 13:17:29
	@location Cali - Colombia
	*/
	function setLista($rcEntes) {
		foreach ($rcEntes as $rcValues) {
			foreach ($rcValues as $rcHijos) {
				$rcReturn[$rcHijos["orgacodigos"]] = $rcHijos["organombres"];
			}
		}
		return $rcReturn;
	}
	/**	
		Copyright 2004 � FullEngine
		
		Obtiene los entes organizaciones en los cuales el usuario es responsable 
		@param string $perscodigos C�digo de personal
		@param bool $backControl Indica al m�todo si tiene que regresar o no el control al aplication
		@return array datos de los entes organizacionales
		@author creyes <cesar.reyes@parquesoft.com>
		@date 27-ago-2004 11:26:15
		@location Cali - Colombia
	*/
	function getEntesOrg($perscodigos, $backControl = false) {
		$OrganizacionManager = Application :: getDomainController('OrganizacionManager');
		$rcResult = $OrganizacionManager->getByOrganizacion_fkey2($perscodigos);
		if ($backControl == false)
			$this->close();
		return $rcResult;
	}
	/**
		Copyright 2004 � FullEngine
		
		Obtiene el codigo de personal a partir del nombre de usuario
		@param string $userName Nombre del usuario desde PROFILES
		@return array Datos del personal o NULL si no existe
		@author creyes <cesar.reyes@parquesoft.com>
		@date 27-ago-2004 11:06:54
		@location Cali-Colombia
	*/
	function getPersDatos($userName, $backControl = false) {
		$PersonalManager = Application :: getDomainController('PersonalManagerExtended');
		$rcPerson = $PersonalManager->getByPersusrnams($userName);
		if ($backControl == false)
			$this->close();
		return $rcPerson[0];
	}
	/**
	@copyright Copyright 2004 &copy FullEngine
	
	Trae todos los entes organizacionales
	@return array
	@author creyes <cesar.reyes@parquesoft.com>
	@date 13-sep-2004 13:11:45
	@location Cali-Colombia
	*/
	function getAllEntesOrg() {
		$OrganizacionGateway = Application :: getDataGateway("organizacion");
		$rcreturn = $OrganizacionGateway->getAllOrganizacion();
		$this->close();
		return $rcreturn;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene los entes organizacionales activos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 25-oct-2004 11:56:54
	* @location Cali-Colombia
	*/
	function getActiveEntesOrg() {
		$OrganizacionGateway = Application :: getDataGateway("SqlExtended");
		$rcreturn = $OrganizacionGateway->getActiveEntesOrg();
		$this->close();
		return $rcreturn;
	}
	/**
	@copyright Copyright 2004 &copy FullEngine
	
	Obtiene los datos de un ente organizacional (generico)
	@param string $isborgacodigos (Cadena con el codigo del ente organizacional)
	@param boolean $ibflag (true se cierra el servicio, false se deja abierto)
	@return array $orcresult (arreglo con el nombre y email del ente)
	@author freina <freina@parquesoft.com>
	@date 07-Oct-2004 14:38
	@location Cali-Colombia
	*/
	function getDataEntesOrg($isborgacodigos, $ibflag = false) {
		settype($objgatewayorg, "object");
		settype($rctmp, "array");
		settype($orcresult, "array");
		$objgatewayorg = Application :: getDataGateway("organizacion");
		$rctmp = $objgatewayorg->getByIdOrganizacion($isborgacodigos);
		if ($ibflag) {
			$this->close();
		}
		if ($rctmp) {
			$orcresult["nombre"] = $rctmp[0]["organombres"];
			$orcresult["email"] = $rctmp[0]["orgaemails"];
		}
		return $orcresult;
	}
	/**
		Copyright 2004 � FullEngine
		
		Obtiene el email del empleado y el ente a el cual pertenece a travez de su nick
		@param string $isbpersusrnams (Cadena con el nombre del usuario desde profiles)
		@param boolean blflag (boolean, indica si se cierra el servicio)
		@return array $orcresult (Arreglo con el email del empleado y el codigo del ente a el cual pertenece)
		@author freina <freina@parquesoft.com>
		@date 19-Oct-2004 15:26
		@location Cali-Colombia
	*/
	function getDataEmployeeByNick($isbpersusrnams, $blflag = true) {

		settype($objtmpp, "object");
		settype($objtmpe, "object");
		settype($objtmpg, "object");
		settype($orcresult, "array");
		settype($rctmpp, "array");
		settype($rctmpe, "array");
		settype($rctmpg, "array");
		settype($sbtmp, "string");
		settype($sbactivo, "string");

		$objtmpp = Application :: getDataGateway('PersonalExtended');
		$rctmpp = $objtmpp->getByPersusrnams($isbpersusrnams);

		if ($rctmpp) {
			//si existe en personal
			$orcresult["emailp"] = $rctmpp[0]["persemails"];

			//se obtiene el grupo de el cual el empleado es el responsable
			$sbtmp = Application :: getConstant("GRUP_RESP");
			$objtmpg = Application :: getDataGateway('SqlExtended');
			$rctmpg = $objtmpg->getAllGroupsByOrderedEmployee($rctmpp[0]["perscodigos"], $sbtmp);

			if ($rctmpg) {
				if (sizeof($rctmpg) == 1) {
					$objtmpe = Application :: getDataGateway('OrganizacionExtended');
					$rctmpe = $objtmpe->getOrganizacionByGrupcodigos($rctmpg[0]["grupcodigos"]);
					if ($rctmpe) {
						if (sizeof($rctmpe) == 1) {
							$orcresult["responsable"] = $rctmpe[0]["orgacodigos"];
							$orcresult["emailr"] = $rctmpe[0]["orgaemails"];
						}
					}
				}
			}
		}
		if ($blflag === true) {
			$this->close();
		}
		return $orcresult;
	}
	/**
	*@copyright Copyright 2004 &copy FullEngine
	*
	* Trae todos el personal activo
	* @return array
	* @author freina freina@parquesoft.com>
	* @date 06-Nov-2004 13:40
	* @location Cali-Colombia
	*/
	function getActiveEmployee() {

		settype($objtmp, "object");
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rcresult, "array");
		settype($nucont, "integer");
		$objtmp = Application :: getDataGateway("SqlExtended");
		$rcresult = $objtmp->getDataCombo("personal");

		if ($rcresult) {
			foreach ($rcresult as $nucont => $rctmp) {
				$orcresult[$nucont]["indice"] = $rctmp["perscodigos"];
				$orcresult[$nucont]["nombre"] = $rctmp["persnombres"]." ".$rctmp["persapell1s"]." ".$rctmp["persapell2s"];
			}
		}

		$this->close();
		return $orcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae el grupo activo en un ente organizacional
	* @param string $isborgacodigos
	* @param boolean $isbflag determina si se cierra o no el servicio
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 14:39:11
	* @location Cali-Colombia
	*/
	function getActiveGroup($isborgacodigos,$isbflag=true) {
		settype($objgatewayorg, "object");
		settype($rctmp, "array");
		settype($orcresult, "array");
		$objgatewayorg = Application :: getDataGateway("SqlExtended");
		$rctmp = $objgatewayorg->getActiveGroup($isborgacodigos);
		
		if($isbflag){
			$this->close();
		}
		
		return $rctmp;
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae los integrantes de un grupo
	* @param string $grupcodigon
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 14:19:36
	* @location Cali-Colombia
	*/
	function getGrupoDetalle($grupcodigon, $flag = true) {
		$gatewayGrupodetalle = Application :: getDataGateway("SqlExtended");
		$rcGrupo = $gatewayGrupodetalle->getGrupodetalle($grupcodigon);
		if ($flag == true)
			$this->close();
		return $rcGrupo;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Busca todo el personal de un ente organizacional y tambien de sus entes hijos
	* @param string $orgacodigos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 29-nov-2004 13:30:52
	* @location Cali-Colombia
	*/
	function getpersonalByOrganizacion($orgacodigos) {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rcPersonal = $gateway->getpersonalByOrganizacion($orgacodigos);
		$this->close();
		return $rcPersonal;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Consulta todo el personal activo
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 11:25:16
	* @location Cali - Colombia
	*/
	function getAllActivePersonal() {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rcPersonal = $gateway->getDataCombo("personal");
		$this->close();
		return $rcPersonal;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Consulta todo el personal activo que tiene usuario en cross
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 11:25:16
	* @location Cali - Colombia
	*/
	function getAllActiveAuthPersonal() {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rcPersonal = $gateway->getDataCombo("auth_personal");
		$this->close();
		return $rcPersonal;
	}
	/**
	*Copyright 2004 FullEngine
	*
	* Busca todos los entes activos a los cuales puedo transferiri una tarea
	* (este metodo puede cambiar de acuerdo a a la implementacion)
	* @param string $isbPerscodigos Codigo del personal
	* @return $orcResult arreglo con la data de los entes 
	* @author freina <freina@parquesoft.com>
	* @date 29-Jun-2005 11:51
	* @location Cali - Colombia
	*/
	function getActiveBeingsTransfer($isbPerscodigos) {

		settype($objOrganizacion, "object");
		settype($rcEntes, "array");
		settype($rcArbol, "array");
		settype($orcReturn, "array");
		settype($rcResult, "array");
		settype($rcValue, "array");
		settype($rcTmp, "array");
		settype($rcTmpFather, "array");
		settype($rcBrother, "array");
		settype($nuKey, "integer");
		
		//Obtiene los entes activos a cargo del personal
		$rcEntes = $this->getActiveBeingEmployee($isbPerscodigos, true);
		if (is_array($rcEntes) && $rcEntes) {
			
			//Instancia la clase de recorrido de arboles
			$objOrganizacion = Application :: getDomainController('OrganizacionManager');
			
			//Obtiene los entes activos que se encuentran a el mismo nivel delos entes a su cargo
			//Busca ciclicamente todos lo hijos de los entes
			foreach ($rcEntes as $nuKey => $rcValue) {
				$rcBrother = $objOrganizacion->getActiveOrganizacionByOrgacgpads($rcValue["orgacodigos"],$rcValue["orgacgpads"]); 
				$rcTmpFather[0] = $rcValue;
				$rcTmp = $objOrganizacion->fncinicio($rcValue["orgacodigos"]);
				if($rcBrother){
					$rcTmpFather = array_merge($rcBrother, $rcTmpFather);
				}
				if($rcTmp){
					$rcTmp = array_reverse($rcTmp,true);
					$rcResult = array_merge($rcTmpFather, $rcTmp);	
				}else{
					$rcResult = $rcTmpFather;
				}
				$rcArbol = array_merge($rcArbol, $rcResult);
			}
			
			if ($rcArbol) {
				foreach ($rcArbol as $rcValue) {
					$orcReturn[$rcValue["orgacodigos"]] = $rcValue["organombres"];
				}
			}
		}

		$this->close();
		return $orcReturn;
	}
	/**
	@copyright Copyright 2005 &copy FullEngine
	*
	* Obtiene los datos de un ente organizacional activo (generico)
	* @param string $isbOrgacodigos (Cadena con el codigo del ente
	* organizacional)
	* @param boolean $isbFlag (true se cierra el servicio, false se deja
	* abierto)
	* @return array $orcResult (arreglo con el id y el nombre del ente)
	* @author freina <freina@parquesoft.com>
	* @date 08-Jul-2005 10:00
	* @location Cali-Colombia
	*/
	function getOrganizacionActiveByOrgacodigos($isbOrgacodigos, $isbFlag = true) {
		
		settype($objManager, "object");
		settype($rcTmp, "array");
		settype($orcResult, "array");
		
		$objManager = Application :: getDomainController('OrganizacionManager');
		$rcTmp = $objManager->getOrganizacionActiveByOrgacodigos($isbOrgacodigos);
		if ($isbFlag) {
			$this->close();
		}
		if ($rcTmp) {
			$orcResult[0][0] = $rcTmp[0]["organombres"];
		}
		return $orcResult;
	}
    /**
    * Copyright 2005 FullEngine
    *
    * Trae los datos del personal
    * @author creyes
    * @param string $perscodigos 
    * @return array
    * @date 11-August-2005 16:35:5
    * @location Cali-Colombia
    */
    function getPersonal($perscodigos,$blClose=true){
		$PersonalManager = Application :: getDomainController('PersonalManager');
		$result = $PersonalManager->getByIdPersonal($perscodigos);
		if($blClose)
			$this->close();
		return $result;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Actualiza los datos del personal
    * @author creyes
    * @param string $perscodigos 
    * @return array
    * @date 11-August-2005 16:35:5
    * @location Cali-Colombia
    */
    function updatePersonal($perscodigos, $persidentifs, $persnombres, $persapell1s, $persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1, $perstelefo2, $persdireccis, $persemails, $perscontacts, $perstelcont, $persestadoc){
		$PersonalManager = Application :: getDomainController('PersonalManager');
		$result = $PersonalManager->updatePersonal($perscodigos, $persidentifs, $persnombres, $persapell1s, $persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1, $perstelefo2, $persdireccis, $persemails, $perscontacts, $perstelcont, $persestadoc);
		$this->close();
        if($result == 2)
            return false;
		return true;
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Consulta todos los hijos de un ente organizacional
    * @author creyes
    * @param string $orgacodigos
    * @return array
    * @date 14-September-2005 11:59:52
    * @location Cali-Colombia
    */
    function getEnteSon($orgacodigos){
		$objOrganizacion = Application :: getDomainController('OrganizacionManager');
		$rcTmp = $objOrganizacion->fncinicio($orgacodigos);
        $this->close();
        return $rcTmp;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene un listado de entes a partir de un array con los id de los entes,
    * Ejecuta la consulta armando un SELECT .... IN y retornando un array con indices asociativos
    * indice = id del ente; valor = nombre del ente
    * @author creyes
    * @param array $rcEntes
    * @return type name desc
    * @date 27-January-2006 12:36:26
    * @location Cali-Colombia
    */
    function getEntesByIdInArray($rcEntes){
		$objOrganizacion = Application :: getDomainController('OrganizacionManager');
		$rcTmp = $objOrganizacion->getEntesByIdInArray($rcEntes);
        $this->close();
        return $rcTmp;
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
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el responsable del grupo
	* @param integer $nuGrupcodigon 
	* @param boolean $sbFlag Determina si se debe cerrar o no el servicio
	* @return string con el nombre completo del responsable del grupo
	* @author freina<freina@parquesoft.com>
	* @date 08-Apr-2006 16:30
	* @location Cali-Colombia
	*/
    function getOrderedByGrupo($nuGrupcodigon,$sbFlag=true){
    	
    	settype($objGateway,"object");
    	settype($rcTmp,"array");
    	settype($rcResult,"array");
    	settype($sbTmp,"string");
    	
    	if($nuGrupcodigon){
    		$objGateway = Application :: getDataGateway("SqlExtended");
			$rcTmp = $objGateway->getOrderedByGrupo($nuGrupcodigon);
			if($rcTmp){
				$sbTmp = $rcTmp[0]["persnombres"]." ".$rcTmp[0]["persapell1s"].
				" ".$rcTmp[0]["persapell2s"];
				$rcResult["nombre"] = $sbTmp;
				$rcResult["email"] = $rcTmp[0]["persemails"];
			}	
    	}
    	
    	if ($sbFlag) {
			$this->close();
		}
    	
    	return $rcResult;
    }
     function getOrgacodigosByPersonal($isbPerscodigos,$blTipo=true)
    {
    	settype($objData,"object");
    	settype($rcRet,"array");

    	$objData = $this->getGateWay("sqlExtended");
    	$rcRet = $objData->getOrgacodigosByPersonal($isbPerscodigos,$blTipo);
    	$this->rcDataOrg = $rcRet;
    	$rcRet = $rcRet[0];
        return $rcRet["orgacodigos"];
    }
    
    function getGroupPersonalLeaders()
    {
    	settype($objManager,"object");
    	settype($rcRRFF,"array");

    	$objData  = $this->getGateWay("organizacionExtended");
		$rcRRFF = $objData->getAllPersonalLeaders();
		
        return $rcRRFF;
    }
    
        /**
    * Copyright 2005 FullEngine
    *
    * Trae los datos del personal
    * @author creyes
    * @param string $perscodigos 
    * @return array
    * @date 11-August-2005 16:35:5
    * @location Cali-Colombia
    */
    function getPersonalbyUsername($rcusername,$blClose=true)
    {
    	$rcusername = $this->prepareArray($rcusername);
		$PersonalManager = Application :: getDataGateway('personalExtended');
		$result = $PersonalManager->getByUsernamePersonal($rcusername);
		if($blClose)
			$this->close();
		return $result;
    }
    
    function prepareArray($rcusername)
    {
    	if(!is_array($rcusername))
    		return "'".$rcusername."'";
    	foreach ($rcusername as $value)
    		$rcReturn[] = "'".$value."'";
    	return $rcReturn;
    }
    
        /**	
	*	Copyright 2004  FullEngine
	*	
	*	Obtiene las dependencias fisicas configuradas 
	*	@param bool $sbFlag Indica al metodo si tiene que regresar o no el control al aplication
	*	@return array datos de las dependencias
	*	@author freina<freina@parquesoft.com>
	*	@date 21-Aug-2006 13:23
	*	@location Cali - Colombia
	*/
	function getPhysicaldependencies($sbFlag = true) {
		
		settype($objManager,"object");
		settype($rcResult,"array");
		$objManager = Application :: getDomainController('PhysicaldependenciesManager');
		$rcResult = $objManager->getPhysicaldependencies();
		if ($sbFlag){
			$this->close();
		}
		if(!$rcResult){
			$rcResult = array();
		}
		return $rcResult;
	}

	function getAllOrganizacionById() {
		$OrganizacionGateway = Application :: getDataGateway("organizacion");
		$rcreturn = $OrganizacionGateway->getAllOrganizacionById();
		$this->close();
		return $rcreturn;
	}
	
	function getAllActiveAgents() {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rcPersonal = $gateway->getDataCombo("agentes");
		$this->close();
		return $rcPersonal;
	}
	
	/**
	@copyright Copyright 2012 &copy FullEngine
	
	Obtiene los datos de un ente organizacional (generico)
	@param string $isborgacodigos (Cadena con el codigo del ente organizacional)
	@param boolean $ibflag (true se cierra el servicio, false se deja abierto)
	@return array $orcresult (arreglo con el nombre y email del ente)
	@author freina <freina@parquesoft.com>
	@date 14-Mar-2012 16:43
	@location Cali-Colombia
	*/
	function getByIdEntesOrg($sbOrgacodigos, $sbFlag = true) {
		settype($objGateway, "object");
		settype($rcTmp, "array");
		$objGateway = Application :: getDataGateway("organizacion");
		$rcTmp = $objGateway->getByIdOrganizacion($sbOrgacodigos);
		if ($sbFlag) {
			$this->close();
		}
		return $rcTmp;
	}
	
	/**
	@copyright Copyright 2016 &copy FullEngine
	
	Determina si un ente organizacional existe y esta activo
	@param string $sbOrgacodigos (Cadena con el codigo del ente organizacional)
	@param boolean $sbFlag (true se cierra el servicio, false se deja abierto)
	@return array $sbResult true existe y esta activa, false no existe o esta inactiva
	@author freina <freina@fullengine.com>
	@date 14-Oct-2016 10:43
	@location Cali-Colombia
	*/
	function existOrganizacion($sbOrgacodigos, $sbFlag=true){
		
		settype($objGateway, "object");
		settype($objService, "object");
		settype($rcTmp, "array");
		settype($rcState, "array");
		settype($sbResult, "string");
		settype($sbState, "string");
		
		$sbResult = false;
		$sbState = Application::getConstant("REG_ACT");
		$objService = Application :: loadServices("General");
		$rcState = $objService->getParam("human_resources", "ORG_INACT");
		
		$objGateway = Application :: getDataGateway("organizacion");
		$rcTmp = $objGateway->getByIdOrganizacion($sbOrgacodigos);
		if ($sbFlag) {
			$this->close();
		}
		if(is_array($rcTmp) && $rcTmp){
			$rcTmp = $rcTmp[0];
			if($rcTmp["orgaactivas"]==$sbState){
				if(is_array($rcState) && $rcState){
					if(!in_array($rcTmp["esorcodigos"], $rcState)){
						$sbResult = true;
					}
				}else{
					$sbResult = true;
				}
			}
		}
		return $sbResult;
	}
}
?>