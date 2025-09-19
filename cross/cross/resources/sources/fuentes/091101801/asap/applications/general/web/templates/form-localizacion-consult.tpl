<html>
{loadlabels table_name=Localizacion&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Localizacion</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmLocalizacionConsult" method="post"}
{consult_table table_name="localizacion" llaves="locacodigos" form_name="frmLocalizacionConsult" sqlid="localizacion" command="FeGeCmdShowListLocalizacion"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListLocalizacion" form_name="frmLocalizacionConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>