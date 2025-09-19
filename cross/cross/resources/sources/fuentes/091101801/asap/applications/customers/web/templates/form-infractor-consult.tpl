<html>
{loadlabels table_name=Infractor&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Infractor</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmInfractorConsult" method="post"}
{consult_table table_name="infractor" llaves="infrcodigos" form_name="frmInfractorConsult" sqlid="infractor" command="FeCuCmdShowListInfractor"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListInfractor" form_name="frmInfractorConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
