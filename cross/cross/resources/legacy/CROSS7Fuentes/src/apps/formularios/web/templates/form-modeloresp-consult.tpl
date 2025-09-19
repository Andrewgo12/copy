<html>
{loadlabels table_name=Modeloresp&controls[]=CmdCancel}
{head}
      <title>Consultar Modeloresp</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmModelorespConsult" method="post"}
{consult_table table_name="modeloresp" llaves="morecodigon" form_name="frmModelorespConsult" command="FeEnCmdShowListModeloresp"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListModeloresp" form_name="frmModelorespConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>