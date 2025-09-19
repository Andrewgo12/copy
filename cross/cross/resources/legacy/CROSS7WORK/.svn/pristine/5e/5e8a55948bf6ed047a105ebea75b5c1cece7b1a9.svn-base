<html>
{loadlabels table_name=Comunicacionopen&controls[]=CmdRefresh&controls[]=CmdClose}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsAccionesCT.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmComunicacionOpen" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   {viewfilesystem}
   	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	{btn_command type="button" value="Refrescar" id="CmdRefresh" name="FeGeCmdCentroComunicacionDownload" form_name="frmComunicacionOpen"}
		    	{btn_commandCT type="button" value="Close" id="CmdClose"  name="CmdClose" onclick="jsCloseCT();"}
			</div>
		</td>
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
{droptmpfile table_name=Comunicacionopen}

</html>