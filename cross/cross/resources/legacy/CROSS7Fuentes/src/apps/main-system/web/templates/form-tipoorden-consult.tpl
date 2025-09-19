<html>
{loadlabels table_name=Tipoorden&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipoorden</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipoordenConsult" method="post"}
{consult_table table_name="tipoorden" llaves="tiorcodigos" form_name="frmTipoordenConsult" sqlid="tipoorden" command="FeCrCmdShowListTipoorden"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListTipoorden" form_name="frmTipoordenConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
