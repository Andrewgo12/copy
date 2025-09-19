<html>
{loadlabels table_name=Grupo&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Grupo</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
<br>
{form name="frmGrupoConsult" method="post"}
{consult_table 
table_name="grupo" 
llaves="grupcodigon" 
form_name="frmGrupoConsult" 
sqlid="grupo"
command="FeHrCmdShowListGrupo"
date_fields="grupfchainin"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListGrupo" form_name="frmGrupoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>