<?php  
/**Copyright 2004  FullEngine
	
	 Servicio del modulo de workflow
	@author freina <freina@parquesoft.com>
	@date 10-sep-2004 15:01:00
	@location Cali - Colombia*/

class Workflow {
	var $appName;
	var $appDir;
	var $objwm;

	function Workflow() {
		//Guarda los datos anteriores
		$this->appDir = Application :: getBaseDirectory();
		$this->appName = Application :: getName();

		//Cambia la configuracion de la aplicacion
		$dir_name = dirname(__FILE__)."/../../../applications/workflow";
		$name = "workflow";
		$objTmp = new Application($name, $dir_name, true);
		//Instancia la clase de las reglas basicas del workflow
		//$this->objwm = Application :: getDomainController('WorkflowManager');
	}
	/**
		Copyright 2004  FullEngine
		
		Muestra toda la informacion del servicio
		@author freina <freina@parquesoft.com>
		@date 10-sep-2004 15:03:00
		@location Cali-Colombia
	*/
	function serviceInfo() {
		$rcinfo = array ("getIniTareasSql" => "Copyright 2004  FullEngine<br>
																			Obtien los sql de  la(s) tarea(s) iniciales de un proceso , 
																			@param string \$isbordenumeros C�digo del requerimiento<br>
																			@param string \$isbproccodigos C�digo del proceso<br>
																			@param boolean \$isbflag Indica si se debe cerrar el servicio
																			@return boolean true o false<br>
																			@author freina <freina@parquesoft.com><br>
																			@date 10--Sep-2004 15:17:00<br>
																			@location Cali - Colombia", "getIdprocess" => "   		Propiedad intelectual del FullEngine.<br>
																			Busca el proceso a seguir comparando los datos del requerimiento y los de la base de datos<br>
																			@author freina<br>
																			@param array $ircdata (Arreglo con la data del requerimiento)<br>
																			@param boolean \$isbflag Indica si se debe cerrar el servicio<br>
																			@return string $sbresult (Codigo del proceso o null)<br>
																			@date 10-Sep-2004 15:28<br>
																			@location Cali-Colombia", "getProcess" => "   		Propiedad intelectual del FullEngine.<br>
																			Busca la data de configuracion de un proceso a partir de su codigo (generico)<br>
																			@author freina<br>
																			@param string $isbproccodigos (Cadena con el codigo del proceso)<br>
																			@param boolean \$isbflag Indica si se debe cerrar el servicio<br>
																			@return array $orcresult (Arreglo con la data del proceso o null)<br>
																			@date 10-Sep-2004 15:28<br>
																			@location Cali-Colombia", "getSqlInaAct" => "   	Propiedad intelectual del FullEngine.<br>
																			Obtiene el sql que desactiva las actas activas de un requerimiento<br>
																			@author freina<br>
																			@param string $isbordenumeros (Cadena con el codigo del requerimiento)<br>
																			@param boolean $isbflag Indica si se debe cerrar el servicio<br>
																			@return string $osbsql (Sql necesario para de sactivar las actas activas de un requerimiento)<br>
																			@date 11-Sep-2004 11:28<br>
																			@location Cali-Colombia", "getAsignWork" => " Copyright 2004 &copy; FullEngine
																		 Trae un listado de taraes asiganadas a un ente organizacional<br>
																		 @param string \$orgacodigos C�digo del ente organizacional<br>
																		 @return array <br>
																		 @author creyes <cesar.reyes@parquesoft.com><br>
																		 @date 15-sep-2004 15:58:12<br>
																		 @location Cali-Colombia", "getAllEstadoacta" => "@copyright Copyright 2004 &copy; FullEngine<br>
																		  Trae todos los estado de acta<br>
																		 @return Array<br>
																		 @author creyes <cesar.reyes@parquesoft.com><br>
																		 @date 16-sep-2004 15:11:52<br>
																		 @location Cali-Colombia", "getByIdActa" => "Copyright 2004 &copy; FullEngine<br>
																  Consulta los datos del acta<br>
																 @param string \$actacodigos <br>
																 @return array<br>
																 @author creyes <cesar.reyes@parquesoft.com><br>
																 @date 17-sep-2004 13:50:05<br>
																 @location Cali-Colombia", "fncnexttareas" => " Propiedad intelectual del FullEngine.<br>
																		   Busca e inicializa las tareas siguientes de un proceso<br>
																		   @author creyes<br>
																		   @param string \$isbordenumeros (Codigo del requrimiento)<br>
																		   @param string \$isbproccodigos (Codigo del proceso)<br>
																		   @param string \$isbtarecodigos (Codigo de la tarea)<br>
																		   @param string \$isbrutaesactas (Codigo del estado actual de la tarea)<br>
																		   @return array (Especificando cuales actas fureon instanciadas y cuales no)<br>
																		   @date 04-Ago-2004 14:41<br>
																		   @location Cali-Colombia", "updateActa" => "@copyright Copyright 2004 &copy; FullEngine<br>
																  Hace el update del acta<br>
																 @param array \$rcActa <br>
																 @return bool <br>
																 @author creyes <cesar.reyes@parquesoft.com><br>
																 @date 20-sep-2004 10:45:13<br>
																 @location Cali-Colombia", "addActaestorden" => "@copyright Copyright 2004 &copy; FullEngine<br>
																			Graba el registro en actaestorden<br>
																			@param array \$rcActaestorden <br>
																			@return bool <br>
																			@author creyes <cesar.reyes@parquesoft.com><br>
																			@date 20-sep-2004 11:11:54<br>
																			 @location Cali-Colombia", "getByIdActaFicha" => "	 @copyright Copyright 2004 &copy; FullEngine<br>
																				  Consulta los datos del acta para la ficha<br>
																				 @param string \$actacodigos <br>
																				 @return array<br>
																				 @author creyes <cesar.reyes@parquesoft.com><br>
																				 @date 21-sep-2004 9:34:43<br>
																				 @location Cali-Colombia", "updateActa" => "@copyright Copyright 2004 &copy; FullEngine<br>
																	  Hace el update del acta<br>
																	 @param array \$rcActa Vector de indices asociativos con los datos actualizados del acta<br>
																	 @return boolean<br>
																	 @author creyes <cesar.reyes@parquesoft.com><br>
																	 @date 21-sep-2004 15:18:51<br>
																	 @location Cali-Colombia", "fncvaldatest" => "Propiedad intelectual del FullEngine.<br>
																	   Valida el estado anterior y propuesto de la tarea contra los datos ingresados<br>
																	   @author freina<br>
																	   @param string $isbproccodigos (Codigo del proceso)<br>
																	   @param array \$ircdata (Arreglo con la data del acta)<br>
																		@return array \$orcresult ( [result] true si todo ok,: [result] false error,[detail] Dato con error)<br>
																	   @date 27-Ago-2004 0108<br>
																	   @location Cali-Colombia",
											"getByOrdenActiveActas"=>"@Copyright 2004 � FullEngine" .
																							"Obtiene la informacion de las actas activas de una orden" .
																							"@param string $isbordenumeros (Cadena con el codigo del requerimiento)" .
																							"@return Array $orcresult (Matriz con la data de las actas)" .
																							"@author freina <freina@parquesoft.com>" .
																							"@date 14-Dic-2004 09:10" .
																							"@location Cali - Colombia",
											"execute_rules"=>'Propiedad intelectual del FullEngine.' .
													'jecuta las reglas de acuerdo a un cambio de estado' .
													'@author freina' .
													'@param array $rcExec (Arreglo con la data de las rutas que definen las	reglas a aplicar)' .
													'@param array $rcData (Arreglo con la data que requieren los metodos )' .
													'@param  boolean $sbflag (Indica si se debe o no cerar el servicio)' .
													'@return array or null (Arreglo con los resultados de los metodos )' .
													'@date 14-Dic-2004 14:15' .
													'@location Cali-Colombia',
						"getSqlActiveEstadoacta"=>"Copyright 2004  FullEngine" .
								"Obtiene el sql de los estados de las actas activos (Servicio Generico)" .
								"@return array" .
								"@author freina <freina@parquesoft.com>" .
								"	@date 12-Ene-2005 16:09" .
								"@location Cali-Colombia",
						"getDataActiveEstadoacta"=>"Copyright 2004  FullEngine".
																	 "Obtiene	 el registro de un estado de acta activo (Servicio".
																	 "generico)".
																	 "@return	 array".
																	 "@author	 freina <freina@parquesoft.com>".
																	 "@param	 string $isbesaccodigos (Cadena con el codigo del estado de acta".
																	 "@date	 16-Ene-2005 16:03".
																	 "@location	 Cali-Colombia",
						"updateActaSql"=>"@copyright Copyright 2004 &copy; FullEngine" .
								"Obtiene el sql para realizar el update de un acta" .
								"@param array $ircActa" .
								"@param boolean $isbFlag Bandera que indica si se debe cerrar el servicio" .
								"@return string $osbResult" .
								"@author freina <freina@parquesoft.com>" .
								"@date 11-Jul-2005 17:03" .
								"@location Cali-Colombia",
						"getActaestordenByActacodigos"=>"@copyright Copyright 2004 &copy; FullEngine" .
										"Obtiene los registros de actaestorden" .
										"@param string $isbActacodigos Cadena con el codigo del acta" .
										"@param array $orcResult array con los registros o arreglo vacio" .
										"@author freina <freina@parquesoft.com>" .
										"@date 18-Jul-2005 17:43
	* @location Cali-Colombia",
			"getSqlUpdateState"=>"@copyright Copyright 2004 &copy; FullEngine" .
			"Obtiene los sql para modificar los estados del acta" .
			"@param string $isbActaestants Cadena con el id del estado actual" .
			"@param string $isbActaestants Cadena con el id del estado anterior" .
			"@param string $isbActacodigos Cadena con el id del acta" .
			"@param string $isbFlag Cadena que indica si se debe cerrar o no el servicio" .
			"@return string $osbResult Cadena con el sql" .
			"@author freina <freina@parquesoft.com>" .
			"@date 18-Jul-2005 18:30" .
			"@location Cali-Colombia",
							"DetermineFinalizedActa"=>"@copyright Copyright 2004 &copy; FullEngine" .
									"Determina si unacta esta finalizada" .
									"@param string $isbActacodigos Cadena con el id del acta" .
									"@return boolean $osbresult Boolena true si el acta esta finalizada, false si esta en otro estado" .
									"@author freina <freina@parquesoft.com>" .
									" @date 22-Jul-2005 10:59" .
									"@location Cali-Colombia",
			"DeactivateRoute"=>"@copyright Copyright 2004 &copy; FullEngine" .
					"Desactiva la ruta trazada por un acta" .
					"@param string $isbActacodigos Cadena con el id del acta" .
					"@param string $isbFlag Cadena que indica si se debe cerrar o no el servicio" .
					"@return array $orcResult Arreglo con los sql y los codigos de las actas a desactivar" .
					"@author freina <freina@parquesoft.com>" .
					"@date 22-Jul-2005 11:49" .
					"@location Cali-Colombia",
					"getSqlDeactivateActa"=>"@copyright Copyright 2004 &copy; FullEngine" .
							"Obtiene el sql necesario para desactivar un acta" .
							"@param string $isbActacodigos Cadena con el id del acta" .
							"@param string $isbFlag Cadena que indica si se debe cerrar o no el servicio" .
							"@return string $osbResult adena con el sql que desactivara el acta" .
							"@author freina <freina@parquesoft.com>" .
							"@date 23-Jul-2005 15:59" .
							"@location Cali-Colombia",
							"getSqlActivateActa"=>"@copyright Copyright 2004 &copy; FullEngine" .
									"Obtiene el sql necesario para activar un acta" .
									"@param string $isbActacodigos Cadena con el id del acta" .
									"@param string $isbFlag Cadena que indica si se debe cerrar o no el servicio" .
									"@return string $osbResult adena con el sql que desactivara el acta" .
									" @author freina <freina@parquesoft.com>" .
									"@date 23-Jul-2005 16:20" .
									"@location Cali-Colombia","DetermineReopenOrden"=>"@copyright Copyright 2004 &copy; FullEngine" .
											"Obtiene el sql necesario para activar un acta" .
											"@param string $isbOrdenumeros Cadena con el id de la orden" .
											"@param array $ircData Arreglo con los codigos de las actas a desactivar" .
											"@param string $isbFlag Cadena que indica si se debe cerrar o no el servicio" .
											"@return string $osbResult adena con el sql que desactivar el acta" .
											"@author freina <freina@parquesoft.com>" .
											"@date 25-Jul-2005 11:58" .
											"@location Cali-Colombia",
								"getDataTarea"=>'@copyright Copyright 2006 &copy; FullEngine' .
					    		'Obtiene los datos de la tarea pasada como parametro' .
					    		'@param string $sbTarecodigos (Cadena con el codigo de la tarea)' .
					    		'@param string $sbFlag Indica si debe o no cerrarse el servicio' .
					    		'@return array $rcResult arreglo con la data de la tarea' .
					    		'@author freina <freina@parquesoft.com>' .
					    		'@date 10-Apr-2006 14:12' .
					    		'@location Cali-Colombia',
								"getEstIniTarea"=>'Copyright 2010 FullEngine
								Obtiene el estado inicial de una tarea dentro de un proceso
								@author freina <freina@parquesoft.com>
								@param string $sbProccodigos Cadena con el Id del proceso
								@param string $sbTarecodigos Cadena con el Id de la tarea
								@param boolean indica si se cierra o no el servicio
								@date 10-Oct-2010 15:00:00
								@location Cali-Colombia',
		"getEstTarea"=>'Copyright 2010 FullEngine
		Obtiene los estados configurados para una tarea dentro de un proceso
		@author freina <freina@parquesoft.com>
		@param string $sbProccodigos Cadena con el Id del proceso
		@param string $sbTarecodigos Cadena con el Id de la tarea
		@param boolean indica si se cierra o no el servicio
		@return type name desc
		@date 18-Oct-2010 16:29:00
		@location Cali-Colombia',);
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
	*   Propiedad intelectual del FullEngine.
	*
	*   Inicializa las tareas de un requerimiento nuevo
	*   @author freina
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbproccodigos (Codigo del proceso)
	*  @param boolean \$isbflag Indica si se debe cerrar el servicio
	*   @param array $rcExtra (optional) Datos extra que pueden servir para la asignaci�n
	*										$rcExtra["orgacodigos"] = array(1,5,9....N);
	*	@return true o false
	*   @date 28-Jul-2004 11:18
	*   @location Cali-Colombia
	*/
	function getIniTareasSql($isbordenumeros, $isbproccodigos, $actafechingn=null ,$isbflag = false, $rcExtra = null) {

		settype($orcresult, "array");
		//Instancia la clase de las reglas basicas del workflow
		$domain = Application :: getDomainController('WorkflowManager');
		$orcresult = $domain->fncinitareassql($isbordenumeros, $isbproccodigos, $actafechingn, $rcExtra);
		if ($isbflag) {
			$this->close();
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca el proceso a seguir comparando los datos del requerimiento y los de la base de datos
	*   @author freina
	*	@param array $ircdata (Arreglo con la data del requerimiento)
	*  @param boolean \$isbflag Indica si se debe cerrar el servicio
	*	@return string $sbresult (Codigo del proceso o null)
	*   @date 10-Sep-2004 15:28
	*   @location Cali-Colombia
	*/
	function getIdprocess($ircdata, $isbflag = false) {

		settype($sbresult, "string");
		//Instancia la clase de las reglas basicas del workflow
		$domain = Application :: getDomainController('WorkflowManager');
		$sbresult = $domain->fncdecideproc($ircdata);
		if ($isbflag) {
			$this->close();
		}
		return $sbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca e inicializa las tareas siguientes de un proceso
	*   @author creyes
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbproccodigos (Codigo del proceso)
	*	@param string $isbtarecodigos (Codigo de la tarea)
	*	@param string $isbrutaesactas (Codigo del estado actual de la tarea)
	*   @param array $rcExtra (optional) Datos extra que pueden servir para la asignaci�n
	*										$rcExtra["orgacodigos"] = array(1,5,9....N);
	*	@return array (Especificando cuales actas fureon instanciadas y cuales no)
	*   @date 04-Ago-2004 14:41
	*   @location Cali-Colombia
	*/
	function fncnexttareas($isbordenumeros, $isbactacodigos, $isbproccodigos, $isbtarecodigos, $isbrutaesactas, $rcExtra = null) {
		$domain = Application :: getDomainController('WorkflowManager');
		$rcresult = $domain->fncnexttareas($isbordenumeros, $isbactacodigos, $isbproccodigos, $isbtarecodigos, $isbrutaesactas, $rcExtra);
		$this->close();
		return $rcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca la data de configuracion de un proceso a partir de su codigo (generico)
	*   @author freina
	*	@param string $isbproccodigos (Cadena con el codigo del proceso)
	*  @param boolean $isbflag Indica si se debe cerrar el servicio
	*	@return array $orcresult (Arreglo con la data del proceso o null)
	*   @date 10-Sep-2004 15:28
	*   @location Cali-Colombia
	*/
	function getProcess($isbproccodigos, $isbflag = false) {

		settype($objprocess, "object");
		settype($rctmp, "array");
		settype($orcresult, "array");
		//Instancia el domain de la tabla proceso
		$objprocess = Application :: getDomainController('ProcesoManager');
		$rctmp = $objprocess->getByIdProceso($isbproccodigos);
		if ($rctmp) {
			$orcresult = $rctmp[0];
		}
		if ($isbflag) {
			$this->close();
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene el sql que desactiva las actas activas de un requerimiento
	*   @author freina
	*	@param string $isbordenumeros (Cadena con el codigo del requerimiento)
	*  @param boolean $isbflag Indica si se debe cerrar el servicio
	*	@return string $osbsql (Sql necesario para de sactivar las actas activas de un requerimiento)
	*   @date 11-Sep-2004 11:28
	*   @location Cali-Colombia
	*/
	function getSqlInaAct($isbordenumeros, $isbflag = false) {

		settype($sbactainac, "string");
		settype($osbsql, "string");
		settype($gateway, "object");

		$sbactainac = Application :: getConstant("ACTA_INAC");

		//Instancia el domain de la tabla proceso
		$gateway = Application :: getDataGateway("ActaExtended");
		$osbsql = $gateway->updateActaactivasByOrdenumeros($isbordenumeros, $sbactainac);
		if ($isbflag) {
			$this->close();
		}
		return $osbsql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Trae un listado de taraes asiganadas a un ente organizacional
	* @param string $orgacodigos C�digo del ente organizacional
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 15-sep-2004 15:58:12
	* @location Cali-Colombia
	*/
	function getAsignWork($orgacodigos,$order_by=null,$sentido=null) {
		//Obtiene la compuerta
		$gateway = Application :: getDataGateway("actaExtended");
		$rcTareas = $gateway->getActasAsign($orgacodigos,$order_by,$sentido);
		$this->close();
		return $rcTareas;
	}
	/*
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Trae todos los estado de acta
	* @return Array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 16-sep-2004 15:11:52
	* @location Cali-Colombia
	*/
	function getAllEstadoacta() {
		$gateway = Application :: getDataGateway("estadoacta");
		$rcEstadosacta = $gateway->getAllEstadoacta();
		$this->close();
		return $rcEstadosacta;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Consulta los datos del acta
	* @param string $actacodigos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 17-sep-2004 13:50:05
	* @location Cali-Colombia
	*/
	function getByIdActa($actacodigos, $flag = true) {
		$gateway = Application :: getDataGateway("acta");
		$data_acta = $gateway->getByIdActa($actacodigos);
		if ($flag == true)
			$this->close();
		return $data_acta;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Hace el update del acta
	* @param array $rcActa 
	* @return bool 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-sep-2004 10:45:13
	* @location Cali-Colombia
	*/
	function updateActa($rcActa, $flag = true) {
		$actaManager = Application :: getDomainController("ActaManager");
		$result = $actaManager->updateActa($rcActa["actacodigos"], $rcActa["ordenumeros"], $rcActa["tarecodigos"], $rcActa["actaestacts"], $rcActa["actaestants"], $rcActa["actafechingn"], $rcActa["usuacodigos"], $rcActa["orgacodigos"], $rcActa["actaactivas"]);
		if ($result == 3)
			$return = true;
		else
			$return = false;
		if ($flag == true)
			$this->close();
		return $return;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Graba el refistro en actaestorden
	* @param array $rcActaestorden 
	* @return bool 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-sep-2004 11:11:54
	* @location Cali-Colombia
	*/
	function addActaestorden($rcActaestorden, $flag = true) {
			//Calcula el indice de la tabla
	$numerador_manager = Application :: getDomainController('NumeradorManager');
		$acescodigos = $numerador_manager->fncgetByIdNumerador("actaestorden");
		//Graba el registro
		$actaestordenManager = Application :: getDomainController("ActaestordenManager");
		$result = $actaestordenManager->addActaestorden($acescodigos, $rcActaestorden["actacodigos"], $rcActaestorden["acesestrecis"], $rcActaestorden["acesestentrs"], $rcActaestorden["acesfechmovs"]);
		if ($result == 3)
			$return = true;
		else
			$return = false;
		if ($flag == true)
			$this->close();
		return $return;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Consulta los datos del acta para la ficha
	* @param string $actacodigos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-sep-2004 9:34:43
	* @location Cali-Colombia
	*/
	function getByIdActaFicha($actacodigos,$tarecodigos=false) {
		$gateway = Application :: getDataGateway("actaExtended");
		$data_acta = $gateway->getByIdActaFicha($actacodigos,$tarecodigos);
		$this->close();
		return $data_acta;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida el estado anterior y propuesto de la tarea contra los datos ingresados
	*   @author freina
	*   @param string $isbproccodigos (Codigo del proceso)
	*   @param array $ircdata (Arreglo con la data del acta)
	*	@return array $orcresult ( [result] true si todo ok,: [result] false error,[detail] Dato con error)
	*   @date 27-Ago-2004 0108
	*   @location Cali-Colombia
	*/
	function fncvaldatest($isbproccodigos, $ircdata, $flag = true) {
		$domain = Application :: getDomainController('WorkflowManager');
		$result = $domain->fncvaldatest($isbproccodigos, $ircdata);
		if ($flag == true)
			$this->close();
		return $result["result"];
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Consulta los datos del acta para la ficha
	* @param string $ordenumeros
	* @return array
	* @author cazapata <cazapata@parquesoft.com>
	* @date 21-sep-2004 9:34:43
	* @location Cali-Colombia
	*/

	function getByOrdenActas($ordenumeros) {
		$gateway = Application :: getDataGateway("acta");
		$data_acta = $gateway->getByActa_fkey($ordenumeros);
		$this->close();
		return $data_acta;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Trae todos los procesos activos
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 11:15:54
	* @location Cali - Colombia
	*/
	function getAllActiveProcess(){
		$gateway = Application :: getDataGateway("sqlExtended");
		$procsos = $gateway->getDataCombo("proceso");
		$this->close();
		return $procsos;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Trae todos los estados de procesos activos
	* @return array 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-dic-2004 11:15:54
	* @location Cali - Colombia
	*/
	function getAllActiveEstadoproces(){
		$gateway = Application :: getDataGateway("sqlExtended");
		$procsos = $gateway->getDataCombo("estadoproces");
		$this->close();
		return $procsos;
	}
	/**
	* @Copyright 2004 � FullEngine
	*
	* Obtiene la informacion de las actas activas de una orden
	* @param string $isbordenumeros (Cadena con el codigo del requerimiento)
	* @return Array $orcresult (Matriz con la data de las actas) 
	* @author freina <freina@parquesoft.com>
	* @date 14-Dic-2004 09:10
	* @location Cali - Colombia
	*/
	function getByOrdenActiveActas($isbordenumeros){
		
		settype($objgateway,"object");
		settype($orcresult,"array");
		$objgateway = Application :: getDataGateway("actaExtended");
		$orcresult = $objgateway->getActaByOrdenumeros($isbordenumeros);
		$this->close();
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   ejecuta las reglas de acuerdo a un cambio de estado
	*   @author freina
	*	@param array $rcExec (Arreglo con la data de las rutas que definen las
	*	reglas a aplicar)
	*	@param array $rcData (Arreglo con la data que requieren los metodos )
	*	@param  boolean $sbflag (Indica si se debe o no cerar el servicio)  
	*	@return array or null (Arreglo con los resultados de los metodos )
	*   @date 14-Dic-2004 14:15
	*   @location Cali-Colombia
	*/
	function execute_rules($rcExec, $rcData, $sbflag = true) {
		
		settype($objdomain,"object");
		settype($orcresult,"array");
		
		if($rcExec && $rcData){
			$objdomain = Application :: getDomainController('WorkflowManager');
			$orcresult = $objdomain->fncexecute_rules($rcExec, $rcData);
		}
		
		if ($sbflag == true)
			$this->close();
		return $orcresult;
	}
	/**
		Copyright 2004  FullEngine
		
		Obtiene el sql de los estados de las actas activos (Servicio Generico)
		@return array
		@author freina <freina@parquesoft.com>
		@date 12-Ene-2005 16:09
		@location Cali-Colombia		
	*/
	function getSqlActiveEstadoacta() {
		
		settype($objgateway,"object");
		settype($osbsql,"string");
		//Instancio la compuerta de estados de acta (Estados de la tarea)
		$objgateway = Application :: getDataGateway("estadoactaExtended");
		//Llamo el metodo que obtiene el sql
		$osbsql = $objgateway->getAllActiveEstadoacta();
		$this->close();
		return $osbsql;
	}
	/**Copyright 2004  FullEngine
		
		*	Obtiene	 el registro de un estado de acta activo (Servicio
		*generico)
		*	@return	 array
		*	@author	 freina <freina@parquesoft.com>
		*	@param	 string $isbesaccodigos (Cadena con el codigo del estado de acta
		*	@date	 16-Ene-2005 16:03
		*	@location	 Cali-Colombia
	*/
	function getDataActiveEstadoacta($isbesaccodigos) {
		
		settype($objgateway,"object");
		settype($orcresult,"array");
		//Instancio la compuerta de tipos de requerimiento (clasificaciones)
		$objgateway = Application :: getDataGateway("estadoactaExtended");
		//Llamo el metodo que obtiene la data
		$orcresult = $objgateway->getActiveEstadoacta($isbesaccodigos);
		$this->close();
		return $orcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql para realizar el update de un acta
	* @param array $ircActa
	* @param boolean $isbFlag Bandera que indica si se debe cerrar el servicio
	* @return string $osbResult
	* @author freina <freina@parquesoft.com>
	* @date 11-Jul-2005 17:03
	* @location Cali-Colombia
	*/
	function updateActaSql($ircActa, $isbFlag = true) {
		
		settype($objManager,"object");
		settype($osbResult,"string");
		
		$objManager = Application :: getDomainController("ActaManager");
		$osbResult = $objManager->updateActaSql($ircActa["actacodigos"], $ircActa["ordenumeros"], $ircActa["tarecodigos"], $ircActa["actaestacts"], $ircActa["actaestants"], $ircActa["actafechingn"], $ircActa["usuacodigos"], $ircActa["orgacodigos"], $ircActa["actaactivas"]);
		
		if ($isbFlag == true){
			$this->close();
		}
		
		return $osbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los registros de actaestorden
	* @param string $isbActacodigos Cadena con el codigo del acta
	* @param boolean $isbFlag Bandera que indica si se debe cerrar el servicio
	* @param array $orcResult array con los registros o arreglo vacio
	* @author freina <freina@parquesoft.com>
	* @date 18-Jul-2005 17:43
	* @location Cali-Colombia
	*/
	function getActaestordenByActacodigos($isbActacodigos,$isbFlag = true){
		settype($objGateway,"object");
		settype($orcResult,"array");
		
		$objGateway = Application :: getDataGateway("actaestordenExtended");
		$orcResult = $objGateway->getActaestordenByActacodigos($isbActacodigos);
		if ($isbFlag == true){
			$this->close();
		}
		return $orcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los sql para modificar los estados del acta
	* @param string $isbActaestants Cadena con el id del estado actual
	* @param string $isbActaestants Cadena con el id del estado anterior
	* @param string $isbActacodigos Cadena con el id del acta
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return string $osbResult Cadena con el sql
	* @author freina <freina@parquesoft.com>
	* @date 18-Jul-2005 18:30
	* @location Cali-Colombia
	*/
	function getSqlUpdateState($isbActaestacts,$isbActaestants,$isbActacodigos,$isbFlag = true){
		settype($objGateway,"object");
		settype($osbResult,"string");
		
		$objGateway = Application :: getDataGateway("actaExtended");
		$osbResult = $objGateway->getSqlUpdateState($isbActaestacts,$isbActaestants,$isbActacodigos);
		if ($isbFlag == true){
			$this->close();
		}
		return $osbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Determina si unacta esta finalizada
	* @param string $isbActacodigos Cadena con el id del acta
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return boolean $osbresult Boolena true si el acta esta finalizada, false
	* si esta en otro estado
	* @author freina <freina@parquesoft.com>
	* @date 22-Jul-2005 10:59
	* @location Cali-Colombia
	*/
	function DetermineFinalizedActa($isbActacodigos,$isbFlag=true){
		settype($objGateway,"object");
		settype($osbResult,"string");
		settype($rcTmp,"string");
		settype($sbState,"string");
		
		$osbResult = false;
		$sbState = Application :: getConstant("ACTA_FIN");
		$objGateway = Application :: getDataGateway("acta");
		$rcTmp = $objGateway->getByIdActa($isbActacodigos);
		if($rcTmp){
			if($rcTmp[0]["actaactivas"]==$sbState){
				$osbResult = true;
			}
		}
		if($isbFlag){
			$this->close();
		}
		return $osbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Desactiva la ruta trazada por un acta
	* @param string $isbActacodigos Cadena con el id del acta
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return array $orcResult Arreglo con los sql y los codigos de las actas a
	* desactivar
	* @author freina <freina@parquesoft.com>
	* @date 22-Jul-2005 11:49
	* @location Cali-Colombia
	*/
	function DeactivateRoute($isbActacodigos,$isbFlag=true){
		
		settype($objManager,"object");
		settype($orcResult,"array");
		
		$objManager = Application :: getDomainController("RecorridoManager");
		$orcResult = $objManager->DeactivateRoute($isbActacodigos);
		if($isbFlag){
			$this->close();
		}
		return $orcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql necesario para desactivar un acta
	* @param string $isbActacodigos Cadena con el id del acta
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return string $osbResult adena con el sql que desactivara el acta
	* @author freina <freina@parquesoft.com>
	* @date 23-Jul-2005 15:59
	* @location Cali-Colombia
	*/
	function getSqlDeactivateActa($isbActacodigos,$isbFlag=true){
		settype($objGateway,"object");
		settype($osbResult,"string");
		
		$objGateway = Application :: getDataGateway("actaExtended");
		$osbResult = $objGateway->getSqlDeactivateActa($isbActacodigos);
		if($isbFlag){
			$this->close();
		}
		return $osbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql necesario para activar un acta
	* @param string $isbActacodigos Cadena con el id del acta
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return string $osbResult adena con el sql que desactivara el acta
	* @author freina <freina@parquesoft.com>
	* @date 23-Jul-2005 16:20
	* @location Cali-Colombia
	*/
	function getSqlActivateActa($isbActacodigos,$isbFlag=true){
		settype($objGateway,"object");
		settype($osbResult,"string");
		
		$objGateway = Application :: getDataGateway("actaExtended");
		$osbResult = $objGateway->getSqlActivateActa($isbActacodigos);
		if($isbFlag){
			$this->close();
		}
		return $osbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql necesario para activar un acta
	* @param string $isbOrdenumeros Cadena con el id de la orden
	* @param array $ircData Arreglo con los codigos de las actas a desactivar
	* @param string $isbFlag Cadena que indica si se debe cerrar o no el
	* servicio
	* @return string $osbResult adena con el sql que desactivar el acta
	* @author freina <freina@parquesoft.com>
	* @date 25-Jul-2005 11:58
	* @location Cali-Colombia
	*/
	function DetermineReopenOrden($isbOrdenumeros,$ircData,$isbFlag=true){
		settype($objManager,"object");
		settype($osbResult,"string");
		
		$objManager = Application :: getDomainController("ActaManager");
		$osbResult = $objManager->DetermineReopenOrden($isbOrdenumeros,$ircData);
		if($isbFlag){
			$this->close();
		}
		return $osbResult;
	}
	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Obtiene los datos de la tarea pasada como parametro
	* @param string $sbTarecodigos (Cadena con el codigo de la tarea)
	* @param string $sbFlag Indica si debe o no cerrarse el servicio 
	* @return array $rcResult arreglo con la data de la tarea
	* @author freina <freina@parquesoft.com>
	* @date 10-Apr-2006 14:12
	* @location Cali-Colombia
	*/
	function getDataTarea($sbTarecodigos,$sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		if($sbTarecodigos){
			$objGateway = Application :: getDataGateway("tarea");
			$rcResult = $objGateway->getByIdTarea($sbTarecodigos);
		}
		
		if($sbFlag){
			$this->close();
		}
		
		return $rcResult;
	}
	
		/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql para el ingreso en la tabla actaestorden
	* @param Array $rcData Arreglo conlos datos del registro
	* @param String $sbFlag  Cadena que define si el servicio se cierra o no
	* @return String con el sql o null
	* @author freina<freina@parquesoft.com>
	* @date 18-May-2006 13:38
	* @location Cali-Colombia
	*/
	function getOrdenes($orgacodigos)
	{
		settype($objManager,"object");
		settype($rcOrd,"array");
		
		$objManager = Application :: getDataGateway("actaExtended");
		$rcOrd = $objManager->getOrdenes($orgacodigos);
		
		if ($sbFlag == true){
			$this->close();
		}
		
		return $rcOrd;
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
	* @Copyright 2006 FullEngine
	*
	* Obtiene los estados de las actas
	* @param boolean $sbFlag Determina si se cierra o no el servicio
	* @return Array $rcResult (Matriz con la data de las actas) 
	* @author freina <freina@parquesoft.com>
	* @date 04-Aug-2006 11:41:00
	* @location Cali - Colombia
	*/
	function getEstadoacta($sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		$objGateway = Application :: getDataGateway("estadoactaExtended");
		$rcResult = $objGateway->getEstadoacta();
		if($sbFlag){
			$this->close();
		}
		return $rcResult;
	}
	
	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Obtiene los datos de las tareas 
	* @return array $rcResult arreglo con los datos  de las tareas
	* @author freina <freina@parquesoft.com>
	* @date 9-Nov-2006 14:05
	* @location Cali-Colombia
	*/
	function getAllTarea($sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		$objGateway = Application :: getDataGateway("tarea");
		$rcResult = $objGateway->getAllTarea();
		
		if($sbFlag){
			$this->close();
		}
		
		return $rcResult;
	}
	/**
	* Copyright 2010 FullEngine
	*
	* Obtiene el estado inicial de una tarea dentro de un proceso
	* @author freina <freina@parquesoft.com>
	* @param string $sbProccodigos Cadena con el Id del proceso
	* @param string $sbTarecodigos Cadena con el Id de la tarea
	* @param boolean indica si se cierra o no el servicio
	* @return type name desc
	* @date 10-Oct-2010 15:00:00
	* @location Cali-Colombia
	*/
	function getEstIniTarea($sbProccodigos, $sbTarecodigos, $sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		$objGateway = Application :: getDataGateway("rutaExtended");
		$rcResult = $objGateway->getEstIniTarea($sbProccodigos, $sbTarecodigos);
		
		if($sbFlag){
			$this->close();
		}
		
		return $rcResult;
	}
	
	/**
	* Copyright 2010 FullEngine
	*
	* Obtiene los estados configurados para una tarea dentro de un proceso
	* @author freina <freina@parquesoft.com>
	* @param string $sbProccodigos Cadena con el Id del proceso
	* @param string $sbTarecodigos Cadena con el Id de la tarea
	* @param boolean indica si se cierra o no el servicio
	* @return type name desc
	* @date 18-Oct-2010 16:29:00
	* @location Cali-Colombia
	*/
	function getEstTarea($sbProccodigos, $sbTarecodigos, $sbFlag=true){
		
		settype($objGateway,"object");
		settype($rcResult,"array");
		
		$objGateway = Application :: getDataGateway("rutaExtended");
		$rcResult = $objGateway->getEstTarea($sbProccodigos, $sbTarecodigos);
		
		if($sbFlag){
			$this->close();
		}
		
		return $rcResult;
	}
}
?>