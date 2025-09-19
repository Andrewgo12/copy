<html>
{loadlabels table_name=Commands&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Commands</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmCommandsConsult" method="get"}
{consult_table table_name="commands" llaves="commnombres,applcodigos" form_name="frmCommandsConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FePrCmdShowByIdCommands" form_name="frmCommandsConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListCommands" form_name="frmCommandsConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
