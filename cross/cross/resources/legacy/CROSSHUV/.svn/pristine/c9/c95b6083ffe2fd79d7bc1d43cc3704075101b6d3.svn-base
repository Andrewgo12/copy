<?php
/**
 * @copyright Copyright 2004 &copy; FullEngine
 *
 * Valida el comndo de ejecuciÔøΩn del splash y lo carga
 * Smarty plugin
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 30-mar-2005 12:43:32
 * @location Cali-Colombia
 * Ejemplo:
 */
function smarty_function_loadsplash($params, & $smarty) {

	//Datos de la sesiÛn
	$rcUser = Application::getUserParam();

	//SAQUEMOS EL COMANDO DEL REPORTE DE ESTADO DE LOS TICKETS SOLO PARA LOS PERFILES ADMINISTRATIVOS
	$HR = Application::loadServices("Human_resources");
	$AdminProfiles = Application::getConstant("PERFIL_ADMIN");
	$AgentProfile[] = Application::getConstant("PERFIL_AGENTES_BPO");
	$HR->close();
	
	if(in_array($rcUser["prof_code"],$AdminProfiles) || $rcUser["username"]=='mescobar') {
		$rcCmd = Application::getConstant('CMD_ADMIN_SPLASH');
	}
	else if(in_array($rcUser["prof_code"],$AgentProfile)) {
		$rcCmd = Application::getConstant('CMD_AGENT_SPLASH');
	}
	else {
		$rcCmd = Application::getConstant('CMD_SPLASH');
	}

	//Cambia la configuracion de la aplicaci√≥n
	$dir_name = dirname(__FILE__)."/../../../".$rcCmd["app"];
	$objTmp = new Application($rcCmd["app"], $dir_name, true);
	$result = Application :: validateProfiles($rcCmd["name"]);
	if($result == true){
		die("<script language='javascript'>
                location='../{$rcCmd["app"]}/index.php?action={$rcCmd["name"]}';
                </script>");
	}
	$dir_name = dirname(__FILE__)."/../../../general";
	$objTmp = new Application($rcCmd["app"], $dir_name, true);
	$paramsManager = Application::getDomainController('ParamsManager');
	$splash_img = $paramsManager->getParam('general','SPLASH_IMG');

	$form = "<html>
                <head>
                    <meta content=\"text/html; charset=ISO-8859-1\" http-equiv=\"content-type\"><title></title>
                    <link href=\"web/css/estilos.css\" rel=\"stylesheet\" type=\"text/css\">
                    <script language=\"javascript\" src=\"web/js/jsrsClient.js\" type=\"text/javascript\"></script>
                    <script language=\"javascript\" src=\"web/js/jsAccessKey.js\" type=\"text/javascript\"></script>
                    <script language=\"javascript\" src=\"web/js/putFocus.js\" type=\"text/javascript\"></script>
                    <script language=\"javascript\" src=\"web/js/noMouse.js\" type=\"text/javascript\"></script>
                    <script language=\"javascript\" src=\"web/js/optionKey.js\" type=\"text/javascript\"></script>
                    <script language=\"javascript\" src=\"web/js/disableButtons.js\" type=\"text/javascript\"></script>
                </head>	
                <body onkeydown=\"return doKeyDown(event)\">
                    <table style=\"text-align: left; width: 100%;\" border=\"0\">
                      <tbody>
                        <tr>
                          <td class=\"piedefoto\">
                          <div align=\"center\">
                          <br>
                          <br>
                          <br>
                          <br>
                          <br>";
	if($splash_img)
	$form .= "<img  alt=\"\" src=\"web/images/$splash_img\" align=\"middle\">";
	$form .= "</div>
                          </td>
                        </tr>
                        <tr align=\"right\">
                          <td class=\"piedefoto\"><b>Copyright 2004-2006 &copy; FullEngine</b></td>
                        </tr>
                      </tbody>
                    </table>
                </body>
            </html>";
	return $form;

}