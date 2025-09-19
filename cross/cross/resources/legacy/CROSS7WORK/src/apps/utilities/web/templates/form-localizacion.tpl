<html>
{loadlabels table_name=Localizacion&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsLoadSelect.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmLocalizacion" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=locacodigos&blBold=true}</td>
      <td>{textfield id="locacodigos" name="localizacion__locacodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=locanombres&blBold=true}</td>
      <td>{textfield id="locanombres" name="localizacion__locanombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=locanombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=locadescrips}</td>
      <td>{textarea id="locadescrips" name="localizacion__locadescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=locadescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=locacodpadrs}</td>
      <td>{select_row_table id="locacodpadrs" name="localizacion__locacodpadrs" sqlid="localizacion" table_name="localizacion" label="locanombres" value="locacodigos" is_null="true"
      onchange="LoadSelect('tipolocaliza','locacodpadrs',Array(this),this.form.localizacion__tilocodigos)" param="localizacion__locacodpadrs"}</td>
  	<td class="piedefoto">{printcoment name=locacodpadrs}</td>
   </tr>
   <tr>
      <td>{printlabel name=tilocodigos&blBold=true}</td>
      <td>{select_row_table id="tilocodigos" name="localizacion__tilocodigos" sqlid="tipolocaliza" table_name="tipolocaliza" label="tilonombres" value="tilocodigos" is_null="true" param="localizacion__locacodpadrs"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tilocodigos}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=locaordenn}</td>
      <td>{textfield id="locaordenn" name="localizacion__locaordenn" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=locaordenn}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=locazonas}</td>
      <td>{textfield id="locazonas" name="localizacion__locazonas" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=locazonas}</td>
   </tr>
   <tr>
      <td>{printlabel name=locaestados}</td>
      <td>{select_estado id="locaestados" name="localizacion__locaestados" table="localizacion"}</td>
  	<td class="piedefoto">{printcoment name=locaestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddLocalizacion" form_name="frmLocalizacion"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateLocalizacion" form_name="frmLocalizacion" loadFields="localizacion__locacodigos,localizacion__locanombres,localizacion__tilocodigos" confirm="46"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeGeCmdDeleteLocalizacion" form_name="frmLocalizacion" loadFields="localizacion__locacodigos,localizacion__locanombres,localizacion__tilocodigos" confirm="47"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeGeCmdShowListLocalizacion" form_name="frmLocalizacion"}
				{btn_clean table_name="Localizacion" form_name="frmLocalizacion"}
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
{droptmpfile table_name=Localizacion}
</html>