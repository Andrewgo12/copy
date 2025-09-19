<html>
{loadlabels table_name=Tiporecurso&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tiporecurso</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTiporecursoConsult" method="get"}
{consult_table table_name="tiporecurso" llaves="tirecodigos" form_name="frmTiporecursoConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdTiporecurso" form_name="frmTiporecursoConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListTiporecurso" form_name="frmTiporecursoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
