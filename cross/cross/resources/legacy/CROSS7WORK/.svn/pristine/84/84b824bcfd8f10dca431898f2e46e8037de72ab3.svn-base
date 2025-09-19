<html>
{loadlabels table_name=Formatocarta&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Formatocarta</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
<br>
{form name="frmFormatocartaConsult" method="post"}
{consult_table table_name="formatocarta" 
llaves="focacodigos"
sqlid="" 
form_name="frmFormatocartaConsult"
command="FeGeCmdShowListFormatocarta"
viewfields="focacodigos,focanombres,focaestados"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListFormatocarta" form_name="frmFormatocartaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
