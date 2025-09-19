<html>
{loadlabels table_name=Ipsservicio&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Ipsservicio</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmIpsservicioConsult" method="post"}
{consult_table table_name="ipsservicio" llaves="ipsecodigos" form_name="frmIpsservicioConsult" command="FeCuCmdShowListIpsservicio"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListIpsservicio" form_name="frmIpsservicioConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>