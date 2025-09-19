<?php

/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeScCmdShowByIdEntrada {

	function execute()
	{
		extract($_REQUEST);
		if(WebSession :: issetProperty("_rcOrgSchedule")){
			WebSession :: unsetProperty("_rcOrgSchedule");
		}
		if(($entrada__entrcodigon != NULL) && ($entrada__entrcodigon != ""))
		{
			$entrada_manager = Application::getDomainController('EntradaManager');
			$entrada_data = $entrada_manager->getByIdEntrada($entrada__entrcodigon);
			$entrada_data[0] = $entrada_data[0][0];
			$entrada_data[1] = $entrada_data[1][0];
			 
			$_REQUEST["entrada__entrcodigon"] = $entrada_data[0]["entrcodigon"];
			$_REQUEST["entrada__entrusucreas"] = $entrada_data[0]["entrusucreas"];
			$_REQUEST["entrada__entrfechorun"] = $entrada_data[0]["entrfechorun"];
			$_REQUEST["entrada__entrduracion"] = $entrada_data[0]["entrduracion"];
			$_REQUEST["entrada__agprcodigos"] = $entrada_data[0]["agprcodigos"];
			$_REQUEST["entrada__catecodigon"] = $entrada_data[0]["catecodigon"];
			$_REQUEST["entrada__entrdescris"] = $entrada_data[0]["entrdescris"];
			$_REQUEST["entrada__entractivas"] = $entrada_data[0]["entractivas"];
			 
			//DATOS CROSS
			$_REQUEST["ordenumeros"] = $entrada_data[1]["ordenumeros"];
			$_REQUEST["ordenumexps"] = $entrada_data[1]["ordenumexps"];
			$_REQUEST["actacodigos"] = $entrada_data[1]["actacodigos"];
			 
			//DEPENDENCIAS
			$this->getOrgacodigos($entrada_data[2],$orgacodigos);
			 
			if(array_key_exists(3,$entrada_data))
			if(is_array($entrada_data[3]))
			{
				$_REQUEST["deenprocesas"] = $entrada_data[3][0]["deenprocesas"];
				$_REQUEST["deenvicitmas"] = $entrada_data[3][0]["deenvicitmas"];
				$_REQUEST["deenfiscalis"] = $entrada_data[3][0]["deenfiscalis"];
				$_REQUEST["deendefensas"] = $entrada_data[3][0]["deendefensas"];
			}
		}else{

			$_REQUEST["entrada__entrcodigon"] = WebSession::getProperty("entrada__entrcodigon");
			$_REQUEST["entrada__entrusucreas"] = WebSession::getProperty("entrada__entrusucreas");
			$_REQUEST["entrada__entrfechorun"] = WebSession::getProperty("entrada__entrfechorun");
			$_REQUEST["entrada__entrduracion"] = WebSession::getProperty("entrada__entrduracion");
			$_REQUEST["entrada__agprcodigos"] = WebSession::getProperty("entrada__agprcodigos");
			$_REQUEST["entrada__catecodigon"] = WebSession::getProperty("entrada__catecodigon");
			$_REQUEST["entrada__entrdescris"] = WebSession::getProperty("entrada__entrdescris");
			$_REQUEST["entrada__entractivas"] = WebSession::getProperty("entrada__entractivas");
			$_REQUEST["entrada__orgacodigos"] = WebSession::getProperty("entrada__orgacodigos");
			$_REQUEST["ordenumeros"] = WebSession::getProperty("ordenumeros");
			$_REQUEST["ordenumexps"] = WebSession::getProperty("ordenumexps");
			$_REQUEST["actacodigos"] = WebSession::getProperty("actacodigos");
			$_REQUEST["orgacodigos"] = WebSession::getProperty("orgacodigos");
			$_REQUEST["orgacodigospart"] = WebSession::getProperty("orgacodigospart");
			$_REQUEST["entrada__perscodigos"] = WebSession::getProperty("entrada__perscodigos");
		}

		WebSession::unsetProperty("entrada__entrcodigon");
		WebSession::unsetProperty("entrada__entrusucreas");
		WebSession::unsetProperty("entrada__entrfechorun");
		WebSession::unsetProperty("entrada__entrduracion");
		WebSession::unsetProperty("entrada__agprcodigos");
		WebSession::unsetProperty("entrada__catecodigon");
		WebSession::unsetProperty("entrada__entrdescris");
		WebSession::unsetProperty("entrada__entractivas");
		WebSession::unsetProperty("entrada__orgacodigos");
		WebSession::unsetProperty("ordenumeros");
		WebSession::unsetProperty("ordenumexps");
		WebSession::unsetProperty("actacodigos");
		WebSession::unsetProperty("orgacodigos");
		WebSession::unsetProperty("orgacodigospart");
		WebSession::unsetProperty("entrada__perscodigos");
		 
		return "success";
	}

	function getOrgacodigos($rcData,$orgaRequest)
	{
		if(is_array($rcData))
		foreach ($rcData as $rcRow)
		{
			if($rcRow["orgacodigos"]!=$orgaRequest)
			$_REQUEST["orgacodigos"] = $rcRow["orgacodigos"];
			else
			$_REQUEST["orgacodigospart"] = $rcRow["orgacodigos"];
		}
	}

	function getPerscodigos($rcData)
	{
		settype($rcRet,"array");
		if(is_array($rcData))
		foreach ($rcData as $rcRow)
		$rcRet[] = $rcRow["perscodigos"];
		return $rcRet;
	}

}

?>
