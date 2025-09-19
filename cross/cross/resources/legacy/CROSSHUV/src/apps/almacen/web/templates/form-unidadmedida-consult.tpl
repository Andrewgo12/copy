<html>
{loadlabels table_name=Unidadmedida&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Unidadmedida</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmUnidadmedidaConsult" method="get"}
{consult_table table_name="unidadmedida" llaves="unmecodigos" form_name="frmUnidadmedidaConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdUnidadmedida" form_name="frmUnidadmedidaConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListUnidadmedida" form_name="frmUnidadmedidaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
