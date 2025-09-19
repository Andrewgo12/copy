<html>
{loadlabels table_name=Applications&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Applications</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmApplicationsConsult" method="get"}
{consult_table 
    table_name="applications" 
    llaves="applcodigos" 
    form_name="frmApplicationsConsult" 
    sqlid="application" 
    command="FePrCmdShowListApplications"
}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListApplications" form_name="frmApplicationsConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
