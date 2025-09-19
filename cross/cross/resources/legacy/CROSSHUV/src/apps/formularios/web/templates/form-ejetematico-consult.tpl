<html>
{loadlabels table_name=Ejetematico&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Ejetematico</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmEjetematicoConsult" method="post"}
{consult_table table_name="ejetematico" llaves="ejtecodigon" form_name="frmEjetematicoConsult" command="FeEnCmdShowListEjetematico"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListEjetematico" form_name="frmEjetematicoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>