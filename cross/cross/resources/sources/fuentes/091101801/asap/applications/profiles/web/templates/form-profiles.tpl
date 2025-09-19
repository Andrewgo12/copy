<html>
{loadlabels table_name=Profiles&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmProfiles" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
    
    <tr>
      <td>{printlabel name=applcodigos&blBold=true}</td>
      <td>{select_row_table id="applcodigos" sqlid="applications" name="profiles__applcodigos" table_name="applications" value="applcodigos" label="applnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=applcodigos}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=profcodigos&blBold=true}</td>
      <td>{textfield id="profcodigos" name="profiles__profcodigos" maxlength="10"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=profcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=profnombres&blBold=true}</td>
      <td>{textfield id="profnombres" name="profiles__profnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=profnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=profdescrips}</td>
      <td>{textarea id="profdescrips" name="profiles__profdescrips" cols="40" rows="5"}{/textarea}</td>
  	<td class="piedefoto">{printcoment name=profdescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddProfiles" form_name="frmProfiles"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateProfiles" form_name="frmProfiles" loadFields="profiles__profcodigos,profiles__profnombres" confirm="11"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FePrCmdDeleteProfiles" form_name="frmProfiles" loadFields="profiles__profcodigos,profiles__profnombres" confirm="12"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListProfiles" form_name="frmProfiles"}
				{btn_clean table_name="Profiles" form_name="frmProfiles"}
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
{droptmpfile table_name=Profiles}
</html>
