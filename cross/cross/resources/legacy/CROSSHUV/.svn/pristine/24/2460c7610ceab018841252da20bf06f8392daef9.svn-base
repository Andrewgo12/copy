<html>
{loadlabels table_name=Language&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Language</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmLanguageConsult" method="post"}
{consult_table table_name="language" llaves="langcodigos" form_name="frmLanguageConsult" sqlid="" command="FePrCmdShowListLanguage"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListLanguage" form_name="frmLanguageConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
