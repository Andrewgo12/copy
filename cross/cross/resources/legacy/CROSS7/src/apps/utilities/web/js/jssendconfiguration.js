/*
Funcion							: fncsendconfiguration
Descripcion		: Envia los datos para iniciar el formateo del archivo
Autor											: freina
Fecha										: 05-Oct-2004
*/
function fncsendconfiguration(command,cogacodigos)
{
	if(command && cogacodigos){
			disableButtons();
			document.frmFormattofile.action.value = command;
			document.frmFormattofile.configarchiv__cogacodigos.value = cogacodigos;
			document.frmFormattofile.submit();
	}
}