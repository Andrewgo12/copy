<html>
{loadlabels table_name=Tipoidentifi&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipoidentifi</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipoidentifiConsult" method="post"}
{consult_table table_name="tipoidentifi" llaves="tiidcodigos" form_name="frmTipoidentifiConsult" command="FeCuCmdShowListTipoidentifi"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListTipoidentifi" form_name="frmTipoidentifiConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
