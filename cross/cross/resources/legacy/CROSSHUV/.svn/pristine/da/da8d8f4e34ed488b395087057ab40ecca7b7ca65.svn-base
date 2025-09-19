<html>
{loadlabels table_name=Tema&controls[]=CmdCancel}
{head}
      <title>Consultar Tema</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmTemaConsult" method="post"}
{consult_table table_name="tema" llaves="temacodigon" sqlid="tema" form_name="frmTemaConsult" command="FeEnCmdShowListTema"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListTema" form_name="frmTemaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>