<html>
{loadlabels table_name=Respuestausu&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Respuestausu</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmRespuestausuConsult" method="post"}
{consult_table table_name="respuestausu" llaves="usuacodigon,formcodigon,pregcodigon,reuscodigon" form_name="frmRespuestausuConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeEnCmdShowByIdRespuestausu" form_name="frmRespuestausuConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListRespuestausu" form_name="frmRespuestausuConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
