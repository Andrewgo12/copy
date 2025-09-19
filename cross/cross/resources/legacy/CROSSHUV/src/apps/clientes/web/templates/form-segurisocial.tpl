<html>
{loadlabels table_name=Segurisocial&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmSegurisocial" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=sesocodigos&blBold=true}</td>
      <td>{textfield id="sesocodigos" name="segurisocial__sesocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=sesocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=sesonombres&blBold=true}</td>
      <td>{textfield id="sesonombres" name="segurisocial__sesonombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=sesonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=sesodescrips}</td>
      <td>{textarea id="sesodescrips" name="segurisocial__sesodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=sesodescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=sesoactivos}</td>
      <td>{select_estado id="sesoactivos" name="segurisocial__sesoactivos" table="segurisocial"}</td>
  	<td class="piedefoto">{printcoment name=sesoactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddSegurisocial" form_name="frmSegurisocial"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateSegurisocial" form_name="frmSegurisocial" loadFields="segurisocial__sesocodigos,segurisocial__sesonombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteSegurisocial" form_name="frmSegurisocial" loadFields="segurisocial__sesocodigos,segurisocial__sesonombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListSegurisocial" form_name="frmSegurisocial"}
				{btn_clean table_name="Segurisocial" form_name="frmSegurisocial"}
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
{droptmpfile table_name=Segurisocial}
</html>