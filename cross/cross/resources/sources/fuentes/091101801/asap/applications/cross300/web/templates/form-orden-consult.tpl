<html>
{loadlabels table_name=Orden&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Orden</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmOrdenConsult" method="post"}
{consult_table_orden 
table_name="orden" 
llaves="ordenumeros" 
form_name="frmOrdenConsult" 
sqlid="orden" 
command="FeCrCmdShowListOrden" 
date_fields="ordefecingd"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListOrden" form_name="frmOrdenConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
