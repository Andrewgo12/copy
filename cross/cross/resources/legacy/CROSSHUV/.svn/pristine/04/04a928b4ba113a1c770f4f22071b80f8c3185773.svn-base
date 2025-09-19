<html>
{loadlabels table_name=Condiusuario&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Condiusuario</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmCondiusuarioConsult" method="post"}
{consult_table table_name="condiusuario" llaves="couscodigos" form_name="frmCondiusuarioConsult" command="FeCuCmdShowListCondiusuario"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListCondiusuario" form_name="frmCondiusuarioConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>