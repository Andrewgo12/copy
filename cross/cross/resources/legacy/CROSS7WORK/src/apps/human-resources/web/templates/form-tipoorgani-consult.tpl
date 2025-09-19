<html>
{loadlabels table_name=Tipoorgani&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipoorgani</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipoorganiConsult" method="post"}
{consult_table table_name="tipoorgani" llaves="tiorcodigos" form_name="frmTipoorganiConsult" sqlid="" command="FeHrCmdShowListTipoorgani"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListTipoorgani" form_name="frmTipoorganiConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
