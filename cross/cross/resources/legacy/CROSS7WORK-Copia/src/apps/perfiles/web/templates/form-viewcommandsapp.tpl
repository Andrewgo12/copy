<html>
{loadlabels table_name=commands&controls[]=CmdBack}
{head}
      <title>Ver Comandos</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}
<br>
{form name="frmViewCommandsApp" method="get"}
{viewcommands applcodigos=$applcodigos table_name="commands"}
<br>
<table border="0" align="center">
	<tr>
    	<td>{btn_command type="button" value="Cerrar" id="CmdBack" name="FePrCmdCancelShowListCommands" form_name="frmViewCommandsApp"}</td>
		<!--<td>{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListCommands" form_name="frmViewCommandsApp"}</td>-->
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>