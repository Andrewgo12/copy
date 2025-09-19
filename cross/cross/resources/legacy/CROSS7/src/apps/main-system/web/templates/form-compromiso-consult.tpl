<html>
{loadlabels table_name=Compromiso&controls[]=CmdCancel}
{head}
      <title>Consultar Compromiso</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmCompromisoConsult" method="get"}
{consult_table table_name="compromiso" command="FeCrCmdShowListCompromiso" llaves="compcodigos" form_name="frmCompromisoConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListCompromiso" form_name="frmCompromisoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
