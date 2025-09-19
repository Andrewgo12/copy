<html>
{loadlabels table_name=Formapago&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Formapago</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmFormapagoConsult" method="get"}
{consult_table table_name="formapago" llaves="fopacodigos" form_name="frmFormapagoConsult" sqlid="" command="FeCuCmdShowListFormapago"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListFormapago" form_name="frmFormapagoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
