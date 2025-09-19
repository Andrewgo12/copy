<html>
{loadlabels table_name=Proceso&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Proceso</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmProcesoConsult" method="post"}
{consult_table table_name="proceso" llaves="proccodigos" form_name="frmProcesoConsult"
sqlid="proceso"
command="FeWFCmdShowListProceso"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListProceso" form_name="frmProcesoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>