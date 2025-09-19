<html>
{loadlabels table_name=Actividad&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Actividad</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmActividadConsult" method="post"}
{consult_table table_name="actividad" llaves="acticodigos" form_name="frmActividadConsult"
command="FeWFCmdShowListActividad"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListActividad" form_name="frmActividadConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>