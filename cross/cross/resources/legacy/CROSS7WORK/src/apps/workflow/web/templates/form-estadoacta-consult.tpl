<html>
{loadlabels table_name=Estadoacta&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Estadoacta</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEstadoactaConsult" method="post"}
{consult_table table_name="estadoacta" llaves="esaccodigos" form_name="frmEstadoactaConsult"
command="FeWFCmdShowListEstadoacta"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListEstadoacta" form_name="frmEstadoactaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>