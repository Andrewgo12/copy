<?php
class FeWFWorkflowManager {
	var $gatewayruta;
	var $gatewayacta;
	var $gatewayactaestorden;
	var $gatewayvalidacion;
	var $gatewayrecorrido;
	var $objdate;
	var $objtmp;
	var $objtmpv;
	var $workListManager;
	function FeWFWorkflowManager() {
		$this->gatewayruta = Application :: getDataGateway("RutaExtended");
		$this->gatewayacta = Application :: getDataGateway("ActaExtended");
		$this->gatewayactaestorden = Application :: getDataGateway("ActaestordenExtended");
		$this->gatewaytareassincro = Application :: getDataGateway("TareassincroExtended");
		$this->gatewayvalidacion = Application :: getDataGateway("ValidacionExtended");
		$this->workListManager = Application :: getDomainController('WorkListManager');
		$this->objdate = Application :: loadServices("DateController");
		$this->objtmp = Application :: getDomainController('NumeradorManager');
		$this->objtmpv = Application :: loadServices("ValidationData");
		$this->gatewayrecorrido = Application :: getDataGateway("RecorridoExtended");
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene lo SQL de las tareas siguientes en un proceso
	*   @author creyes
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbactacodigos (Codigo del acta)
	*	@param string $isbproccodigos (Codigo del proceso)
	*	@param string $isbtarecodigos (Codigo de la tarea)
	*	@param string $isbrutaesactas (Codigo del estado actual de la tarea)
	*   @param array $rcExtra (optional) Datos extra que pueden servir para la asignaci�n
	*									Ej:	$rcExtra["orgacodigos"] = array(1,5,9....N);
	*	@return array or null (Vector con con los sql de las actas o null En caso de error o no hay registros)
	*   @date 04-Ago-2004 14:23
	*   @location Cali-Colombia
	*/
	function fncnexttareassql($isbordenumeros, $isbactacodigos, $isbproccodigos, $isbtarecodigos, $isbrutaesactas, $rcExtra = null) {
		settype($orcresult, "array");
		settype($rctmpresult, "array");
		settype($rcuser, "array");
		settype($rctmp, "array");
		settype($rctmpta, "array");
		settype($rcvalor, "array");
		settype($rcresult, "array");
		settype($sbtareaini, "string");
		settype($nucont, "integer");
		if ($isbordenumeros && $isbproccodigos && $isbtarecodigos && $isbrutaesactas && $isbactacodigos) 
		{
			$rcuser = Application :: getUserParam();
			$sbtareaini = Application :: getConstant("INI_TAR");
			$rctareas = $this->gatewayruta->getByRuta_rutaesactas($isbproccodigos, $isbtarecodigos, $isbrutaesactas);
			if ($rctareas) 
			{
				//se determinan los registros necesarios para instanciar las tareas.
				foreach ($rctareas as $nucont => $rcvalor) {
					
					if ($rcvalor["rutatarsigs"]) {
						$rctmp = $this->gatewayruta->getByRuta_rutatarsigs($isbproccodigos, $rcvalor["rutatarsigs"], $sbtareaini);
						
						//Decide cual ente organizacional ejecutar la taraea
						$rctmp[0]["orgacodigos"] = $this->workListManager->getAptOrganizacional($rctmp[0]["tarecodigos"], $rcExtra["orgacodigos"], $rcExtra);
						$rctmp[0]["rutaporcumn"] = $rcvalor["rutaporcumn"];
						$rcresult[$nucont] = $rctmp[0];
						if(array_key_exists("orgacodigos",$rctmp[0]))
							$orcresult["orgacodigos"] = $rctmp[0]["orgacodigos"];
					}
				}
				//se arma un arreglo con la data que instacio la(s) nueva(s) tarea(s)
				$rctmpta["ordenumeros"] = $isbordenumeros;
				$rctmpta["actacodigos"] = $isbactacodigos;
				$rctmpta["proccodigos"] = $isbproccodigos;
				$rctmpta["tarecodigos"] = $isbtarecodigos;
				$rctmpta["rutaesactas"] = $isbrutaesactas;
				
				/*Arma los sql para ingresar las actas (Inicializar las tareas)*/
				$rctmpresult = $this->fncgensqlactasig($rcresult, $rctmpta, $isbordenumeros, $rcuser["username"], $rcExtra);
				if ($rctmpresult) {
					if ($rctmpresult[0] == "FP") {
						$orcresult[0] = "FP";
					} else {
						$orcresult[0] = $rctmpresult[0];
						$orcresult[1] = $rctareas;
						if ($rctmpresult[1]) {
							$orcresult[2] = $rctmpresult[1];
						}
					}
					$orcresult[3] = $rctmpresult[2];
					$orcresult[4] = $rctmpresult[3];
					if($rctmpresult[4])
						$rctareas = array_merge($rctareas,$rctmpresult[4]);
							
					$orcresult[5] = $rctareas;
					return $orcresult;
				}
			}
		}
		return null;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca e inicializa las tareas siguientes de un proceso
	*   @author freina
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbactacodigos (Codigo del acta)
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
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmpt, "array");
		settype($rctareas, "array");
		settype($rctmpsql, "array");
		settype($sbvalor, "string");
		if ($isbordenumeros && $isbproccodigos && $isbtarecodigos && $isbrutaesactas && $isbactacodigos) {
			$rctareas = $this->fncnexttareassql($isbordenumeros, $isbactacodigos, $isbproccodigos, $isbtarecodigos, $isbrutaesactas, $rcExtra);
			if ($rctareas) {
				if (!($rctareas[0] == "FP")) {
					//codigos de tarea
					$rctmpt = $rctareas[1];
					$rctmpsql[0] = $rctareas[0];
					if ($rctareas[2]) {
						$rctmpsql[1] = $rctareas[2];
					}
				}
				$rctmpsql[2] = $rctareas[3];
				$rctmpsql[3] = $rctareas[4];
				
				/*Iingresa las actas (Inicializar las tareas)*/
				$rctmp = $this->gatewayacta->addActaTrans($rctmpsql);
				if ($rctareas[0] == "FP") {
					$orcresult["FP"] = $rctmp["UPDATE"];
				} else {
					if ($rctmp) {
						if ($rctmp["REQ"]) {
							$orcresult = $rctmp["REQ"];
						} else {
							if ($rctmp["OPC"]) {
								$orcresult = $rctmp["OPC"];
							} else {
								foreach ($rctmp as $nucont => $sbvalor) {
									$orcresult["result"][$nucont][0] = $rctmpt[$nucont]["rutatarsigs"];
									$orcresult["result"][$nucont][1] = $sbvalor;
								}
								//datos de las nuevas tareas, necesarios
								//para la aplicacion de las reglas
								$orcresult["task"]=$rctareas[5];
								if(array_key_exists("orgacodigos",$rctareas))
									$orcresult["orgacodigos"] = $rctareas["orgacodigos"];
							}
						}
					}
				}
				if(isset($orcresult["FP"])){
					$orcresult["task"]=$rctareas[5];
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene los sql de las tareas de un requerimiento nuevo
	*   @author creyes
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbproccodigos (Codigo del proceso)
	*   @param array $rcExtra (optional) Datos extra que pueden servir para la asignaci�n
	*										$rcExtra["orgacodigos"] = array(1,5,9....N);
	*	@return array or null (Vector con con los sql de las actas o null En caso de error o no hay registros)
	*   @date 28-Jul-2004 11:18
	*   @location Cali-Colombia
	*/
	function fncinitareassql($isbordenumeros, $isbproccodigos, $actafechingn = null, $rcExtra = null) {
		settype($rctareas, "array");
		settype($rcuser, "array");
		settype($rcsql, "array");
		settype($sbtareaini, "string");
		if ($isbordenumeros && $isbproccodigos) {
			//Consulta las tareas del proceso 			
			$sbtareaini = Application :: getConstant("TAR_INI_PRO");
			$rcuser = Application :: getUserParam();
			$rctareas = $this->gatewayruta->getByRuta_rutainitars($isbproccodigos, $sbtareaini);
			foreach ($rctareas as $k => $tmpTarea) {
				//Decide cual ente organizacional ejecutar la taraea
				$tmpTarea["orgacodigos"] = $this->workListManager->getAptOrganizacional($tmpTarea["tarecodigos"], $rcExtra["orgacodigos"], $rcExtra);
				$rcSalida[$k] = $tmpTarea;
			}
			if ($rcSalida) {
				/*Arma los sql para ingresar las actas (Inicializar las tareas)*/
				$rcsql = $this->fncgensqlactaini($rcSalida, $isbordenumeros, $rcuser["username"], $actafechingn, $rcExtra);
				if ($rcsql) {
					return $rcsql;
				}
			}
		}
		return null;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera los sql de las actas
	*   @author creyes
	*   @param array $ircdata (Arreglo con la data de la taareas a instanciar)
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbusuacodigos (Codigo del usuario)
	*	@param array $rcExtra (arreglo con la data para el calculo de tiempo de las tareas) 
	*	@return array or null (Vector con con los sql de las actas o null)
	*   @date 28-Jul-2004 13:38
	*   @location Cali-Colombia
	*/
	function fncgensqlactaini($ircdata, $isbordenumeros, $isbusuacodigos, $actafechingn = null, $rcExtra=null) {
		settype($orcresult, "array");
		settype($rcDate,"array");
		settype($nufechahora, "integer");
		settype($nucant, "integer");
		settype($nuinicod, "integer");
		settype($nucontador, "integer");
		settype($nucodactaestorden, "integer");
		settype($sbactaactiva, "string");
		settype($sbnull, "string");
		/*Separa los codigos para la tabla de actas*/
		if ($ircdata) {
			$nucant = sizeof($ircdata);
			$nuinicod = $this->objtmp->fncgetByIdNumerador("acta", $nucant);
			$nucodactaestorden = $this->objtmp->fncgetByIdNumerador("actaestorden", $nucant);
			$sbactaactiva = Application :: getConstant("ACTA_AC");
			$sbnull = Application :: getConstant("DB_NULL");
			if (!$actafechingn)
				$nufechahora = $this->objdate->fncintdatehour();
			else
				$nufechahora = $actafechingn;
			foreach ($ircdata as $nucont => $rctmp) {
				//tiempos de la tarea
				$rcDate = $this->getTaskTime($isbordenumeros, $rctmp["tarecodigos"], $rctmp["rutaporcumn"], $rcExtra["ordefecregd"], $rcExtra);
				if($rcDate && is_array($rcDate)){
					if(!$rcDate["begin"]){
						$rcDate["begin"] = $sbnull;
					}
					if(!$rcDate["end"]){
						$rcDate["end"] = $sbnull;
					}
				}else{
					$rcDate["begin"] = $sbnull; 
					$rcDate["end"] = $sbnull;
				}
				$orcresult["sql"][$nucontador] = $this->gatewayacta->addActaSql($nuinicod, $isbordenumeros, $rctmp["tarecodigos"], $rctmp["rutaesactas"], $sbnull, $nufechahora, $isbusuacodigos, $rctmp["orgacodigos"], $sbactaactiva, $rcDate["begin"], $rcDate["end"]);
				$orcresult["sql"][$nucontador +1] = $this->gatewayactaestorden->addActaestordenSql($nucodactaestorden, $nuinicod, $sbnull, $rctmp["rutaesactas"], $nufechahora);
				$rctmp["fecha_reg"]= $nufechahora;
				$rctmp["actafechinin"]= $rcDate["begin"];
				$rctmp["actafechvenn"]= $rcDate["end"]; 
				$orcresult["data"][] = $rctmp;
				$nucontador += 2;
				$nuinicod ++;
				$nucodactaestorden ++;
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Inicializa las tareas de un requerimiento nuevo
	*   @author freina
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbproccodigos (Codigo del proceso)
	*   @param array $rcExtra (optional) Datos extra que pueden servir para la asignaci�n
	*										$rcExtra["orgacodigos"] = array(1,5,9....N);
	*	@return true o false
	*   @date 28-Jul-2004 11:18
	*   @location Cali-Colombia
	*/
	function fncinitareas($isbordenumeros, $isbproccodigos, $rcExtra = null) {
		settype($rctareas, "array");
		settype($osbresult, "string");
		$osbresult = false;
		if ($isbordenumeros && $isbproccodigos) {
			$rctareas = $this->fncinitareassql($isbordenumeros, $isbproccodigos, $rcExtra);
			if ($rctareas) {
				/*Iingresa las actas (Inicializar las tareas)*/
				$this->gatewayacta->ActaTrans($rctareas["sql"]);
				$osbresult = $this->gatewayacta->consult;
			}
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera los sql de las actas
	*   @author creyes
	*   @param array $ircdata (Arreglo con la data de la taareas a instanciar)
	*   @param array $ircdatao (Arreglo con la data de la tareas que instancia)
	*	@param string $isbordenumeros (Codigo del requrimiento)
	*	@param string $isbusuacodigos (Codigo del usuario)
	*	@param array $rcExtra (informacion extra para el calculo de el tiempo de la tarea) 
	*	@return array or null (Vector con con los sql de las actas o null)
	*   @date 28-Jul-2004 13:38
	*   @location Cali-Colombia
	*/
	function fncgensqlactasig($ircdata, $ircdatao, $isbordenumeros, $isbusuacodigos, $rcExtra=null) {
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmptr, "array");
		settype($rcRecorrido, "array");
		settype($rcDate,"array");
		settype($nufechahora, "integer");
		settype($nucant, "integer");
		settype($nucantt, "integer");
		settype($nuinicod, "integer");
		settype($nucontador, "integer");
		settype($nucont, "integer");
		settype($nucodactaestorden, "integer");
		settype($nuCodRecorrido, "integer");
		settype($sbactaactiva, "string");
		settype($sbactafinalizada, "string");
		settype($sbnull, "string");
		settype($sbOpcional, "string");
		settype($sbInstancia, "string");
		
		/*Separa los codigos para la tabla de actas*/
		if ($ircdata) {
			$nucant = sizeof($ircdata);
			$nuinicod = $this->objtmp->fncgetByIdNumerador("acta", $nucant);
			$nucodactaestorden = $this->objtmp->fncgetByIdNumerador("actaestorden", $nucant);
			$nuCodRecorrido = $this->objtmp->fncgetByIdNumerador("recorrido", $nucant);
			$sbactaactiva = Application :: getConstant("ACTA_AC");
			$sbnull = Application :: getConstant("DB_NULL");
			$sbOpcional = Application :: getConstant("TAREA_OPC");
			$sbInstancia = Application :: getConstant("MAR_INS");
			$nufechahora = $this->objdate->fncintdatehour();
			foreach ($ircdata as $nucont => $rctmp) {
				//tiempos de la tarea
				$rcDate = $this->getTaskTime($isbordenumeros, $rctmp["tarecodigos"], $rctmp["rutaporcumn"], $nufechahora, $rcExtra);
				if($rcDate && is_array($rcDate)){
					if(!$rcDate["begin"]){
						$rcDate["begin"] = $sbnull;
					}
					if(!$rcDate["end"]){
						$rcDate["end"] = $sbnull;
					}
				}else{
					$rcDate["begin"] = $sbnull; 
					$rcDate["end"] = $sbnull;
				}
				$orcresult[0][$nucontador][0] = $this->gatewayacta->addActaSql($nuinicod, $isbordenumeros, $rctmp["tarecodigos"], $rctmp["rutaesactas"], $sbnull, $nufechahora, $isbusuacodigos, $rctmp["orgacodigos"], $sbactaactiva, $rcDate["begin"], $rcDate["end"]);
				$orcresult[0][$nucontador][1] = $this->gatewayactaestorden->addActaestordenSql($nucodactaestorden, $nuinicod, $sbnull, $rctmp["rutaesactas"], $nufechahora);
				$rcRecorrido[$nucontador] = $this->gatewayrecorrido->addRecorridoSql($nuCodRecorrido, $isbordenumeros, $nuinicod, $ircdatao["actacodigos"], $sbOpcional, $sbInstancia, $nufechahora);
				$nuCodRecorrido ++;
				$nucontador ++;
				$nuinicod ++;
				$nucodactaestorden ++;
				$ircdata[$nucont]["fecha_reg"]= $nufechahora;
				$ircdata[$nucont]["actafechinin"]= $rcDate["begin"];
				$ircdata[$nucont]["actafechvenn"]= $rcDate["end"];
			}
			//se retornan los sql de recorrido
			$orcresult[3] = $rcRecorrido;
			
			//si es una sola la tarea  a instanciar puede ser el caso de un and-join 
			//por lo tanto se determinan si existen sql de validacion (si existen se crean).
			$nucantt = sizeof($ircdata);
			if ($nucantt == 1) {
				$nuinicod --;
				
				//se deben determinar las posibles tareas
				$rctmptr = $this->fnctareasrequeridas($ircdata[0]["tarecodigos"], $ircdatao, $rcRecorrido, $nuinicod);
				if ($rctmptr) {
					//se retornan los nuevos sql de recorrido
					$orcresult[3] = $rctmptr[3];
					unset ($rctmptr[3]);
					$orcresult[1] = $rctmptr;
				}
			}
			$orcresult[4] = $ircdata;
		} else {
			$orcresult[0] = "FP";
		}
		//Genera el sql para hacer el update al acta y poner la fecha-hora de finalizaci�n
		$orcresult[2] = $this->gatewayacta->updateFinalizarActa($ircdatao["actacodigos"]);
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera los sql de las actas
	*   @author freina
	*   @param string $isbtareacodigos (Codigo de la tarea a instanciar)
	*   @param array $ircdata (Arreglo con la data de la tareas que instancia)
	* @param aray $ircRecorrido Arreglo con los sql para la tabla de recorrido
	* @param string $isbActacodigos Cadena con el id de la nueva acta
	*	@return array or null (Vector con con los sql que permiten determinar la cantidad de tareas que deben existir en la bd o null)
	*   @date 23-Ago-2004 18:56
	*   @location Cali-Colombia
	*/
	function fnctareasrequeridas($isbtareacodigos, $ircdata, $ircRecorrido, $isbActacodigos) {
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmptr, "array");
		settype($sbtasitipsincsr, "string");
		settype($sbtasitipsincso, "string");
		settype($sbactaactiva, "string");
		settype($sbactafinalizada, "string");
		settype($sbflag, "string");
		settype($sbInstancia, "string");
		settype($sbPipe, "string");
		settype($sbDbNull, "string");
		settype($nucont, "integer");
		settype($nuCant, "integer");
		settype($nuIndex, "integer");
		settype($nuFechaHora, "integer");
		$sbflag = true;
		//primero se pregunta por el indice que enlaza las tareas requeridas.
		$rctmp = $this->gatewaytareassincro->get_Tasiindice($ircdata["proccodigos"], $isbtareacodigos, $ircdata["tarecodigos"], $ircdata["rutaesactas"]);
		if ($rctmp) {
			//una vez obtenido el indice se consultan las demas tareas requeridas
			$sbtasitipsincsr = Application :: getConstant("TAREA_REQ");
			$sbtasitipsincso = Application :: getConstant("TAREA_OPC");
			$sbactaactiva = Application :: getConstant("ACTA_AC");
			$sbactafinalizada = Application :: getConstant("ACTA_FIN");
			$sbInstancia = Application :: getConstant("MAR_INS");
			$sbPipe = Application :: getConstant("PIPE");
			$sbDbNull = Application :: getConstant("DB_NULL");
			$nuFechaHora = $this->objdate->fncintdatehour();
			if ($rctmp[0]["tasitipsincs"] == $sbtasitipsincso) {
				$sbflag = false;
			} else {
				//si es requerida se crea el sql de recorrido nuevamente
				$nuIndex = $this->objtmp->fncgetByIdNumerador("recorrido");
				$ircRecorrido[0] = $this->gatewayrecorrido->addRecorridoSql($nuIndex, $ircdata["ordenumeros"], $isbActacodigos, $ircdata["actacodigos"], $sbtasitipsincsr, $sbInstancia, $nuFechaHora);
			}
			$rctmptr = $this->gatewaytareassincro->getByItasiindice($rctmp[0]["tasiindice"], $ircdata["tarecodigos"]);
			unset ($rctmp);
			if ($rctmptr) {
				$nuCant = sizeof($rctmptr);
				$nuIndex = $this->objtmp->fncgetByIdNumerador("recorrido", $nuCant);
				//si existen tareas requeridas se deben realizar dos preguntas
				//1.) Cual es el numero de acta para esa tarea
				//2,)Cual es el ultimo cambio de estado de esta acta		
				foreach ($rctmptr as $nucont => $rctmp) {
					if ($rctmp["tasitipsincs"] == $sbtasitipsincsr) {
						$orcresult[0][$nucont][0] = $this->gatewayacta->getActacodigosSql($ircdata["ordenumeros"], $rctmp["tasiacttareas"], $sbactaactiva, $sbactafinalizada);
						$orcresult[0][$nucont][1] = $this->gatewayactaestorden->getLastRecord();
						$orcresult[0][$nucont][2] = $rctmp;
						$orcresult[0][$nucont][3] = $this->gatewayrecorrido->addRecorridoSql($nuIndex, $ircdata["ordenumeros"], $isbActacodigos, $sbPipe, $sbtasitipsincsr, $sbDbNull, $nuFechaHora);
						$nuIndex ++;
					} else {
						if ($rctmp["tasitipsincs"] == $sbtasitipsincso) {
							$orcresult[2][$nucont][0] = $this->gatewayacta->getActacodigosSql($ircdata["ordenumeros"], $rctmp["tasiacttareas"], $sbactaactiva, $sbactafinalizada);
							$orcresult[2][$nucont][1] = $this->gatewayactaestorden->getLastRecord();
							$orcresult[2][$nucont][2] = $rctmp;
							$orcresult[2][$nucont][3] = $this->gatewayrecorrido->addRecorridoSql($nuIndex, $ircdata["ordenumeros"], $isbActacodigos, $sbPipe, $sbtasitipsincso, $sbDbNull, $nuFechaHora);
							$nuIndex ++;
						}
					}
				}
				$orcresult[1][0] = $sbflag;
				$orcresult[1][1] = $ircdata["tarecodigos"];
				$orcresult[3] = $ircRecorrido;
			}
		}
		return $orcresult;
	}
	//metodos para validar cambio de estado de las tareas
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Valida que el cambio de estado de la tarea sea valido
	*   @author freina
	*   @param string $isbproccodigos (Codigo de proceso que sigue el requerimiento)
	*   @param array $ircdataacta (Arreglo con la data del acta)
	*   @param array $ircdataactividad (Arreglo con la data de las actvidades registradas)
	*	@return array $orcresult ( [result] true si todo ok,: [result] false error,[detail] Dato con error)
	*   @date 27-Ago-2004 0108
	*   @location Cali-Colombia
	*/
	function fncvalcamesttarea($isbproccodigos, $ircdataacta, $ircdataactividad) {
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmpa, "array");
		$orcresult["result"] = true;
		//se evalua los datos del acta contra el estado
		$rctmp = $this->fncvaldatest($isbproccodigos, $ircdataacta);
		if ($rctmp["result"] == true) {
			//se validan las actividades que han de estar resueltas
			$rctmpa = $this->fncvalactterm($sbproccodigos, $ircdataacta, $ircdataactividad);
			if ($rctmpa["result"] == false) {
				$orcresult = $rctmpa;
			}
		} else {
			$orcresult = $rctmp;
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Valida que las actividades obligatorias de la tarea esten resueltas
	*   @author freina
	*   @param string $isbproccodigos (Codigo del proceso)
	*   @param array $ircdataacta (Arreglo con la data del acta)
	*   @param array $ircdataactividad (Arreglo con la data de las actividades de la tarea)
	*	@return array $orcresult ( [result] true si todo ok,: [result] false error,[activity] Codigos de actividades no resueltas)
	*   @date 27-Ago-2004 0108
	*   @location Cali-Colombia
	*/
	function fncvalactterm($isbproccodigos, $ircdataacta, $ircdataactividad) {
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmpar, "array");
		settype($rctmpc, "array");
		settype($sbactividadok, "string");
		settype($sbvalor, "string");
		settype($nucont, "integer");
		settype($nucant, "integer");
		$orcresult["result"] = true;
		$sbactividadok = Application :: getConstant("ACT_REA");
		//primero se obtienen las actividades obligatorias para cada tarea
		$rctmp = $this->fncobtactobl($isbproccodigos, $ircdataacta["tarecodigos"], $ircdataacta["actaestacts"], $ircdataacta["actaestants"]);
		if ($rctmp) {
			foreach ($ircdataactividad as $nucont => $rctmpar) {
				if ($rctmpar[1] == $sbactividadok) {
					$rctmpc[$nucontador] = $rctmpar[0];
					$nucontador ++;
				}
			}
			foreach ($rctmp as $nucont => $sbvalor) {
				if (!(in_array($sbvalor, $rctmpc))) {
					$orcresult["result"] = false;
					$orcresult["activity"][$nucant] = $sbvalor;
					$nucant ++;
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*  Obtiene los codigos de las actividades que deben ser resueltas
	*   @author freina
	*   @param string $isbproccodigos (Codigo del proceso)
	*   @param string $isbtarecodigos (Codigo de la tarea)
	*   @param string $isbvaliestacts (Codigo del estado propuesto para la tarea)
	*   @param string $isbvaliestants (Codigo del estadoactal de la tarea)
	*	@return array $orcresult ( Arreglo con el codigo de las actividades o null)
	*   @date 27-Ago-2004 0108
	*   @location Cali-Colombia
	*/
	function fncobtactobl($isbproccodigos, $isbtarecodigos, $isbvaliestacts, $isbvaliestants) {
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmpdet, "array");
		settype($nucont, "integer");
		$rctmp = $this->gatewayvalidacion->getRowValidacion($isbproccodigos, $isbtarecodigos, $isbvaliestacts, $isbvaliestants);
		if ($rctmp) {
			$gatewaydetallvalida = Application :: getDataGateway("detacttarestExtended");
			$rctmpdet = $gatewaydetallvalida->getByValicodigos($rctmp[0]["valicodigos"]);
			if ($rctmpdet) {
				foreach ($rctmpdet as $nucont => $rctmp) {
					$orcresult[$nucont] = $rctmp["acticodigos"];
				}
			}
		}
		return $orcresult;
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
	function fncvaldatest($isbproccodigos, $ircdata) {
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rctmp, "array");
		settype($sbvalor, "string");
		settype($sbresult, "string");
		settype($nucont, "integer");
		$orcresult["result"] = true;
		//se obtiene la configuracion de la validacion
		$rcresult = $this->fncobtconfval($isbproccodigos, $ircdata["tarecodigos"], $ircdata["actaestacts"]);
		if ($rcresult) {
			foreach ($rcresult as $nucont => $rctmp) {
				$sbvalor = $ircdata[$rctmp["nombcamp"]];
				if ($sbvalor) {
					$sbresult = $this->objtmpv->fnccompara($sbvalor, $rctmp["operador"], $rctmp["valor"]);
					if (!$sbresult === true) {
						$orcresult["result"] = false;
						$orcresult["detail"] = $rctmp["nombcamp"];
						break;
					}
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene  la configuracion de la validacion en la bd
	*   @author freina
	*   @param string $isbproccodigos (Codigo del proceso)
	*   @param string $isbtarecodigos (Codigo de la tarea)
	*   @param string $isbvaliestacts (Codigo del estado propuesto para la tarea)
	*   @param string $isbvaliestants (Codigo del estadoactal de la tarea)
	*	@return array or null (Arreglo con la data de configuracion de la validacion o null)
	*   @date 27-Ago-2004 0108
	*   @location Cali-Colombia
	*/
	function fncobtconfval($isbproccodigos, $isbtarecodigos, $isbvaliestacts) {
		settype($orcresult, "array");
		settype($gatewaydetallvalida, "object");
		settype($rctmp, "array");
		settype($rctmpdet, "array");
		settype($sbtabla, "string");
		settype($sborderby, "string");
		settype($nucont, "integer");
		$rctmp = $this->gatewayvalidacion->getRowValidacion($isbproccodigos, $isbtarecodigos, $isbvaliestacts);
		if ($rctmp) {
			$gatewaydetallvalida = Application :: getDataGateway("detallvalidaExtended");
			$sborderby = "devanomcams";
			$rctmpdet = $gatewaydetallvalida->getByIdOrderDetallvalida($rctmp[0]["valicodigos"], $sborderby);
			if ($rctmpdet) {
				foreach ($rctmpdet as $nucont => $rctmp) {
					$orcresult[$nucont]["nombcamp"] = $rctmp["devanomcams"];
					$orcresult[$nucont]["operador"] = $rctmp["devaoperados"];
					$orcresult[$nucont]["valor"] = $rctmp["devavalors"];
				}
			}
		}
		return $orcresult;
	}
	//metodos uitlizados para determinar el proceso a seguir de un requerimiento
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca el proceso a seguir comparando los datos del requerimiento y los de la base de datos
	*   @author freina
	*	@param array $ircdata (Arreglo con la data del requerimiento)
	*	@return string $osbproccodigos (Codigo del proceso o null)
	*   @date 30-Ago-2004 14:05
	*   @location Cali-Colombia
	*/
	function fncdecideproc($ircdata) {
		settype($rctmp, "array");
		settype($osbproccodigos, "string");
		if ($ircdata) {
			/*Consulta las configuraciones en la base de datos*/
			$rctmp = $this->fncconfigproces();
			if ($rctmp) {
				/*Busca el proceso de acurdo a los datos del req y la configuracion*/
				$rcProcesos = $this->fncproceso($ircdata, $rctmp);
			}
		}
		if (!is_array($rcProcesos))
			return null;
		//determina el proceso con mayor cantidad de coincidencias
		arsort($rcProcesos); //Orden descendente
		reset($rcProcesos);
		
		//Extrae la clave del primer elemento
		$rcKeys = array_keys($rcProcesos);
		return $rcKeys[0];
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Determina el proceso que seguira un requerimiento
	*   @author freina
	*	@param array $ircdata (Arreglo con la data del requerimiento)
	*	@param array $ircconfiguration (Arreglo con la data de configuracion)
	*	@return string $osbproccodigos (Codigo del proceso o null)
	*   @date 30-Ago-2004 14:05
	*   @location Cali-Colombia
	*/
	function fncproceso($ircdata, $ircconfiguration) {
		settype($rctmp, "array");
		settype($nuresult, "integer");
		foreach ($ircconfiguration as $rctmp) {
			$nuresult = $this->fncvaldatos($ircdata, $rctmp[1]);
			if ($nuresult)
				$rcProcesos[$rctmp[0]] = $nuresult;
		}
		return $rcProcesos;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida si la data del requerimiento encaja en alguna de las configuraciones existentes
	*   @author freina
	*	@param array $ircdata (Arreglo con la data del requerimiento)
	*	@param array $ircconfiguration (Arreglo con la data de configuracion)
	*	@return boolean  (true si encaja o false si no)
	*   @date 30-Ago-2004 14:05
	*   @location Cali-Colombia
	*/
	function fncvaldatos($ircdata, $ircconfiguration) {
		settype($rctmp, "array");
		settype($sbresult, "string");
		$aciertos = null;

		foreach ($ircconfiguration as $rctmp) {
			$sbresult = $this->objtmpv->fnccompara($ircdata[$rctmp["cacoprocedes"]], $rctmp["decooperados"], $rctmp["decovalors"]);
			if ($sbresult === false || $sbresult === null) {
				return 0;
			}
			$aciertos ++;
		}
		return $aciertos;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Consulta las configuraciones para determinar el proceso en la base de datos
	*   @author freina
	*	@param string $inucoprcodigon (Codigo de la configuracion)
	*	@return array $orcresult o  null (Arreglo con las configuraciones  o null en caso de que no haya registros)
	*	[n][0] = codigo del proceso
	*	[n][1] = matriz con los campos
	*	[n][0] = nombre del campo tal cual en la bd
	*	[n][1] = operador logico
	*	[n][2] = valor base
	*   @date 30-Ago-2004 11:08
	*   @location Cali-Colombia
	*/
	function fncconfigproces() {
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rctmp, "array");
		settype($objtmp, "object");
		settype($nucont, "integer");
		$objtmp = Application :: getDataGateway("Configproces");
		$rcresult = $objtmp->getAllConfigproces();
		if ($rcresult) {
			/*Hace la consulta de los campos de cada configuracion*/
			foreach ($rcresult as $rctmp) {
				$rctmpc = $this->fncselectcampos($rctmp["coprcodigon"]);
				if ($rctmpc) {
					$orcresult[$nucont][0] = $rctmp["proccodigos"];
					$orcresult[$nucont][1] = $rctmpc;
					$nucont ++;
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Seleciona los campos en la base de datos
	*   @author freina
	*	@param string $inucoprcodigon (Codigo de la configuracion)
	*	@return array $orcresult o  null (Arreglo con los campos a validar  o null en caso de que no haya registros)
	*		[n][0] = nombre del campo tal cual en la bd
	*		[n][1] = operador logico
	*		[n][2] = valor base
	*   @date 30-Ago-2004 11:08
	*   @location Cali-Colombia
	*/
	function fncselectcampos($inucoprcodigon) {
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rcrow, "array");
		settype($rctmp, "array");
		settype($objtmp, "object");
		settype($nucont, "integer");
		$objtmp = Application :: getDataGateway("SqlExtended");
		$rcresult = $objtmp->getByCoprcodigonLj($inucoprcodigon);
		if ($rcresult) {
			foreach ($rcresult as $nucont => $rcrow) {
				$rctmp = explode(".", $rcrow["cacoprocedes"]);
				if ($rctmp[1]) {
					$rcrow["cacoprocedes"] = $rctmp[1];
				} else {
					$rcrow["cacoprocedes"] = $rctmp[0];
				}
				$orcresult[$nucont] = $rcrow;
			}
		}
		return $orcresult;
	}
	//============ Reglas ===========
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Determina instancia y ejecuta reglas de acuerdo a un cambio de estado de una tarea 
	*   @author freina
	*	@param array $rcExec Arreglo con los id de rutas a los cuales se deben
	*	ejecutas las reglas
	*	@param array $rcData (Arreglo con la data que requieren los metodos )
	*	@return array or null (Arreglo con los resultados de los metodos )
	*   @date 04-Apr-2006 12:11
	*   @location Cali-Colombia
	*/
	function fncexecute_rules($rcExec, $rcData) {

		settype($objgatewayr, "object");
		settype($objGateway_RR, "object");
		settype($objgatewayf, "object");
		settype($objclasses, "object");
		settype($objtmp, "object");
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rctmp, "array");
		settype($rcTask, "array");
		settype($rctmpr, "array");
		settype($rctareas, "array");
		settype($rcTmp_RR, "array");
		settype($rcreglas, "array");
		settype($nucont, "integer");
		settype($nucant, "integer");

		if ($rcExec && $rcData) {

			//se instancia la compuerta de las reglas por tarea estado
			$objGateway_RR = Application :: getDataGateway("RutareglaExtended");
			
			//se determinan los nombres de las clases
			$objgatewayr = Application :: getDataGateway("Reglas");

			foreach ($rcExec as $rcTask) {

				$rcTmp_RR = $objGateway_RR->getByRutacodigon($rcTask["rutacodigon"]);

				if ($rcTmp_RR) {

					foreach ($rcTmp_RR as $nucont => $rctmp) {
						if ($rctmp["reglcodigos"]) {
							$rctmpr = $objgatewayr->getByIdReglas($rctmp["reglcodigos"]);
							$rcreglas[$nucant] = $rctmpr[0];
							$rcreglas[$nucant]["data_task"]=$rcTask;
							$nucant ++;
						}
					}
				}
			}
			$nucant = 0;
			
			//si existen reglas  a ejecutar se obtienen los metodos a instanciar
			if ($rcreglas) {
				$objgatewayf = Application :: getDataGateway("Funciones");
				foreach ($rcreglas as $nucont => $rctmp) {
					$rctmpr = $objgatewayf->getByFunciones_fkey($rctmp["reglcodigos"]);
					if ($rctmpr) {
						
						//se instancian las clases y se ejecutan los metodos
						$objtmp = Application :: loadServices("Cross300");
						$objclasses = $objtmp->InitiateClass($rctmp["regldescrips"]);
						
						//se completa la informacion de la regla con la data de la tarea
						$rcData["task"] = $rctmp["data_task"];
						$objclasses->setData($rcData);
						$objclasses->$rctmp["regldescrips"]();
						foreach ($rctmpr as $nucont => $rctmp) {
							$rcresult = $objclasses-> $rctmp["funcnombres"] ();
							$orcresult[$nucant]["method"] = $rcresult["method"];
							$orcresult[$nucant]["result"] = $rcresult["result"];
							$orcresult[$nucant]["type"] = $rcresult["type"];
							$orcresult[$nucant]["service"] = $rcresult["service"];
							$orcresult[$nucant]["parameters"] = $rcresult["parameters"];
							$orcresult[$nucant]["query"] = $rcresult["query"];
							$nucant ++;
						}
						$objtmp->close();
					}
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Calcula la fecha de incio y fin de uan tarea 
	*   @author freina<freina@parquesoft.com>
	*	@param string $sbOrdenumeros (Codigo del caso)
	*	@param string $sbTarecodigos (codigo de la tarea)
	*	@param float $nuRutaporcumn (porcentaje de tiempo)
	*	@param integer $nuDate (Fecha hora de ingreso al sistema de la tarea)
	*	@return array or null (Arreglo con los resultados de los metodos )
	*   @date 02-Nov-2010 12:11
	*   @location Cali-Colombia
	*/
	function getTaskTime($sbOrdenumeros, $sbTarecodigos, $nuRutaporcumn, $nuDate, $rcExtra){
		
		settype($objService,"object");
		settype($objGateway,"object");
		settype($objManager,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcRow,"array");
		settype($rcTmp,"array");
		settype($rcTask,"array");
		settype($rcTaskT,"array");
		settype($sbFlag,"string");
		settype($sbIndex,"string");
		settype($nuCont,"integer");
		settype($nuCantT,"integer");
		settype($nuLarger,"integer");
		settype($nuValue,"integer");
		settype($nuDateT,"integer");
		
		$sbFlag = false;//la tarea no ha sido instanciada
		
		if($sbOrdenumeros && $sbTarecodigos && $nuRutaporcumn && $nuDate && $rcExtra && is_array($rcExtra)){
				
			//se obtiene el tiempo total del proceso.
			$objGateway = Application :: getDataGateway("Proceso"); 
			$rcTmp = $objGateway->getByIdProceso($rcExtra["proccodigos"]);
			if($rcTmp && is_array($rcTmp)){
				$nuCantT = $rcTmp[0]["proctiempon"];
			}
			
			if($nuCantT){
				
				//se determina en entonces si ha habido reproceso
				
				$objGateway = Application :: getDataGateway("RecorridoExtended");
				$rcData = $objGateway->GetAllRecorridoByOrdenumeros($sbOrdenumeros);
				
				//si hay registros se inicia el analisis 
				if($rcData && is_array($rcData)){
					
					$objGateway = Application :: getDataGateway("Acta");
					$rcTmp = $objGateway->getByIdActa($rcData[0]["recoactpads"]);
					if($rcTmp && is_array($rcTmp)){
						$rcTmp = $rcTmp[0];
						$rcTask[$rcTmp["tarecodigos"]] = 1 ;
						$rcTaskT[$rcTmp["tarecodigos"]] = (int) $rcTmp["actafechingn"];
					}
					foreach($rcData as $rcTmp){
						$rcTmp["recofecingn"] = (int) $rcTmp["recofecingn"];
						if($rcTask[$rcTmp["tarecodigos"]]){
							$rcTask[$rcTmp["tarecodigos"]] ++;
						}else{
							$rcTask[$rcTmp["tarecodigos"]] = 1;
						}
						$rcTaskT[$rcTmp["tarecodigos"]] = $rcTmp["recofecingn"];
					}
				}
				
				//se valida la tarea actual
				if($rcTask[$sbTarecodigos]){
					$rcTask[$sbTarecodigos] ++ ;	
				}else{
					$rcTask[$sbTarecodigos] = 1;
				}
				
				$rcTaskT[$sbTarecodigos] = $nuDate ;
				
				//ahora se determina la tarea mas instanciada
				//primero se determina la cantidad mayor de veces que se ha instanciado una tarea.
				foreach($rcTask as $sbIndex=>$nuValue){
					if(($nuValue>1) && $nuValue>$nuLarger){
						$nuLarger = $nuValue;	
					}
				}
				
				//luego determinan las tareas que se han instanciado ese numero de veces
				unset($rcTmp);
				foreach($rcTask as $sbIndex=>$nuValue){
					if($nuValue==$nuLarger){
						$rcTmp[$nuCont] = $sbIndex;
						$nuCont++;		
					}
				}
				
				//por ultimo se determina la tarea con menor fecha de registro
				if($rcTmp && is_array($rcTmp)){
					$nuDateT = $nuDate;
					foreach($rcTmp as $sbIndex){
						if($rcTaskT[$sbIndex] < $nuDateT){
							$nuDateT = $rcTaskT[$sbIndex] ;		
						}
					}
					$sbFlag = true;	
					$nuDate = $nuDateT;
				}
				
				//segeneran las fechas
				$objService = Application::loadServices("General");
				$objManager = $objService->InitiateClass("DiasInhabilesManager");
				$rcResult = $objManager->getTaskTime($nuDate,$rcExtra["ordefecregd"], $rcExtra["ordefecvend"],$nuRutaporcumn,$nuCantT,$sbFlag);
				$objService->close();
			}
		}
		
		return $rcResult;
	}
}
?>