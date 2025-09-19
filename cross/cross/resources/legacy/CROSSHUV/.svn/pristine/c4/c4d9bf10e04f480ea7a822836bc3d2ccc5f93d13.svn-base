<html>
{loadlabels table_name=Tipomoneda&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipomoneda</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipomonedaConsult" method="get"}
{consult_table table_name="tipomoneda" llaves="timocodigos" form_name="frmTipomonedaConsult" sqlid="tipomoneda" command="FeCuCmdShowListTipomoneda"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListTipomoneda" form_name="frmTipomonedaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>