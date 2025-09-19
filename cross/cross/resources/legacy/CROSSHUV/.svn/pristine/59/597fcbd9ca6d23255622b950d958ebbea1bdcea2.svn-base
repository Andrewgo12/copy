<html>
{loadlabels table_name=Applications&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmApplications" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=applcodigos&blBold=true}</td>
      <td>{textfield id="applcodigos" name="applications__applcodigos" maxlength="10"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=applcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=applnombres&blBold=true}</td>
      <td>{textfield id="applnombres" name="applications__applnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=applnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=applobservas}</td>
      <td>{textarea id="applobservas" name="applications__applobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=applobservas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddApplications" form_name="frmApplications"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateApplications" form_name="frmApplications"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FePrCmdDeleteApplications" form_name="frmApplications" table="applications"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListApplications" form_name="frmApplications"}
				{btn_clean table_name="Applications" form_name="frmApplications"}
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
{droptmpfile table_name=Applications}

</html>
