<html>
{loadlabels table_name=Auth&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Auth</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
<br>
{form name="frmAuthConsult" method="post"}
{consult_table
	table_name="auth" 
	llaves="authusernams" 
	form_name="frmAuthConsult"
	sqlid="auth"
	command="FePrCmdShowListAuth"
	exclude="auth__schecodigon"
	service="Profiles"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
			{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListAuth" form_name="frmAuthConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
