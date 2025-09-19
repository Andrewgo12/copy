<html>
{loadlabels table_name=Tipocontrato&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipocontrato</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipocontratoConsult" method="get"}
{consult_table table_name="tipocontrato" llaves="ticocodigos" form_name="frmTipocontratoConsult" sqlid="" command="FeCuCmdShowListTipocontrato"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListTipocontrato" form_name="frmTipocontratoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
