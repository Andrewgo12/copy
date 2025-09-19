<html>
{loadlabels table_name=Estadoacta&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEstadoacta" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=esaccodigos&blBold=true}</td>
      <td>{textfield id="esaccodigos" name="estadoacta__esaccodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esaccodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=esacnombres&blBold=true}</td>
      <td>{textfield id="esacnombres" name="estadoacta__esacnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esacnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=esacdescrips}</td>
      <td>{textarea id="esacdescrips" name="estadoacta__esacdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=esacdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=esacactivas}</td>
      <td>{select_estado id="esacactivas" name="estadoacta__esacactivas" table="estadoacta"}</td>
  	<td class="piedefoto">{printcoment name=esacactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddEstadoacta" form_name="frmEstadoacta"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateEstadoacta" form_name="frmEstadoacta" loadFields="estadoacta__esaccodigos,estadoacta__esacnombres" confirm="9"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeWFCmdDeleteEstadoacta" form_name="frmEstadoacta" loadFields="estadoacta__esaccodigos,estadoacta__esacnombres" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListEstadoacta" form_name="frmEstadoacta"}
				{btn_clean table_name="Estadoacta" form_name="frmEstadoacta"}
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
{droptmpfile table_name=Estadoacta}
</html>