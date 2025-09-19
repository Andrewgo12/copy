<html>
{loadlabels table_name=Commands&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCommands" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=commnombres&blBold=true}</td>
      <td>{textfield id="commnombres" name="commands__commnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=commnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=applcodigos&blBold=true}</td>
      <td>{select_row_table id="applcodigos" name="commands__applcodigos" table_name="applications" value="applcodigos" label="applnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=applcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=commobservas}</td>
      <td>{textarea id="commobservas" name="commands__commobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=commobservas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddCommands" form_name="frmCommands"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateCommands" form_name="frmCommands"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FePrCmdDeleteCommands" form_name="frmCommands" table="commands"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListCommands" form_name="frmCommands"}
				{btn_clean table_name="Commands" form_name="frmCommands"}
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
{droptmpfile table_name=Commands}

</html>
