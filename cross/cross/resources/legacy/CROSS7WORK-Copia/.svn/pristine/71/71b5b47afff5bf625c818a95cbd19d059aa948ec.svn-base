<html>
{loadlabels table_name=Tipocontrato&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipocontrato" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ticocodigos&blBold=true}</td>
      <td>{textfield id="ticocodigos" name="tipocontrato__ticocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ticocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticonombres&blBold=true}</td>
      <td>{textfield id="ticonombres" name="tipocontrato__ticonombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ticonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticodescrips}</td>
      <td>{textarea id="ticodescrips" name="tipocontrato__ticodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=ticodescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticoactivos}</td>
      <td>{select_estado id="ticoactivos" name="tipocontrato__ticoactivos" table="tipocontrato"}</td>
  	<td class="piedefoto">{printcoment name=ticoactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddTipocontrato" form_name="frmTipocontrato"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateTipocontrato" form_name="frmTipocontrato"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteTipocontrato" form_name="frmTipocontrato" table="tipocontrato"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListTipocontrato" form_name="frmTipocontrato"}
				{btn_clean table_name="Tipocontrato" form_name="frmTipocontrato"}
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
{droptmpfile table_name=Tipocontrato}

</html>
