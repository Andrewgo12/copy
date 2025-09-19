<html>
{loadlabels table_name=Estadoproces&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Estadoproces</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEstadoprocesConsult" method="get"}
{consult_table table_name="estadoproces" llaves="esprcodigos" form_name="frmEstadoprocesConsult"
sqlid=""
command="FeWFCmdShowListEstadoproces"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListEstadoproces" form_name="frmEstadoprocesConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>