<html>
{loadlabels table_name=Tipoidentifi&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipoidentifi" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiidcodigos&blBold=true}</td>
      <td>{textfield id="tiidcodigos" name="tipoidentifi__tiidcodigos" maxlength="2"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiidcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiidnombres&blBold=true}</td>
      <td>{textfield id="tiidnombres" name="tipoidentifi__tiidnombres" maxlength="22"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiidnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiiddescrips}</td>
      <td>{textarea id="tiiddescrips" name="tipoidentifi__tiiddescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiiddescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiidactivas}</td>
      <td>{select_estado id="tiidactivas" name="tipoidentifi__tiidactivas" table="tipoidentifi"}</td>
  	<td class="piedefoto">{printcoment name=tiidactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddTipoidentifi" form_name="frmTipoidentifi"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateTipoidentifi" form_name="frmTipoidentifi" loadFields="tipoidentifi__tiidcodigos,tipoidentifi__tiidnombres" confirm="8"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteTipoidentifi" form_name="frmTipoidentifi" loadFields="tipoidentifi__tiidcodigos,tipoidentifi__tiidnombres" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListTipoidentifi" form_name="frmTipoidentifi"}
				{btn_clean table_name="Tipoidentifi" form_name="frmTipoidentifi"}
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
{droptmpfile table_name=Tipoidentifi}

</html>
