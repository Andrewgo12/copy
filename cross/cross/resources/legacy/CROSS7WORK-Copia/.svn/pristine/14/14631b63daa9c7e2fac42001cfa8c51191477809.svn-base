<html>
{loadlabels table_name=Contacto&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Contacto</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmContactoConsult" method="post"}
{consult_table table_name="contacto" llaves="contcodigon" form_name="frmContactoConsult" sqlid="contacto" command="FeCuCmdShowListContacto"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListContacto" form_name="frmContactoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
