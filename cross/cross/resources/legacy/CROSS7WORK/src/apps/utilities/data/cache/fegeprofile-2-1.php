<?php
class FeGeProfile_2_1 {
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Pinta el menu de la aplicacion
	*	@author freina <freina@parquesoft>
	*   @date 18-Dic-2004 16:10 
	*	@location Cali-Colombia
	*/
	function printmenu() {
		settype($objArbol, "object");
         settype($objService, "object");
		settype($rctmp, "array");
         settype($rclabels, "array");
		settype($rcuser, "array");
		settype($rctmpf, "array");
		settype($rctmps, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nuindicef, "integer");
		settype($nuindices, "integer");

		include_once ('HTML_Menu.php');
		
		//Obtiene los datos del usuario
		$rcuser = Application::getUserParam();
		if(!is_array($rcuser)){
			//Si no existe usuario en sesion 
			$rcuser["lang"] = Application::getSingleLang();
		}
         
          //Se obtiene el arreglo con los labels
          $objService = Application :: loadServices("Profiles");
          $rclabels = $objService->getMetaProfilesLabels($rcuser["lang"]);
	
		$objArbol = new HTML_TreeMenu("menuLayer1", 'web/images/menu');
	
		$rcnode[]=array("son"=>"cross", "father"=>"");
	$rcnode[]=array("son"=>"general", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_del_sistema", "father"=>"general");
	$rcnode[]=array("son"=>"FeGeCmdDefaultAuth", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultParametros", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultPermisosEntes", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultPermisosPersonal", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultDatosAdicionalesWeb", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultDiasInhabiles", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultNuevaDescripcion", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultTransferDependencies", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"FeGeCmdDefaultRelacionTarea_Persona", "father"=>"configuracion_del_sistema");
	$rcnode[]=array("son"=>"utilidades", "father"=>"general");
	$rcnode[]=array("son"=>"FeGeCmdDefaultCentroComunicacion", "father"=>"utilidades");
	$rcnode[]=array("son"=>"FeGeCmdDefaultFormatocarta", "father"=>"utilidades");
	$rcnode[]=array("son"=>"localizacion", "father"=>"general");
	$rcnode[]=array("son"=>"FeGeCmdDefaultTipolocaliza", "father"=>"localizacion");
	$rcnode[]=array("son"=>"FeGeCmdDefaultLocalizacion", "father"=>"localizacion");
	$rcnode[]=array("son"=>"workflow", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_workflow", "father"=>"workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultTarea", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultActividad", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultActivitarea", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultEstadoacta", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultEstadotarea", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"FeWFCmdDefaultProceso", "father"=>"configuracion_workflow");
	$rcnode[]=array("son"=>"customers", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_customers", "father"=>"customers");
	$rcnode[]=array("son"=>"FeCuCmdDefaultTipoidentifi", "father"=>"configuracion_customers");
	$rcnode[]=array("son"=>"FeCuCmdDefaultGruposinteres", "father"=>"configuracion_customers");
	$rcnode[]=array("son"=>"registro_customers", "father"=>"customers");
	$rcnode[]=array("son"=>"FeCuCmdDefaultCliente", "father"=>"registro_customers");
	$rcnode[]=array("son"=>"FeCuCmdDefaultContacto", "father"=>"registro_customers");
	$rcnode[]=array("son"=>"cross300", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_cross", "father"=>"cross300");
	$rcnode[]=array("son"=>"FeCrCmdDefaultTipoorden", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultEvento", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultCausa", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultMediorecepcion", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultPrioridad", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultCompromiso", "father"=>"configuracion_cross");
	$rcnode[]=array("son"=>"registro_cross", "father"=>"cross300");
	$rcnode[]=array("son"=>"FeCrCmdDefaultOrden", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultAdminTareas", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultRevertPerformance", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultSolucion", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultSeguimiento", "father"=>"registro_cross");
	$rcnode[]=array("son"=>"reportes_cross", "father"=>"cross300");
	$rcnode[]=array("son"=>"FeCrCmdDefaultFichaOrd", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultRepoTiemposEjec", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultListadoOrden", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultConsolidado", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultDetallado", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultActuareq", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultConsultSolucion", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultReportsCenter", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultIndoprequre", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultPursuit_Report", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"FeCrCmdDefaultDetail_Pursuit_Report", "father"=>"reportes_cross");
	$rcnode[]=array("son"=>"human_resources", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_human", "father"=>"human_resources");
	$rcnode[]=array("son"=>"FeHrCmdDefaultEstadoorgani", "father"=>"configuracion_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultTipoorgani", "father"=>"configuracion_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultEstadogrupo", "father"=>"configuracion_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultCargo", "father"=>"configuracion_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultPhysicalDependencies", "father"=>"configuracion_human");
	$rcnode[]=array("son"=>"registro_human", "father"=>"human_resources");
	$rcnode[]=array("son"=>"FeHrCmdDefaultOrganizacion", "father"=>"registro_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultPersonal", "father"=>"registro_human");
	$rcnode[]=array("son"=>"FeHrCmdDefaultGrupo", "father"=>"registro_human");
	$rcnode[]=array("son"=>"schedule", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_schedule", "father"=>"schedule");
	$rcnode[]=array("son"=>"FeScCmdDefaultCategoria", "father"=>"configuracion_schedule");
	$rcnode[]=array("son"=>"registro_schedule", "father"=>"schedule");
	$rcnode[]=array("son"=>"FeScCmdDefaultDayview", "father"=>"registro_schedule");
	$rcnode[]=array("son"=>"reportes_schedule", "father"=>"schedule");
	$rcnode[]=array("son"=>"FeScCmdShowListSchedule", "father"=>"reportes_schedule");
	$rcnode[]=array("son"=>"encuestas", "father"=>"cross");
	$rcnode[]=array("son"=>"configuracion_encuestas", "father"=>"encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultEjetematico", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultTema", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultModeloresp", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultPregunta", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultOpcionrepues", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultFormulario", "father"=>"configuracion_encuestas");
	$rcnode[]=array("son"=>"registro_encuestas", "father"=>"encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultEncuesta", "father"=>"registro_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultConfigEncuesta", "father"=>"registro_encuestas");
	$rcnode[]=array("son"=>"reportes_encuestas", "father"=>"encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultReport", "father"=>"reportes_encuestas");
	$rcnode[]=array("son"=>"FeEnCmdDefaultIndicador", "father"=>"reportes_encuestas");
	$cross = new HTML_TreeNode($rclabels["cross"],"");
	$general = new HTML_TreeNode($rclabels["general"],"");
	$configuracion_del_sistema = new HTML_TreeNode($rclabels["configuracion_del_sistema"],"");
	$FeGeCmdDefaultAuth = new HTML_TreeNode($rclabels["FeGeCmdDefaultAuth"],"javascript:fncLoadCmd(\'FeGeCmdDefaultAuth\',\'general\')");
	$FeGeCmdDefaultParametros = new HTML_TreeNode($rclabels["FeGeCmdDefaultParametros"],"javascript:fncLoadCmd(\'FeGeCmdDefaultParametros\',\'general\')");
	$FeGeCmdDefaultPermisosEntes = new HTML_TreeNode($rclabels["FeGeCmdDefaultPermisosEntes"],"javascript:fncLoadCmd(\'FeGeCmdDefaultPermisosEntes\',\'general\')");
	$FeGeCmdDefaultPermisosPersonal = new HTML_TreeNode($rclabels["FeGeCmdDefaultPermisosPersonal"],"javascript:fncLoadCmd(\'FeGeCmdDefaultPermisosPersonal\',\'general\')");
	$FeGeCmdDefaultDatosAdicionalesWeb = new HTML_TreeNode($rclabels["FeGeCmdDefaultDatosAdicionalesWeb"],"javascript:fncLoadCmd(\'FeGeCmdDefaultDatosAdicionalesWeb\',\'general\')");
	$FeGeCmdDefaultDiasInhabiles = new HTML_TreeNode($rclabels["FeGeCmdDefaultDiasInhabiles"],"javascript:fncLoadCmd(\'FeGeCmdDefaultDiasInhabiles\',\'general\')");
	$FeGeCmdDefaultNuevaDescripcion = new HTML_TreeNode($rclabels["FeGeCmdDefaultNuevaDescripcion"],"javascript:fncLoadCmd(\'FeGeCmdDefaultNuevaDescripcion\',\'general\')");
	$FeGeCmdDefaultTransferDependencies = new HTML_TreeNode($rclabels["FeGeCmdDefaultTransferDependencies"],"javascript:fncLoadCmd(\'FeGeCmdDefaultTransferDependencies\',\'general\')");
	$FeGeCmdDefaultRelacionTarea_Persona = new HTML_TreeNode($rclabels["FeGeCmdDefaultRelacionTarea_Persona"],"javascript:fncLoadCmd(\'FeGeCmdDefaultRelacionTarea_Persona\',\'general\')");
	$utilidades = new HTML_TreeNode($rclabels["utilidades"],"");
	$FeGeCmdDefaultCentroComunicacion = new HTML_TreeNode($rclabels["FeGeCmdDefaultCentroComunicacion"],"javascript:fncLoadCmd(\'FeGeCmdDefaultCentroComunicacion\',\'general\')");
	$FeGeCmdDefaultFormatocarta = new HTML_TreeNode($rclabels["FeGeCmdDefaultFormatocarta"],"javascript:fncLoadCmd(\'FeGeCmdDefaultFormatocarta\',\'general\')");
	$localizacion = new HTML_TreeNode($rclabels["localizacion"],"");
	$FeGeCmdDefaultTipolocaliza = new HTML_TreeNode($rclabels["FeGeCmdDefaultTipolocaliza"],"javascript:fncLoadCmd(\'FeGeCmdDefaultTipolocaliza\',\'general\')");
	$FeGeCmdDefaultLocalizacion = new HTML_TreeNode($rclabels["FeGeCmdDefaultLocalizacion"],"javascript:fncLoadCmd(\'FeGeCmdDefaultLocalizacion\',\'general\')");
	$workflow = new HTML_TreeNode($rclabels["workflow"],"");
	$configuracion_workflow = new HTML_TreeNode($rclabels["configuracion_workflow"],"");
	$FeWFCmdDefaultTarea = new HTML_TreeNode($rclabels["FeWFCmdDefaultTarea"],"javascript:fncLoadCmd(\'FeWFCmdDefaultTarea\',\'workflow\')");
	$FeWFCmdDefaultActividad = new HTML_TreeNode($rclabels["FeWFCmdDefaultActividad"],"javascript:fncLoadCmd(\'FeWFCmdDefaultActividad\',\'workflow\')");
	$FeWFCmdDefaultActivitarea = new HTML_TreeNode($rclabels["FeWFCmdDefaultActivitarea"],"javascript:fncLoadCmd(\'FeWFCmdDefaultActivitarea\',\'workflow\')");
	$FeWFCmdDefaultEstadoacta = new HTML_TreeNode($rclabels["FeWFCmdDefaultEstadoacta"],"javascript:fncLoadCmd(\'FeWFCmdDefaultEstadoacta\',\'workflow\')");
	$FeWFCmdDefaultEstadotarea = new HTML_TreeNode($rclabels["FeWFCmdDefaultEstadotarea"],"javascript:fncLoadCmd(\'FeWFCmdDefaultEstadotarea\',\'workflow\')");
	$FeWFCmdDefaultProceso = new HTML_TreeNode($rclabels["FeWFCmdDefaultProceso"],"javascript:fncLoadCmd(\'FeWFCmdDefaultProceso\',\'workflow\')");
	$customers = new HTML_TreeNode($rclabels["customers"],"");
	$configuracion_customers = new HTML_TreeNode($rclabels["configuracion_customers"],"");
	$FeCuCmdDefaultTipoidentifi = new HTML_TreeNode($rclabels["FeCuCmdDefaultTipoidentifi"],"javascript:fncLoadCmd(\'FeCuCmdDefaultTipoidentifi\',\'customers\')");
	$FeCuCmdDefaultGruposinteres = new HTML_TreeNode($rclabels["FeCuCmdDefaultGruposinteres"],"javascript:fncLoadCmd(\'FeCuCmdDefaultGruposinteres\',\'customers\')");
	$registro_customers = new HTML_TreeNode($rclabels["registro_customers"],"");
	$FeCuCmdDefaultCliente = new HTML_TreeNode($rclabels["FeCuCmdDefaultCliente"],"javascript:fncLoadCmd(\'FeCuCmdDefaultCliente\',\'customers\')");
	$FeCuCmdDefaultContacto = new HTML_TreeNode($rclabels["FeCuCmdDefaultContacto"],"javascript:fncLoadCmd(\'FeCuCmdDefaultContacto\',\'customers\')");
	$cross300 = new HTML_TreeNode($rclabels["cross300"],"");
	$configuracion_cross = new HTML_TreeNode($rclabels["configuracion_cross"],"");
	$FeCrCmdDefaultTipoorden = new HTML_TreeNode($rclabels["FeCrCmdDefaultTipoorden"],"javascript:fncLoadCmd(\'FeCrCmdDefaultTipoorden\',\'cross300\')");
	$FeCrCmdDefaultEvento = new HTML_TreeNode($rclabels["FeCrCmdDefaultEvento"],"javascript:fncLoadCmd(\'FeCrCmdDefaultEvento\',\'cross300\')");
	$FeCrCmdDefaultCausa = new HTML_TreeNode($rclabels["FeCrCmdDefaultCausa"],"javascript:fncLoadCmd(\'FeCrCmdDefaultCausa\',\'cross300\')");
	$FeCrCmdDefaultMediorecepcion = new HTML_TreeNode($rclabels["FeCrCmdDefaultMediorecepcion"],"javascript:fncLoadCmd(\'FeCrCmdDefaultMediorecepcion\',\'cross300\')");
	$FeCrCmdDefaultPrioridad = new HTML_TreeNode($rclabels["FeCrCmdDefaultPrioridad"],"javascript:fncLoadCmd(\'FeCrCmdDefaultPrioridad\',\'cross300\')");
	$FeCrCmdDefaultCompromiso = new HTML_TreeNode($rclabels["FeCrCmdDefaultCompromiso"],"javascript:fncLoadCmd(\'FeCrCmdDefaultCompromiso\',\'cross300\')");
	$registro_cross = new HTML_TreeNode($rclabels["registro_cross"],"");
	$FeCrCmdDefaultOrden = new HTML_TreeNode($rclabels["FeCrCmdDefaultOrden"],"javascript:fncLoadCmd(\'FeCrCmdDefaultOrden\',\'cross300\')");
	$FeCrCmdDefaultAdminTareas = new HTML_TreeNode($rclabels["FeCrCmdDefaultAdminTareas"],"javascript:fncLoadCmd(\'FeCrCmdDefaultAdminTareas\',\'cross300\')");
	$FeCrCmdDefaultRevertPerformance = new HTML_TreeNode($rclabels["FeCrCmdDefaultRevertPerformance"],"javascript:fncLoadCmd(\'FeCrCmdDefaultRevertPerformance\',\'cross300\')");
	$FeCrCmdDefaultSolucion = new HTML_TreeNode($rclabels["FeCrCmdDefaultSolucion"],"javascript:fncLoadCmd(\'FeCrCmdDefaultSolucion\',\'cross300\')");
	$FeCrCmdDefaultSeguimiento = new HTML_TreeNode($rclabels["FeCrCmdDefaultSeguimiento"],"javascript:fncLoadCmd(\'FeCrCmdDefaultSeguimiento\',\'cross300\')");
	$reportes_cross = new HTML_TreeNode($rclabels["reportes_cross"],"");
	$FeCrCmdDefaultFichaOrd = new HTML_TreeNode($rclabels["FeCrCmdDefaultFichaOrd"],"javascript:fncLoadCmd(\'FeCrCmdDefaultFichaOrd\',\'cross300\')");
	$FeCrCmdDefaultRepoTiemposEjec = new HTML_TreeNode($rclabels["FeCrCmdDefaultRepoTiemposEjec"],"javascript:fncLoadCmd(\'FeCrCmdDefaultRepoTiemposEjec\',\'cross300\')");
	$FeCrCmdDefaultListadoOrden = new HTML_TreeNode($rclabels["FeCrCmdDefaultListadoOrden"],"javascript:fncLoadCmd(\'FeCrCmdDefaultListadoOrden\',\'cross300\')");
	$FeCrCmdDefaultConsolidado = new HTML_TreeNode($rclabels["FeCrCmdDefaultConsolidado"],"javascript:fncLoadCmd(\'FeCrCmdDefaultConsolidado\',\'cross300\')");
	$FeCrCmdDefaultDetallado = new HTML_TreeNode($rclabels["FeCrCmdDefaultDetallado"],"javascript:fncLoadCmd(\'FeCrCmdDefaultDetallado\',\'cross300\')");
	$FeCrCmdDefaultActuareq = new HTML_TreeNode($rclabels["FeCrCmdDefaultActuareq"],"javascript:fncLoadCmd(\'FeCrCmdDefaultActuareq\',\'cross300\')");
	$FeCrCmdDefaultConsultSolucion = new HTML_TreeNode($rclabels["FeCrCmdDefaultConsultSolucion"],"javascript:fncLoadCmd(\'FeCrCmdDefaultConsultSolucion\',\'cross300\')");
	$FeCrCmdDefaultReportsCenter = new HTML_TreeNode($rclabels["FeCrCmdDefaultReportsCenter"],"javascript:fncLoadCmd(\'FeCrCmdDefaultReportsCenter\',\'cross300\')");
	$FeCrCmdDefaultIndoprequre = new HTML_TreeNode($rclabels["FeCrCmdDefaultIndoprequre"],"javascript:fncLoadCmd(\'FeCrCmdDefaultIndoprequre\',\'cross300\')");
	$FeCrCmdDefaultPursuit_Report = new HTML_TreeNode($rclabels["FeCrCmdDefaultPursuit_Report"],"javascript:fncLoadCmd(\'FeCrCmdDefaultPursuit_Report\',\'cross300\')");
	$FeCrCmdDefaultDetail_Pursuit_Report = new HTML_TreeNode($rclabels["FeCrCmdDefaultDetail_Pursuit_Report"],"javascript:fncLoadCmd(\'FeCrCmdDefaultDetail_Pursuit_Report\',\'cross300\')");
	$human_resources = new HTML_TreeNode($rclabels["human_resources"],"");
	$configuracion_human = new HTML_TreeNode($rclabels["configuracion_human"],"");
	$FeHrCmdDefaultEstadoorgani = new HTML_TreeNode($rclabels["FeHrCmdDefaultEstadoorgani"],"javascript:fncLoadCmd(\'FeHrCmdDefaultEstadoorgani\',\'human_resources\')");
	$FeHrCmdDefaultTipoorgani = new HTML_TreeNode($rclabels["FeHrCmdDefaultTipoorgani"],"javascript:fncLoadCmd(\'FeHrCmdDefaultTipoorgani\',\'human_resources\')");
	$FeHrCmdDefaultEstadogrupo = new HTML_TreeNode($rclabels["FeHrCmdDefaultEstadogrupo"],"javascript:fncLoadCmd(\'FeHrCmdDefaultEstadogrupo\',\'human_resources\')");
	$FeHrCmdDefaultCargo = new HTML_TreeNode($rclabels["FeHrCmdDefaultCargo"],"javascript:fncLoadCmd(\'FeHrCmdDefaultCargo\',\'human_resources\')");
	$FeHrCmdDefaultPhysicalDependencies = new HTML_TreeNode($rclabels["FeHrCmdDefaultPhysicalDependencies"],"javascript:fncLoadCmd(\'FeHrCmdDefaultPhysicalDependencies\',\'human_resources\')");
	$registro_human = new HTML_TreeNode($rclabels["registro_human"],"");
	$FeHrCmdDefaultOrganizacion = new HTML_TreeNode($rclabels["FeHrCmdDefaultOrganizacion"],"javascript:fncLoadCmd(\'FeHrCmdDefaultOrganizacion\',\'human_resources\')");
	$FeHrCmdDefaultPersonal = new HTML_TreeNode($rclabels["FeHrCmdDefaultPersonal"],"javascript:fncLoadCmd(\'FeHrCmdDefaultPersonal\',\'human_resources\')");
	$FeHrCmdDefaultGrupo = new HTML_TreeNode($rclabels["FeHrCmdDefaultGrupo"],"javascript:fncLoadCmd(\'FeHrCmdDefaultGrupo\',\'human_resources\')");
	$schedule = new HTML_TreeNode($rclabels["schedule"],"");
	$configuracion_schedule = new HTML_TreeNode($rclabels["configuracion_schedule"],"");
	$FeScCmdDefaultCategoria = new HTML_TreeNode($rclabels["FeScCmdDefaultCategoria"],"javascript:fncLoadCmd(\'FeScCmdDefaultCategoria\',\'schedule\')");
	$registro_schedule = new HTML_TreeNode($rclabels["registro_schedule"],"");
	$FeScCmdDefaultDayview = new HTML_TreeNode($rclabels["FeScCmdDefaultDayview"],"javascript:fncLoadCmd(\'FeScCmdDefaultDayview\',\'schedule\')");
	$reportes_schedule = new HTML_TreeNode($rclabels["reportes_schedule"],"");
	$FeScCmdShowListSchedule = new HTML_TreeNode($rclabels["FeScCmdShowListSchedule"],"javascript:fncLoadCmd(\'FeScCmdShowListSchedule\',\'schedule\')");
	$encuestas = new HTML_TreeNode($rclabels["encuestas"],"");
	$configuracion_encuestas = new HTML_TreeNode($rclabels["configuracion_encuestas"],"");
	$FeEnCmdDefaultEjetematico = new HTML_TreeNode($rclabels["FeEnCmdDefaultEjetematico"],"javascript:fncLoadCmd(\'FeEnCmdDefaultEjetematico\',\'encuestas\')");
	$FeEnCmdDefaultTema = new HTML_TreeNode($rclabels["FeEnCmdDefaultTema"],"javascript:fncLoadCmd(\'FeEnCmdDefaultTema\',\'encuestas\')");
	$FeEnCmdDefaultModeloresp = new HTML_TreeNode($rclabels["FeEnCmdDefaultModeloresp"],"javascript:fncLoadCmd(\'FeEnCmdDefaultModeloresp\',\'encuestas\')");
	$FeEnCmdDefaultPregunta = new HTML_TreeNode($rclabels["FeEnCmdDefaultPregunta"],"javascript:fncLoadCmd(\'FeEnCmdDefaultPregunta\',\'encuestas\')");
	$FeEnCmdDefaultOpcionrepues = new HTML_TreeNode($rclabels["FeEnCmdDefaultOpcionrepues"],"javascript:fncLoadCmd(\'FeEnCmdDefaultOpcionrepues\',\'encuestas\')");
	$FeEnCmdDefaultFormulario = new HTML_TreeNode($rclabels["FeEnCmdDefaultFormulario"],"javascript:fncLoadCmd(\'FeEnCmdDefaultFormulario\',\'encuestas\')");
	$registro_encuestas = new HTML_TreeNode($rclabels["registro_encuestas"],"");
	$FeEnCmdDefaultEncuesta = new HTML_TreeNode($rclabels["FeEnCmdDefaultEncuesta"],"javascript:fncLoadCmd(\'FeEnCmdDefaultEncuesta\',\'encuestas\')");
	$FeEnCmdDefaultConfigEncuesta = new HTML_TreeNode($rclabels["FeEnCmdDefaultConfigEncuesta"],"javascript:fncLoadCmd(\'FeEnCmdDefaultConfigEncuesta\',\'encuestas\')");
	$reportes_encuestas = new HTML_TreeNode($rclabels["reportes_encuestas"],"");
	$FeEnCmdDefaultReport = new HTML_TreeNode($rclabels["FeEnCmdDefaultReport"],"javascript:fncLoadCmd(\'FeEnCmdDefaultReport\',\'encuestas\')");
	$FeEnCmdDefaultIndicador = new HTML_TreeNode($rclabels["FeEnCmdDefaultIndicador"],"javascript:fncLoadCmd(\'FeEnCmdDefaultIndicador\',\'encuestas\')");

	
		$nucant = sizeof($rcnode);
		for ($nucont = 0; $nucont<$nucant; $nucont ++) {
			if (!$rcnode[$nucont]["father"]) {
				$rctmpf[$nuindicef] = $rcnode[$nucont];
				$nuindicef ++;
				$this->fncseleccion($rcnode[$nucont]["son"], $rcnode, $rctmps, "father", "son", $nuindices);
			}
		}
	
		$nucant = sizeof($rctmps);
		for($nucont = 0; $nucont<$nucant;$nucont++){
			$rctmp = $rctmps[$nucont];
			$$rctmp["father"]->addItem($$rctmp["son"]);
		}
	
		$nucant = sizeof($rctmpf);
		for($nucont = 0; $nucont<$nucant;$nucont++){
			$rctmp = $rctmpf[$nucont];
			$objArbol->addItem($$rctmp["son"]);
		}
	
		$objArbol->printMenu();	
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Inicia el formateo de la matriz utilizada para pintar el arbol
	*   @param $ircdata array   Data total
	*   @param $ircpadre array  Data acumulada
	*   @param $isbpadre string Codigo a analizar
	*   @param $isbindpadre string Indice Padre
	*   @param $isbindhijo string   Indice hijo
	*   @param $inuindice integer   Indice consecutivo
	*   @author freina <freina@parquesoft>
	*   @date 18-Dic-2004 16:10 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $ircdata, & $ircpadre, $isbindpadre, $isbindhijo, & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont<$nucant; $nucont ++) {
			if ($ircdata[$nucont][$isbindpadre] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont][$isbindhijo], $ircdata, $ircpadre, $isbindpadre, $isbindhijo, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont];
				$inuindice ++;
			}
		}
		return;
	}
}
?>