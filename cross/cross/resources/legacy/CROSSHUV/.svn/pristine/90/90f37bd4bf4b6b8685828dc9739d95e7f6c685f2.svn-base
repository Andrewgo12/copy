<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListRecuseribode {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("recuseribode__resbnumedocu"))
           WebSession::setProperty("recuseribode__resbnumedocu",$recuseribode__resbnumedocu);
       if(!WebSession::issetProperty("recuseribode__recucodigos"))
           WebSession::setProperty("recuseribode__recucodigos",$recuseribode__recucodigos);
       if(!WebSession::issetProperty("recuseribode__resbserirecu"))
           WebSession::setProperty("recuseribode__resbserirecu",$recuseribode__resbserirecu);
       if(!WebSession::issetProperty("recuseribode__resbbodeactu"))
           WebSession::setProperty("recuseribode__resbbodeactu",$recuseribode__resbbodeactu);
       if(!WebSession::issetProperty("recuseribode__resbbodeante"))
           WebSession::setProperty("recuseribode__resbbodeante",$recuseribode__resbbodeante);
       if(!WebSession::issetProperty("recuseribode__resbfechmovi"))
           WebSession::setProperty("recuseribode__resbfechmovi",$recuseribode__resbfechmovi);
       if(!WebSession::issetProperty("recuseribode__perscodigos"))
           WebSession::setProperty("recuseribode__perscodigos",$recuseribode__perscodigos);
        return "success";  
    }
}
?>	
