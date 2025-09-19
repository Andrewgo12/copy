<html>
{loadlabels table_name=Activitarea&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Activitarea</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmActivitareaConsult" method="post"}
{consult_table 
	table_name="activitarea" 
	llaves="tarecodigos,acticodigos" 
	form_name="frmActivitareaConsult"
	sqlid="activitarea"
	command="FeWFCmdShowListActivitarea"
}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListActivitarea" form_name="frmActivitareaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>