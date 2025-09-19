<html>
{loadlabels table_name=Tipolocaliza&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipolocaliza" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tilocodigos&blBold=true}</td>
      <td>{textfield id="tilocodigos" name="tipolocaliza__tilocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tilocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tilonombres&blBold=true}</td>
      <td>{textfield id="tilonombres" name="tipolocaliza__tilonombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tilonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tilodesc}</td>
      <td>{textarea id="tilodesc" name="tipolocaliza__tilodesc" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tilodesc}</td>
   </tr>
   <tr>
      <td>{printlabel name=tilocodpadrs}</td>
      <td>{select_row_father father="tilocodpadrs" id="tilocodpadrs" name="tipolocaliza__tilocodpadrs" sqlid="tipolocalizaall" table_name="tipolocaliza" value="tilocodigos" label="tilonombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=tilocodpadrs}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=tiloimagens}</td>
      <td>{textfield id="tiloimagens" name="tipolocaliza__tiloimagens" maxlength="200"}</td>
  	<td class="piedefoto">{printcoment name=tiloimagens}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=tiloestados}</td>
      <td>{select_estado id="tiloestados" name="tipolocaliza__tiloestados" table="tipolocaliza"}</td>
  	<td class="piedefoto">{printcoment name=tiloestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddTipolocaliza" form_name="frmTipolocaliza"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateTipolocaliza" form_name="frmTipolocaliza" loadFields="tipolocaliza__tilocodigos,tipolocaliza__tilonombres" confirm="46"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeGeCmdDeleteTipolocaliza" form_name="frmTipolocaliza" loadFields="tipolocaliza__tilocodigos,tipolocaliza__tilonombres" confirm="47"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeGeCmdShowListTipolocaliza" form_name="frmTipolocaliza"}
				{btn_clean table_name="Tipolocaliza" form_name="frmTipolocaliza"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message param=$param}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Tipolocaliza}
</html>