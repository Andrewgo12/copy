<html>
{loadlabels table_name=Tipoexamen&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipoexamen" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiexcodigos&blBold=true}</td>
      <td>{textfield id="tiexcodigos" name="tipoexamen__tiexcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiexcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiexnombres&blBold=true}</td>
      <td>{textfield id="tiexnombres" name="tipoexamen__tiexnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiexnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiexdescrips}</td>
      <td>{textarea id="tiexdescrips" name="tipoexamen__tiexdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiexdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiexactivos}</td>
      <td>{select_estado id="tiexactivos" name="tipoexamen__tiexactivos" table="tipoexamen"}</td>
  	<td class="piedefoto">{printcoment name=tiexactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddTipoexamen" form_name="frmTipoexamen"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateTipoexamen" form_name="frmTipoexamen" loadFields="tipoexamen__tiexcodigos,tipoexamen__tiexnombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteTipoexamen" form_name="frmTipoexamen" loadFields="tipoexamen__tiexcodigos,tipoexamen__tiexnombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListTipoexamen" form_name="frmTipoexamen"}
				{btn_clean table_name="Tipoexamen" form_name="frmTipoexamen"}
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
{droptmpfile table_name=Tipoexamen}
</html>