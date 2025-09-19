<html>
{loadlabels table_name=Segurisocial&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Segurisocial</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmSegurisocialConsult" method="post"}
{consult_table table_name="segurisocial" llaves="sesocodigos" form_name="frmSegurisocialConsult" command="FeCuCmdShowListSegurisocial"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListSegurisocial" form_name="frmSegurisocialConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>