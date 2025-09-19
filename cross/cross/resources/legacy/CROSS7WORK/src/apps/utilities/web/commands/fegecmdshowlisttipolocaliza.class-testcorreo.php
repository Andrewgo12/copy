<?php

/*

Script para probar el correo. Se debe renombrar el archivo de tipos de localización por este 
y luego de la prueba cambiar de nuevo el nombre. Se va a la interfaz de tipo de localización y se da consultar.

*/

require_once "Web/WebRequest.class.php";

Class FeGeCmdShowListTipolocaliza {
   function execute() {
      echo "Hola...";
      $sbEmaidesdes = "mcastano@suntic.co";
      $sbEmaiparas = "cazapata@fullengine.com";
      $sbEmaiasuntos = "Prueba de envio desde comando";
      $sbOrdenumeros = "0000142021";
      $sbEmaitextos = "Prueba de envio";
      $sbFoemcodigos = "1";
      $objManager = Application :: getDomainController("CentroEmailManager");

      $nuResult = $objManager->fncSendRuleEmail($sbEmaidesdes,$sbEmaiparas,$sbEmaiasuntos,$sbOrdenumeros,$sbEmaitextos,$sbFoemcodigos,$rcData);

       return "success";
    }
}

?>