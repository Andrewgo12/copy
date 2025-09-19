<html>
{loadlabels table_name=Gruporecurso&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Gruporecurso</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmGruporecursoConsult" method="get"}
{consult_table table_name="gruporecurso" llaves="grrecodigos" form_name="frmGruporecursoConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdGruporecurso" form_name="frmGruporecursoConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListGruporecurso" form_name="frmGruporecursoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
