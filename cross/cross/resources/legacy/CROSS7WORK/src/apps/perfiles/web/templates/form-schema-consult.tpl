<html>
{loadlabels table_name=Schema&controls[]=CmdCancel}
{head}
      <title>Consultar Schema</title>
	  {putstyle style=""}
	  {putjsfiles}
	  
{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}


{form name="frmSchemaConsult" method="post"}
{consult_table 
    table_name="schema" 
    llaves="schecodigon" 
    form_name="frmSchemaConsult" 
    sqlid="schema" 
    command="FePrCmdShowListSchema"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListSchema" form_name="frmSchemaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
