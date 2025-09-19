<html>
{loadlabels table_name=Report&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>Respuestas Abiertas</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmReport" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="80%">
<tr>
	<td colspan="2" class="piedefoto">
	{showopenanswers}
	</td>
	<td class="piedefoto"></td>
</tr>
<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Imprimir" onClick="print();" id="CmdPrint" name="FeEnCmdViewReport" form_name="frmViewReport"}
				{btn_command type="button" value="Cerrar" onClick="window.close();" id="CmdClose" name="FeEnCmdViewReport" form_name="frmViewReport"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="focusposition"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>