<?php
class FePrCampaignManager{
	function FePrCampaignManager(){
		$this->objGateway = Application::getDataGateway("campanha");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Crea la nueva campana en el sistema CRM
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function createCampaign(){

		settype($objGateway,"object");
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcSql,"array");
		settype($sbSynch,"string");
		settype($sbNoSynch,"string");
		settype($sbResult,"string");

		extract($this->rcData);
		//validemos las acciones a realizar

		//que examinamos lo que se desea hacer
		if(is_array($rcCampaign) && $rcCampaign){

			$this->_rcCampaign = $rcCampaign;

			//campanha sincronizada con el CRM
			$sbSynch = Application :: getConstant("REG_ACTIVE");
			$sbNoSynch = Application :: getConstant("REG_INACT");
			//se valida si la campanha ya fue sincronizada
			if($rcCampaign["campsyncs"]==$sbNoSynch){

				//se valida que este la informacion de personal

				if(is_array($rcEmployee) && $rcEmployee){

					$this->_rcEmployee = $rcEmployee;

					//se procede a crear el esquema
					$this->getSchema();
					//se crea los sql para la estructura de la organizacion
					$this->getHierarchy();

					//se crea los sql para asignar el proceso al lider
					$this->getProcess();

					//si viene info de campos diamicos
					if(is_array($rcConfig) && $rcConfig
					&& is_array($rcMaster) && $rcMaster
					&& is_array($rcDetail) && $rcDetail){

						//se crea los sql para el ingreso de datos dinamicos
						$this->_rcDF = array("rcConfig"=>$rcConfig,"rcMaster"=>$rcMaster,"rcDetail"=>$rcDetail);
						$this->getDF();
					}

					//finalmente se envia a la bd los sql obtenidos
					if(is_array($this->_rcSql) && $this->_rcSql && !$this->_sbError){

						//operacion a la bd
						$this->objGateway->setSql($this->_rcSql);
						$this->objGateway->executeTrans();
						$sbResult = $this->objGateway->getConsult();
						if($sbResult){
							//creacion de serializados.
							$this->setFiles();
							if(!$this->_sbError){
								$this->copyFiles();
								if(!$this->_sbError){
									$rcResult["result"] = true;
									$this->_sbError = 3;
									$this->getMessage();
									$rcResult["message"] = $this->sbMessage;
									$this->rcData = $this->_rcEmployee;
									$this->parseArray();
									$rcResult["rcEmployee"] = $this->sbResult;
									$rcResult["schema"] = $this->nuSchecodigon;
								}else{
									//se borra el esquema
									$objGateway = Application::getDataGateway("schema");
									$rcSql[] = $objGateway->getSqlDropSchema($this->sbSchemaName);
									$this->objGateway->setSql($rcSql);
									$this->objGateway->executeTrans();
									$sbResult = $this->objGateway->getConsult();
									$rcResult["result"] = false;
									$this->_sbError = 100;
									$this->getMessage();
									$rcResult["message"] = $this->sbMessage;
									$rcResult["rcEmployee"] = null;
									$rcResult["schema"] = null;
								}
							}else{
								//se borra el esquema
								$objGateway = Application::getDataGateway("schema");
								$rcSql[] = $objGateway->getSqlDropSchema($this->sbSchemaName);
								$this->objGateway->setSql($rcSql);
								$this->objGateway->executeTrans();
								$sbResult = $this->objGateway->getConsult();
								$rcResult["result"] = false;
								$this->_sbError = 100;
								$this->getMessage();
								$rcResult["message"] = $this->sbMessage;
								$rcResult["rcEmployee"] = null;
								$rcResult["schema"] = null;
							}	
						}else{
							$rcResult["result"] = false;
							$this->_sbError = 100;
							$this->getMessage();
							$rcResult["message"] = $this->sbMessage;
							$rcResult["rcEmployee"] = null;
							$rcResult["schema"] = null;
						}
					}else{
						$rcResult["result"] = false;
						$this->getMessage();
						$rcResult["message"] = $this->sbMessage;
						$rcResult["rcEmployee"] = null;
						$rcResult["schema"] = null;
					}
				}else{
					$rcResult["result"] = false;
					$this->_sbError = 21;
					$this->getMessage();
					$rcResult["message"] = $this->sbMessage;
					$rcResult["rcEmployee"] = null;
					$rcResult["schema"] = null;
				}

			}else{
				if($rcCampaign["campsyncs"]==$sbSynch && $rcCampaign["campscheman"]){
					//si esta sincronizada entonces se quiere sincronizar datos dinamicos
					if($rcCampaign["campsyncdfs"]==$sbNoSynch){
						
						//se procede a sincronizar los datos dinamicos
						$this->nuSchecodigon = $rcCampaign["campscheman"];
						
						//si viene info de campos dinamicos
						if(is_array($rcConfig) && $rcConfig
						&& is_array($rcMaster) && $rcMaster
						&& is_array($rcDetail) && $rcDetail){
							
							//se obtiene el sql de cambio de esquema
							//se obtiene el servicio de profiles
							$objService = Application :: loadServices("Profiles");
							$objGateway = $objService->getGateWay("schema");
							$objGateway->setExecuteSql(false);
							$this->sbSchemaName = Application::getConstant("SUFIJO_SCHEMA").$this->nuSchecodigon;
							$objGateway->setData(array("schenombres"=>$this->sbSchemaName));
							$objGateway->setSchema();
							$this->_rcSql = $objGateway->getSql();
							$objService->close();
							
							//se crea los sql para el ingreso de datos dinamicos
							$this->_rcDF = array("rcConfig"=>$rcConfig,"rcMaster"=>$rcMaster,"rcDetail"=>$rcDetail);
							$this->getDF();
						}

						//finalmente se envia a la bd los sql obtenidos
						if(is_array($this->_rcSql) && $this->_rcSql && !$this->_sbError){
							
							//operacion a la bd
							$this->objGateway->setSql($this->_rcSql);
							$this->objGateway->executeTrans();
							$sbResult = $this->objGateway->getConsult();
							
							if($sbResult){
								$rcResult["result"] = true;
								$this->_sbError = 3;
								$this->getMessage();
								$rcResult["message"] = $this->sbMessage;
								$rcResult["rcEmployee"] = null;
								$rcResult["schema"] = null;
							}else{
								$rcResult["result"] = false;
								$this->_sbError = 100;
								$this->getMessage();
								$rcResult["message"] = $this->sbMessage;
								$rcResult["rcEmployee"] = null;
								$rcResult["schema"] = null;	
							}
						}else{
							$rcResult["result"] = false;
							$this->getMessage();
							$rcResult["message"] = $this->sbMessage;
							$rcResult["rcEmployee"] = null;
							$rcResult["schema"] = null;
						}
					}else{
						$rcResult["result"] = false;
						$this->_sbError = 100;
						$this->getMessage();
						$rcResult["message"] = $this->sbMessage;
						$rcResult["rcEmployee"] = null;
						$rcResult["schema"] = null;
					}
				}else{
					$rcResult["result"] = false;
					$this->_sbError = 100;
					$this->getMessage();
					$rcResult["message"] = $this->sbMessage;
					$rcResult["rcEmployee"] = null;
					$rcResult["schema"] = null;
				}
			}

		}else{
			$rcResult["result"] = false;
			$this->_sbError = 18;
			$this->getMessage();
			$rcResult["message"] = $this->sbMessage;
		}

		$this->rcResult = $rcResult;
		return;
	}

	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false)
			unset ($_REQUEST[$sbKey]);
		}
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene los sql de creacion del esquema
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSchema(){

		settype($objService,"object");
		settype($objGateway,"object");
		settype($objManager,"object");
		settype($rcSql,"array");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($rcSchema,"array");
		settype($rcData,"array");
		settype($rcRow,"array");
		settype($rcPermisions,"array");
		settype($sbWebUser,"string");
		settype($sbValue,"string");
		settype($sbUser,"string");
		settype($sbLang,"string");
		settype($sbApp,"string");
		settype($sbStyle,"string");
		settype($sbLider,"string");
		settype($sbPRL,"string");
		settype($sbPRA,"string");
		settype($sbProfcodigos,"string");
		settype($sbNewSchema,"string");
		settype($nuCont,"integer");

		if($this->_rcCampaign["campvicidids"]){
			//se obtiene el servicio de profiles
			$objService = Application :: loadServices("Profiles");

			//se obtiene el manager de los esquemas
			$objGateway = $objService->getGateWay("schema");

			//se obtiene el id
			$objManager = Application :: getDomainController('NumeradorManager');
			$this->nuSchecodigon = $objManager->fncgetByIdNumerador('schema');

			$objManager =  $objService->loadManager("SchemaManager");
			$rcSchema = $objManager->getSchema();

			if(is_array($rcSchema) && $rcSchema){

				$sbLang = Application :: getSingleLang();
				$sbApp = Application :: getConstant("DEFAULT_APP");
				$sbStyle = Application :: getConstant("DEFAULT_STYLE");
				$sbPRL = Application :: getConstant("PROFILES_LEADER");
				$sbPRA = Application :: getConstant("PROFILES_AGENT");

				$rcSchema = $rcSchema[0];
				$objGateway->setExecuteSql(false);
				$this->sbSchemaName = Application::getConstant("SUFIJO_SCHEMA").$this->nuSchecodigon;
				$objGateway->createSchema($this->nuSchecodigon);
				$objGateway->setData(array("schenombres"=>"profiles"));
				$objGateway->setSchema();
				$objGateway->addSchema($this->nuSchecodigon, $this->_rcCampaign["campvicidids"], $rcSchema["schedbusers"], $rcSchema["schedbkeys"], null);
				$rcSql = $objGateway->getSql();

				$rcPermisions = Application :: getConstant("PERMISIONS");
				//se crean los permisos del esquema
				$objGateway = $objService->getGateWay("permisions");
				$objGateway->setExecuteSql(false);
				if(is_array($rcPermisions[$sbPRL]) && $rcPermisions[$sbPRL]){
					foreach($rcPermisions[$sbPRL] as $nuCont=>$sbValue){
						$objGateway->addPermisions($this->nuSchecodigon, $sbPRL, $sbApp, $sbValue);
					}
				}else{
					$this->_sbError = 20;
				}
				if(is_array($rcPermisions[$sbPRA]) && $rcPermisions[$sbPRA]){
					foreach($rcPermisions[$sbPRA] as $nuCont=>$sbValue){
						$objGateway->addPermisions($this->nuSchecodigon, $sbPRA, $sbApp, $sbValue);
					}
				}else{
					$this->_sbError = 20;
				}
				$rcTmp = $objGateway->getSql();

				if(is_array($rcSql) && $rcSql ){
					if(is_array($rcTmp) && $rcTmp){
						$rcSql = array_merge($rcSql,$rcTmp);
					}
				}else{
					if(is_array($rcTmp) && $rcTmp){
						$rcSql = $rcTmp;
					}
				}

				//se crean los usuarios del sistema
				if(is_array($this->_rcEmployee) && $this->_rcEmployee){
					$rcData = $this->_rcEmployee;
					foreach($rcData as $nuCont=>$rcTmp){
						$rcUser[] = $rcTmp["user"] ;
					}
					$this->_rcEmployee = $rcData;
				}else{
					$this->_sbError = 21;
				}

				//si hay usuarios entonces creemos los registros
				if(is_array($rcData) && $rcData){

					//determina al lider
					$sbLider = Application :: getConstant("REG_ACT");

					$objGateway = $objService->getGateWay("auth");
					$objGateway->setExecuteSql(false);
					foreach($rcData as $nuCont=>$rcRow){
						$sbProfcodigos = $sbPRA;
						if($rcRow["decaliders"]==$sbLider){
							$sbProfcodigos = $sbPRL;
						}
						if($objGateway->existAuth($rcRow["user"])==0){
							$objGateway->addAuth($rcRow["user"],$rcRow["user"],$rcRow["name"],$rcRow["lastname1"],$rcRow["lastname2"]
							,$rcRow["email"],$sbApp,$sbStyle,$sbLang,$sbProfcodigos);
						}
						
					}
					$rcTmp = $objGateway->getSql();
					
					if(is_array($rcSql) && $rcSql ){
						if(is_array($rcTmp) && $rcTmp){
							$rcSql = array_merge($rcSql,$rcTmp);
						}
					}else{
						if(is_array($rcTmp) && $rcTmp){
							$rcSql = $rcTmp;
						}
					}
				}else{
					$this->_sbError = 21;
				}

				//se obtiene el ususario web
				$sbWebUser = Application :: getConstant("WEB_USER");
				if($sbWebUser){
					$rcUser[] = $sbWebUser;
				}
				//registros de authschema
				if(is_array($rcUser) && $rcUser){

					$objGateway = $objService->getGateWay("authschema");
					$objGateway->setExecuteSql(false);
					foreach($rcUser as $nuCont=>$sbValue){
						$objGateway->addAuthschema($sbValue,$this->nuSchecodigon);
					}
					$rcTmp = $objGateway->getSql();

					if(is_array($rcSql) && $rcSql ){
						if(is_array($rcTmp) && $rcTmp){
							$rcSql = array_merge($rcSql,$rcTmp);
						}
					}else{
						if(is_array($rcTmp) && $rcTmp){
							$rcSql = $rcTmp;
						}
					}
				}else{
					$this->_sbError = 22;
				}

				//por ultimo se cambia al esquema nuevo
				$objGateway = $objService->getGateWay("schema");
				$objGateway->setExecuteSql(false);
				$sbNewSchema = Application::getConstant("SUFIJO_SCHEMA").$this->nuSchecodigon;
				$objGateway->setData(array("schenombres"=>$sbNewSchema));
				$objGateway->setSchema();
				$rcTmp = $objGateway->getSql();
				if(is_array($rcSql) && $rcSql ){
					if(is_array($rcTmp) && $rcTmp){
						$rcSql = array_merge($rcSql,$rcTmp);
					}
				}else{
					if(is_array($rcTmp) && $rcTmp){
						$rcSql = $rcTmp;
					}
				}
			}else{
				$this->_sbError = 19;
			}
			$objService->close();
		}else{
			$this->_sbError = 18;
		}

		$this->_rcSql = $rcSql;
		return;

	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene los sql de creacion de la organizacion
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getHierarchy(){

		settype($objService,"object");
		settype($objDate,"object");
		settype($objGateway,"object");
		settype($objGateway_D,"object");
		settype($rcSql,"array");
		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($sbLider,"string");
		settype($sbName,"string");
		settype($sbStatus,"string");
		settype($sbOrgacgpads,"string");
		settype($nuCont,"integer");
		settype($nuContG,"integer");
		settype($nuDate,"integer");

		//contador para los grupos.
		$nuContG = 2;

		if(is_array($this->_rcEmployee) && $this->_rcEmployee){
			$rcData = $this->_rcEmployee;
			//Carga el sevicio de Fechas
			$objDate = Application :: loadServices("DateController");
			$nuDate = $objDate->fncintdatehour();
			
			//se obtiene el servicio de recursos humanos
			$objService = Application :: loadServices("Profiles");
			//se determina el lider que sera el primero en la organizacion.
			$sbLider = Application :: getConstant("REG_ACTIVE");
			$sbStatus = $sbLider;
			$objService->close();
			
			//se obtiene el servicio de recursos humanos
			$objService = Application :: loadServices("Human_resources");
			
			//se obtiene el gateway de personal
			$objGateway = $objService->getGateWay("personal");
			$objGateway->setExecuteSql(false);
			foreach($rcData as $nuCont=> $rcRow){
				$objGateway->addPersonal($rcRow["id"], $rcRow["id"], $rcRow["name"], $rcRow["lastname1"],
				$rcRow["lastname2"], $rcRow["user"], NULL, NULL, $rcRow["tel1"], $rcRow["tel2"], NULL, NULL,
				$rcRow["email"], NULL, NULL, $sbStatus);
				if($rcRow["leader"]==$sbLider){
					$this->sbIdLider = $rcRow["id"];
				}
			}
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//se obtiene el gateway de grupo y detalle
			$objGateway = $objService->getGateWay("grupo");
			$objGateway_D = $objService->getGateWay("grupodetalle");
			$objGateway->setExecuteSql(false);
			$objGateway_D->setExecuteSql(false);
			foreach($rcData as $nuCont=> $rcRow){
				$sbName = trim($rcRow["name"]." ".$rcRow["lastname1"]." ".$rcRow["lastname2"]);
				$objGateway->addGrupo($nuContG,$rcRow["id"],$sbName,'01',$nuDate,NULL);
				$objGateway_D->addGrupodetalle($nuContG,$rcRow["id"],"S");
				$nuContG++;
			}
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//detalle de grupo
			$rcTmp = $objGateway_D->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//se obtiene el gateway de organizacion
			$objGateway = $objService->getGateWay("organizacion");
			$objGateway->setExecuteSql(false);
			foreach($rcData as $nuCont=> $rcRow){
				$sbName = trim($rcRow["name"]." ".$rcRow["lastname1"]." ".$rcRow["lastname2"]);
				$sbOrgacgpads = $this->sbIdLider;
				if($this->sbIdLider==$rcRow["id"]){
					$sbOrgacgpads = null;
				}
				$objGateway->addOrganizacion($rcRow["id"], $sbName, NULL,$sbOrgacgpads, 0, $nuDate,
				"01", $rcRow["id"], $rcRow["tel1"],$rcRow["tel2"], NULL);
			}
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//finalmente actualizamos el numerador de los grupos
			$objGateway = $objService->getGateWay("numeradorExtended");
			$objGateway->setExecuteSql(false);
			$objGateway->setData(array("numeproximon"=>$nuContG,"numecodigos"=>"codgrupo"));
			$objGateway->setNumerador();
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			$objService->close();

		}else{
			$this->_sbError = 21;
		}
		
		//resumen
		if(is_array($this->_rcSql) && $this->_rcSql ){
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = array_merge($this->_rcSql,$rcSql);
			}
		}else{
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = $rcSql;
			}
		}
		return ;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene los sql de los datos dimamicos.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDF(){

		settype($objService,"object");
		settype($objGateway,"object");
		settype($rcSql,"array");
		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($nuCont,"integer");
		settype($nuContD,"integer");
		settype($nuContCD,"integer");

		//contador para los grupos.
		$nuContD = 2;
		$nuContCD = 2;
		extract($this->_rcDF);

		if(is_array($rcConfig) && $rcConfig && is_array($rcMaster) && $rcMaster
		&& is_array($rcDetail) && $rcDetail){

			//se obtiene el servicio de profiles
			$objService = Application :: loadServices("General");

			//se obtiene el gateway de personal
			$objGateway = $objService->getGateWay("dimension");
			$objGateway->setExecuteSql(false);

			if(is_array($rcMaster) && $rcMaster){
				foreach($rcMaster as $nuCont=> $rcRow){
					$rcData[$rcRow["dimecodigon"]] = $nuContD;
					$rcRow["dimecodigon"] = $nuContD;
					$objGateway->setData($rcRow);
					$objGateway->addDimension();
					$nuContD ++;
				}
			}else{
				$this->_sbError = 24;
			}

			if(is_array($rcConfig) && $rcConfig){
				foreach($rcConfig as $nuCont=> $rcRow){
					$rcRow["dimecodigon"] = $rcData[$rcRow["dimecodigon"]];
					$rcRow["codicodigon"] = $nuContCD;
					$rcRow["codidomivals"] = 1; //proceso 1
					$objGateway->setData($rcRow);
					$objGateway->addConfigdimension();
					$nuContCD ++;
				}
			}else{
				$this->_sbError = 24;
			}

			if(is_array($rcDetail) && $rcDetail){
				foreach($rcDetail as $nuCont=> $rcRow){
					$rcRow["dimecodigon"] = $rcData[$rcRow["dimecodigon"]];
					$objGateway->setData($rcRow);
					$objGateway->addDetalledimens();
				}
			}else{
				$this->_sbError = 24;
			}
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//finalmente actualizamos el numerador de los grupos
			$objGateway = $objService->getGateWay("numeradorExtended");
			$objGateway->setExecuteSql(false);
			$objGateway->setData(array("numeproximon"=>$nuContD,"numecodigos"=>"dimension"));
			$objGateway->setNumerador();
			$objGateway->setData(array("numeproximon"=>$nuContCD,"numecodigos"=>"configdimension"));
			$objGateway->setNumerador();
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			$objService->close();

		}else{
			$this->_sbError = 24;
		}

		//resumen
		if(is_array($this->_rcSql) && $this->_rcSql ){
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = array_merge($this->_rcSql,$rcSql);
			}
		}else{
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = $rcSql;
			}
		}
		return ;
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene los sql de modificacion de encargado del proceso.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getProcess(){

		settype($objService,"object");
		settype($objGateway,"object");
		settype($rcSql,"array");
		settype($rcTmp,"array");

		//contador para los grupos.

		if(isset($this->sbIdLider) && $this->sbIdLider){

			//se obtiene el servicio de workflow
			$objService = Application :: loadServices("Workflow");

			//se obtiene el gateway de proceso
			$objGateway = $objService->getGateWay("proceso");
			$objGateway->setExecuteSql(false);
			$objGateway->setData(array("orgacodigos"=>$this->sbIdLider));
			$objGateway->setOrgacodigos();
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			//se obtiene el gateway de tarea
			$objGateway = $objService->getGateWay("tarea");
			$objGateway->setExecuteSql(false);
			$objGateway->setData(array("orgacodigos"=>$this->sbIdLider));
			$objGateway->setOrgacodigos();
			$rcTmp = $objGateway->getSql();

			//temporal
			if(is_array($rcSql) && $rcSql ){
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = array_merge($rcSql,$rcTmp);
				}
			}else{
				if(is_array($rcTmp) && $rcTmp){
					$rcSql = $rcTmp;
				}
			}

			$objService->close();

		}else{
			$this->_sbError = 23;
		}

		//resumen
		if(is_array($this->_rcSql) && $this->_rcSql ){
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = array_merge($this->_rcSql,$rcSql);
			}
		}else{
			if(is_array($rcSql) && $rcSql){
				$this->_rcSql = $rcSql;
			}
		}
		return ;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * actualiza los serializados
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setFiles(){

		settype($objManager,"object");
		settype($objService,"object");
		settype($rcSchema,"object");
		settype($rcModules,"array");
		settype($rcTmp,"array");
		settype($sbResult,"string");
		settype($sbIndex,"string");
		settype($sbFile,"string");

		if(isset($this->nuSchecodigon) && $this->nuSchecodigon
		&& is_array($this->_rcCampaign) && $this->_rcCampaign){

			//primero se actualiza el archivo que almacena el esquema
			$objManager = Application :: getDomainController('SchemaManager');
			$rcSchema = $objManager->getSchema();

			if(is_array($rcSchema)& $rcSchema){
				$rcSchema[$this->nuSchecodigon] = array ('schenombres' => $this->_rcCampaign["campvicidids"],
				'schedbusers' => $rcSchema[0]["schedbusers"], 'schedbkeys' => $rcSchema[0]["schedbkeys"]);
				$sbResult = $objManager->setSchema($rcSchema);
				
				if($sbResult){
					//se modifican los serializados del los modulos.
					$objService = Application :: loadServices("SchemaAdministrator");

					//se crea el esquema en los serializados de los diferentes modulos
					$rcModules = Application :: getConstant("MODULES");//modulos del sistema

					if(is_array($rcModules) && $rcModules){
						
						foreach ($rcModules as $sbIndex => $rcTmp){
							$objService->setModule($sbIndex);
							$objService->loadModule();
							$objService->setId($this->nuSchecodigon);
							foreach ($rcTmp as $sbFile){
								
								$objService->setNameFile($sbFile);
								$sbResult = $objService->addData();
								if (!$sbResult){
									$objService->close();
									break 2;
								}
							}
							$objService->close();
						}
						if(!$sbResult){
							$this->_sbError = 27;
							//se actualiza el archivo de esquemas
							unset($rcSchema[$this->nuSchecodigon]);
							$sbResult = $objManager->setSchema($rcSchema);
							if(!$sbResult){
								$this->_sbError = 25;
							}
						}
					}else{
						$this->_sbError = 26;
					}
				}else{
					$this->_sbError = 25;
				}
			}else{
				$this->_sbError = 19;
			}
		}else{
			$this->_sbError = 18;
		}
		return;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * devuelve el mensaje
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getMessage(){
		
		settype($rcUser,"array");
		
		if(isset($this->_sbError) && $this->_sbError){
			
			//Trae los datos del usuario
			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			include_once ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");	
			
			$this->sbMessage = urlencode(trim($rcmessages[$this->_sbError]));
		}
		return;
	}
	
	/**
    * codifica los datos del arreglo
    * @access private
    * @author freina<freina@parquesoft.com>
    * @version 1.0
    */
    function parseArray(){
		
    	settype($rcResult, "array");
    	settype($rcTmp, "array");
    	settype($sbIndex, "string");
    	settype($sbValue, "string");
    	settype($nuIndex, "integer");
    	
    	if(is_array($this->rcData) && $this->rcData){
    		
    		foreach($this->rcData as $nuIndex=>$rcTmp){

    			foreach($rcTmp as $sbIndex=>$sbValue){
    				$rcTmp[$sbIndex] = urlencode(trim($sbValue));
    			}
    			
    			$rcResult[$nuIndex]= $rcTmp;
    		}
    	}
    	
    	$this->sbResult = urlencode(serialize($rcResult));
    	return;
    }
    
    /**
    * crea los archivos de perfil para los usuarios a partir de una plantilla
    * @access private
    * @author freina<freina@parquesoft.com>
    * @version 1.0
    */
    function copyFiles(){
    	
    	settype($sbPRL,"string");
    	settype($sbPRA,"string");
    	settype($sbPath,"string");
    	settype($sbPath1,"string");
    	settype($sbPath2,"string");
    	settype($sbResult,"string");
    	
    	if(isset($this->nuSchecodigon) && $this->nuSchecodigon){
    		//codigo de las plantillas
    		$sbPRL = Application :: getConstant("PROFILES_LEADER");
			$sbPRA = Application :: getConstant("PROFILES_AGENT");
			
			//Path del modulo
			$sbPath = Application :: getBaseDirectory();
			//Path del Xml
			$sbPath .= "/config/profiles";
			
			if((file_exists ($sbPath."/".$sbPRL.".xml")) 
			&& (file_exists ($sbPath."/".$sbPRA.".xml"))){
				
				if(is_writable  ($sbPath)){
					
					$sbPath1 = $sbPath."/".$this->nuSchecodigon."_".$sbPRL.".xml";
					$sbResult = copy  ( $sbPath."/".$sbPRL.".xml", $sbPath1);
					if(!$sbResult){
						$this->_sbError = 28;
						return;
					}
					$sbPath2 = $sbPath."/".$this->nuSchecodigon."_".$sbPRA.".xml";
					$sbResult = copy  ( $sbPath."/".$sbPRA.".xml", $sbPath2);
					if(!$sbResult){
						unlink($sbPath1);
						$this->_sbError = 28;
						return;
					}
				}else{
					$this->_sbError = 28;
				}
			}else{
				$this->_sbError = 28;
			}
    	}else{
    		$this->_sbError = 28;
    	}
    	return;
    }
    
    /**
    * obtiene el schema a partir de la campaña del vicidial
    * @access private
    * @author mrestrepo<mrestrepo@parquesoft.com>
    * @version 1.0
    */
    function getContextFromCamp() {
    	
    	$gateway = Application::getDataGateway("schema");
    	$rcTmp = $gateway->getSqlSchecodigonByNombre($this->rcData["camp"]);
    	if(!is_array($rcTmp))
    		$this->rcResult = false;
    	$this->rcResult = $rcTmp[0]["schecodigon"];
    }
}
?>