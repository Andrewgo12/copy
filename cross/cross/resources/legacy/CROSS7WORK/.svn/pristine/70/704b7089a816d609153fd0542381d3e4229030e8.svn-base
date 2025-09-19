<html>
{loadlabels table_name=Condiusuario&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCondiusuario" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=couscodigos&blBold=true}</td>
      <td>{textfield id="couscodigos" name="condiusuario__couscodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=couscodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=cousnombres&blBold=true}</td>
      <td>{textfield id="cousnombres" name="condiusuario__cousnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cousnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=cousdescrips}</td>
      <td>{textarea id="cousdescrips" name="condiusuario__cousdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=cousdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=cousactivos}</td>
      <td>{select_estado id="cousactivos" name="condiusuario__cousactivos" table="condiusuario"}</td>
  	<td class="piedefoto">{printcoment name=cousactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddCondiusuario" form_name="frmCondiusuario"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateCondiusuario" form_name="frmCondiusuario" loadFields="condiusuario__couscodigos,condiusuario__cousnombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteCondiusuario" form_name="frmCondiusuario" loadFields="condiusuario__couscodigos,condiusuario__cousnombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListCondiusuario" form_name="frmCondiusuario"}
				{btn_clean table_name="Condiusuario" form_name="frmCondiusuario"}
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
{droptmpfile table_name=Condiusuario}
</html>