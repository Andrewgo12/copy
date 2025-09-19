<html>
{loadlabels table_name=Causa&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Causa</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmCausaConsult" method="post"}
{consult_table table_name="causa" 
	llaves="tiorcodigos,evencodigos,causcodigos" 
	form_name="frmCausaConsult" 
	sqlid="causa" 
	command="FeCrCmdShowListCausa"
}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListCausa" form_name="frmCausaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
