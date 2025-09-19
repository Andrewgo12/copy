<html>
{loadlabels table_name=Formatoemail&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Formatoemail</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
<br>
{form name="frmFormatoemailConsult" method="post"}
{consult_table table_name="formatoemail" 
llaves="foemcodigos"
sqlid="" 
form_name="frmFormatoemailConsult"
command="FeGeCmdShowListFormatoemail"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListFormatoemail" form_name="frmFormatoemailConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>