<html>
{loadlabels table_name=Style&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmStyle" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><B>{printlabel name=stylcodigos}</B></td>
      <td>{textfield id="stylcodigos" name="style__stylcodigos" maxlength="10"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=stylcodigos}</td>
   </tr>
   <tr>
      <td><B>{printlabel name=applcodigos}</B></td>
      <td>{select_row_table id="applcodigos" name="style__applcodigos" table_name="applications" value="applcodigos" label="applnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=applcodigos}</td>
   </tr>
   <tr>
      <td><B>{printlabel name=stylnombres}</B></td>
      <td>{textfield id="stylnombres" name="style__stylnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=stylnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=stylobservas}</td>
      <td>{textarea id="stylobservas" name="style__stylobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=stylobservas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddStyle" form_name="frmStyle"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateStyle" form_name="frmStyle"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FePrCmdDeleteStyle" form_name="frmStyle" table="style"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListStyle" form_name="frmStyle"}
				{btn_clean table_name="Style" form_name="frmStyle"}
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
{droptmpfile table_name=Style}

</html>
