<html>
{loadlabels table_name=Actividad&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Actividad</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmActividadConsult" method="get"}
{consult_table table_name="actividad" llaves="acticodigos" form_name="frmActividadConsult" sqlid="" command="FeCrCmdShowListActividad"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListActividad" form_name="frmActividadConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
