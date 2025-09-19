<html>
{loadlabels table_name=Tarea&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tarea</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTareaConsult" method="post"}
{consult_table table_name="tarea" 
	llaves="tarecodigos" 
	form_name="frmTareaConsult"
	sqlid="tarea"
	command="FeWFCmdShowListTarea"	
}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListTarea" form_name="frmTareaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>