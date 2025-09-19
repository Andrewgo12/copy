<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdDeleteDetaconfarch {
    function execute()
    {
        extract($_REQUEST);
        settype($rctmp, "array");
        settype($rcvalue, "array");
        settype($rcresult, "array");
        settype($nucont, "integer");
        settype($nucontr, "integer");
        if (WebSession :: issetProperty("Detaconfarch")) {
        	$rctmp = WebSession :: getProperty("Detaconfarch");
        	unset($rctmp[$indice - 1]);
        	foreach($rctmp as $nucont => $rcvalue){
        		$rcresult[$nucontr] = $rcvalue;
        		$nucontr ++;
        	}
        	WebSession :: setProperty("Detaconfarch", $rcresult);
           $message = 3;  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }
    }
}
?>	