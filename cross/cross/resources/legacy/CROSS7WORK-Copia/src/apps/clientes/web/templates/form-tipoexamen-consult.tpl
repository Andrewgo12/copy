<html>
{loadlabels table_name=Tipoexamen&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipoexamen</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipoexamenConsult" method="post"}
{consult_table table_name="tipoexamen" llaves="tiexcodigos" form_name="frmTipoexamenConsult" command="FeCuCmdShowListTipoexamen"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListTipoexamen" form_name="frmTipoexamenConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>