<html>
{loadlabels table_name=Configformat&controls[]=CmdUpdate&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmConfigformat" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=focacodigos&blBold=true}</td>
      <td>{select_row_table id="focacodigos" name="configformat__focacodigos" value="focacodigos" command_default="FeGeCmdDefaultConfigformat" sqlid="formatocarta" label="focanombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=focacodigos}</td>
   </tr>
   <tr>
		<td colspan="3" class="piedefoto">
			<div align="center">
	    	{viewcampconfform table="configformat" dataparams="evencodigos:tiorcodigos|causcodigos:tiorcodigos,evencodigos"}</td>
	    	</div>
	    </td>
   </tr>
	<!--<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateConfigformat" form_name="frmConfigformat"}
				{btn_clean table_name="Configformat" form_name="frmConfigformat"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>-->
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Configformat}

</html>
