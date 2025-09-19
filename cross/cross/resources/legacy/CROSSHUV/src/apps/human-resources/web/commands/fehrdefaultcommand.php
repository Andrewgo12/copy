<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class FeHrDefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrDefaultCommand {
    function execute() {
        return "success";
    }
}
?>
