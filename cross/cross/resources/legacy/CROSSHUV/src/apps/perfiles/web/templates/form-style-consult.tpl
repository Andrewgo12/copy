<html>
{loadlabels table_name=Style&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Style</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmStyleConsult" method="post"}
{consult_table table_name="style" llaves="stylcodigos,applcodigos" form_name="frmStyleConsult" sqlid="style" command="FePrCmdShowListStyle"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FePrCmdCancelShowListStyle" form_name="frmStyleConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
