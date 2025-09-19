<html>
{loadlabels table_name=Contratoprod&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Contratoprod</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmContratoprodConsult" method="post"}
{consult_table 
	table_name="contratoprod" 
	llaves="contnics,prodcodigos" 
	form_name="frmContratoprodConsult"
	sqlid="contratoproducto"
	command="FeCuCmdShowListContratoprod"
}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListContratoprod" form_name="frmContratoprodConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
