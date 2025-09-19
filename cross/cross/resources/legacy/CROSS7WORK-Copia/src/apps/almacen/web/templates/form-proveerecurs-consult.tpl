<html>
{loadlabels table_name=Proveerecurs&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Proveerecurs</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmProveerecursConsult" method="get"}
{consult_table table_name="proveerecurs" llaves="prrecodigos" form_name="frmProveerecursConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdProveerecurs" form_name="frmProveerecursConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListProveerecurs" form_name="frmProveerecursConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
