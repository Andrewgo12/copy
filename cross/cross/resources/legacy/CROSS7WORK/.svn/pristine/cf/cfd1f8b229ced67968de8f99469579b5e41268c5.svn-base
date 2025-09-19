<html>
{loadlabels table_name=Tipoorden&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipoorden" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{textfield id="tiorcodigos" name="tipoorden__tiorcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiornombres&blBold=true}</td>
      <td>{textfield id="tiornombres" name="tipoorden__tiornombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiornombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiordescrips}</td>
      <td>{textarea id="tiordescrips" name="tipoorden__tiordescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiordescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiorpeson}</td>
      <td>{textfield id="tiorpeson" name="tipoorden__tiorpeson" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=tiorpeson}</td>
   </tr>
   <tr>
      <td>{printlabel name=tioractivos}</td>
      <td>{select_estado id="tioractivos" name="tipoorden__tioractivos" table="tipoorden"}</td>
  	<td class="piedefoto">{printcoment name=tioractivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddTipoorden" form_name="frmTipoorden"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateTipoorden" form_name="frmTipoorden" loadFields="tipoorden__tiorcodigos,tipoorden__tiornombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCrCmdDeleteTipoorden" form_name="frmTipoorden" loadFields="tipoorden__tiorcodigos,tipoorden__tiornombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListTipoorden" form_name="frmTipoorden"}
				{btn_clean table_name="Tipoorden" form_name="frmTipoorden"}
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
{droptmpfile table_name=Tipoorden}
</html>