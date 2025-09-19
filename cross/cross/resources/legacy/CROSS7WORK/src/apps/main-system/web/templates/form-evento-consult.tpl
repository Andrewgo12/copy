<html>
{loadlabels table_name=Evento&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Evento</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEventoConsult" method="post"}
{consult_table table_name="evento" llaves="tiorcodigos,evencodigos" form_name="frmEventoConsult" sqlid="evento" command="FeCrCmdShowListEvento"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListEvento" form_name="frmEventoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
