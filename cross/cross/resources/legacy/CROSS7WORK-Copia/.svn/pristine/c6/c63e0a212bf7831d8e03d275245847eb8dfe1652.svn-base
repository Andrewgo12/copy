<html>
{loadlabels table_name=ViewIndicador&controls[]=CmdPrint&controls[]=CmdClose}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsIndicador.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmViewIndicador" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr><td class="piedefoto">
	{viewIndicador}
	</td></tr>
	
	<tr>
		<td colspan="2" class="piedefoto">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2" class="piedefoto">
			<div align="center">
				{btn_command type="button" value="Cerrar" onClick="window.close();" id="CmdClose" name="FeEnCmdViewIndicador" form_name="frmViewIndicador"}
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
{droptmpfile table_name=ViewIndicador}
</html>