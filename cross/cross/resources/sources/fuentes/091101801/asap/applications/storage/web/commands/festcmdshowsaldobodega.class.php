<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowSaldoBodega {
	function execute() {
		
	$rcHtml[] =  "\n<script language=\"javascript\">";
	$rcHtml[] = " win = window.open(url,\"ficha\",opciones);";
	$rcHtml[] = "</script>";
	echo  implode("\n",$rcHtml);
		
		return "success";
	}
}
?>