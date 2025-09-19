<html>
{loadlabels table_name=Formapago&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFormapago" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=fopacodigos&blBold=true}</td>
      <td>{textfield id="fopacodigos" name="formapago__fopacodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=fopacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopanombres&blBold=true}</td>
      <td>{textfield id="fopanombres" name="formapago__fopanombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=fopanombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopatiempon}</td>
      <td>{textfield id="fopatiempon" name="formapago__fopatiempon" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=fopatiempon}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopacancuotn}</td>
      <td>{textfield id="fopacancuotn" name="formapago__fopacancuotn" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=fopacancuotn}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopadescrips}</td>
      <td>{textarea id="fopadescrips" name="formapago__fopadescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=fopadescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopaactivos}</td>
      <td>{select_estado id="fopaactivos" name="formapago__fopaactivos" table="formapago"}</td>
  	<td class="piedefoto">{printcoment name=fopaactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddFormapago" form_name="frmFormapago"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateFormapago" form_name="frmFormapago"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteFormapago" form_name="frmFormapago" table="formapago"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListFormapago" form_name="frmFormapago"}
				{btn_clean table_name="Formapago" form_name="frmFormapago"}
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
{droptmpfile table_name=Formapago}

</html>
