<html>
{loadlabels table_name=ViewReport&controls[]=CmdPrint&controls[]=CmdClose}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsReporte.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmViewReport" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	{openPdf}
	
	<tr><td class="piedefoto">
	{viewReport}
	</td></tr>
	
	{closePdfDurCal name="reporte"}
	
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
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=ViewReport}
</html>