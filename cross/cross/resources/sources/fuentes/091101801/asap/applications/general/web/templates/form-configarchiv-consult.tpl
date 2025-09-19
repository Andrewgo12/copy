<html>
{loadlabels table_name=Configarchiv&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Configarchiv</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmConfigarchivConsult" method="get"}
{consult_table table_name="configarchiv" llaves="cogacodigos" fields="cogacodigos,coganombres" form_name="frmConfigarchivConsult" sqlid="configarchiv" command="FeGeCmdShowListConfigarchiv"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListConfigarchiv" form_name="frmConfigarchivConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
