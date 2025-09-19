<html>
{loadlabels table_name=Recurso&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Recurso</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmRecursoConsult" method="get"}
{consult_table table_name="recurso" llaves="recucodigos" form_name="frmRecursoConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdRecurso" form_name="frmRecursoConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListRecurso" form_name="frmRecursoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
