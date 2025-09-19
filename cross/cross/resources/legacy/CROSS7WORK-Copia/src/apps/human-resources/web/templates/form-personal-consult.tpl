<html>
{loadlabels table_name=Personal&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Personal</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmPersonalConsult" method="post"}
{consult_table table_name="personal" llaves="perscodigos" form_name="frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListPersonal" form_name="frmPersonalConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
