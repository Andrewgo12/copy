<?php
/**
	Copyright 2004 � FullEngine
	 Comando que limpia la sesi�n y saca al usuario del sistema
	@author creyes <cesar.reyes@parquesoft.com>
	@date 03-sep-2004 8:57:26
	@location Cali - Colombia
*/
class FePrCmdExit {
    function execute() {
		//Limpia la sesion
		session_unset();
		echo "<script language=\"javascript\">
					parent.location.href=\"index.php\";
				  </script>";
		return "success";
    }
}
?>