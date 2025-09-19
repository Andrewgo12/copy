<html>
{loadlabels table_name=Profiles&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Profiles</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmProfilesConsult" method="post"}
{consult_table table_name="profiles" llaves="profcodigos,applcodigos" form_name="frmProfilesConsult" sqlid="profiles" command="FeGeCmdShowListProfiles" service="Profiles"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListProfiles" form_name="frmProfilesConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>