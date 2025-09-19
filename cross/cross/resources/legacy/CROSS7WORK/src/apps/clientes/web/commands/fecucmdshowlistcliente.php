<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListCliente {
    function execute(){
    	
    	settype($objService,"object");
    	
    	$objService = Application :: loadServices("Data_type");
    	
    	if ($cliente__clienombres)
			$_REQUEST["cliente__clienombres"] = $objService->formatString($cliente__clienombres);
			
		if ($cliente__clierepprnos)
			$_REQUEST["cliente__clierepprnos"] = $objService->formatString($cliente__clierepprnos);
			
		if ($cliente__clierepsenos)
			$_REQUEST["cliente__clierepsenos"] = $objService->formatString($cliente__clierepsenos);
			
		if ($cliente__cliereppraps)
			$_REQUEST["cliente__cliereppraps"] = $objService->formatString($cliente__cliereppraps);
			
		if ($cliente__clierepseaps)
			$_REQUEST["cliente__clierepseaps"] = $objService->formatString($cliente__clierepseaps);
			
		if ($cliente__clielocalizs)
			$_REQUEST["cliente__clielocalizs"] = $objService->formatString($cliente__clielocalizs);
			
		if ($cliente__cliepagwebs)
			$_REQUEST["cliente__cliepagwebs"] = $objService->formatString($cliente__cliepagwebs);
			
		if ($cliente__clieaparaers)
			$_REQUEST["cliente__clieaparaers"] = $objService->formatString($cliente__clieaparaers);
    	
       extract($_REQUEST);
       if(!WebSession::issetProperty("cliente__cliecodigos"))
           WebSession::setProperty("cliente__cliecodigos",$cliente__cliecodigos);
       if(!WebSession::issetProperty("cliente__clieidentifs"))
           WebSession::setProperty("cliente__clieidentifs",$cliente__clieidentifs);
       if(!WebSession::issetProperty("cliente__ticlcodigos"))
           WebSession::setProperty("cliente__ticlcodigos",$cliente__ticlcodigos);
       if(!WebSession::issetProperty("cliente__clienombres"))
           WebSession::setProperty("cliente__clienombres",$cliente__clienombres);
       if(!WebSession::issetProperty("cliente__clierepprnos"))
           WebSession::setProperty("cliente__clierepprnos",$cliente__clierepprnos);
       if(!WebSession::issetProperty("cliente__clierepsenos"))
           WebSession::setProperty("cliente__clierepsenos",$cliente__clierepsenos);
       if(!WebSession::issetProperty("cliente__cliereppraps"))
           WebSession::setProperty("cliente__cliereppraps",$cliente__cliereppraps);
       if(!WebSession::issetProperty("cliente__clierepseaps"))
           WebSession::setProperty("cliente__clierepseaps",$cliente__clierepseaps);
       if(!WebSession::issetProperty("cliente__clielocalizs"))
           WebSession::setProperty("cliente__clielocalizs",$cliente__clielocalizs);
       if(!WebSession::issetProperty("cliente__clietelefons"))
           WebSession::setProperty("cliente__clietelefons",$cliente__clietelefons);
       if(!WebSession::issetProperty("cliente__locacodigos"))
           WebSession::setProperty("cliente__locacodigos",$cliente__locacodigos);
           if(!WebSession::issetProperty("cliente_locacodigos_desc"))
           WebSession::setProperty("cliente_locacodigos_desc",$cliente_locacodigos_desc);
       if(!WebSession::issetProperty("cliente__cliepagwebs"))
           WebSession::setProperty("cliente__cliepagwebs",$cliente__cliepagwebs);
       if(!WebSession::issetProperty("cliente__cliemails"))
           WebSession::setProperty("cliente__cliemails",$cliente__cliemails);
       if(!WebSession::issetProperty("cliente__esclcodigos"))
           WebSession::setProperty("cliente__esclcodigos",$cliente__esclcodigos);
       if(!WebSession::issetProperty("cliente__tiidcodigos"))
           WebSession::setProperty("cliente__tiidcodigos",$cliente__tiidcodigos);
       if(!WebSession::issetProperty("cliente__grclcodigos"))
           WebSession::setProperty("cliente__grclcodigos",$cliente__grclcodigos);
       if(!WebSession::issetProperty("cliente__clienumfaxs"))
           WebSession::setProperty("cliente__clienumfaxs",$cliente__clienumfaxs);
       if(!WebSession::issetProperty("cliente__clieaparaers"))
           WebSession::setProperty("cliente__clieaparaers",$cliente__clieaparaers);
        return "success";  
    }
}
?>