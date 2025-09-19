<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class FeCuDefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuDefaultCommand {
    function execute() {
        return "success";
    }
}
?>
