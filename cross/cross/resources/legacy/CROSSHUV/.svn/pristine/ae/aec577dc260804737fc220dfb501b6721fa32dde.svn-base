<html>
{loadlabels table_name=Pregunta&controls[]=CmdCancel}
{head}
      <title>Consultar Pregunta</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPreguntaConsult" method="post"}
{consult_table table_name="pregunta" llaves="pregcodigon" sqlid="pregunta" form_name="frmPreguntaConsult" command="FeEnCmdShowListPregunta"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListPregunta" form_name="frmPreguntaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>