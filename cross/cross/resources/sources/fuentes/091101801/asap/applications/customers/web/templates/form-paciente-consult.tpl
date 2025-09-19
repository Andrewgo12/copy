<html>
{loadlabels table_name=Paciente&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Paciente</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmPacienteConsult" method="post"}
{consult_table table_name="paciente" llaves="paciindentis" form_name="frmPacienteConsult" sqlid="paciente" command="FeCuCmdShowListPaciente"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListPaciente" form_name="frmPacienteConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>