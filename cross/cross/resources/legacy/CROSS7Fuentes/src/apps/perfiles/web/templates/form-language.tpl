<html>
{loadlabels table_name=Language&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmLanguage" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=langcodigos&blBold=true}</td>
      <td>{textfield id="langcodigos" name="language__langcodigos" maxlength="10"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=langcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=langnombres&blBold=true}</td>
      <td>{textfield id="langnombres" name="language__langnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=langnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=langobservas}</td>
      <td>{textarea id="langobservas" name="language__langobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=langobservas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddLanguage" form_name="frmLanguage"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateLanguage" form_name="frmLanguage"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FePrCmdDeleteLanguage" form_name="frmLanguage" table="language"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListLanguage" form_name="frmLanguage"}
				{btn_clean table_name="Language" form_name="frmLanguage"}
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
{droptmpfile table_name=Language}

</html>
