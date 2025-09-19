<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Formulario&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFormulario" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=formnombres&blBold=true}</td>
      <td>{textfield id="formnombres" name="formulario__formnombres" size="100" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=formnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=formfeccrean&blBold=true}</td>
      <td>{calendar id="formfeccrean" name="formulario__formfeccrean" form_name ="frmFormulario" hour="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=formfeccrean}</td>
   </tr>
   <tr>
      <td>{printlabel name=formintrodus}</td>
      <td>{textarea id="formintrodus" name="formulario__formintrodus" cols="100" rows="3" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=formintrodus}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=formpredets}</td>
      <td>{select_constant name="formulario__formpredets" id="EST_FORM" labelfont="formulario" is_null="true"}
      </td>
  	<td class="piedefoto">{printcoment name=formpredets}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=formactivos}</td>
      <td>{select_estado id="formactivos" name="formulario__formactivos" table="formulario"}</td>
  	<td class="piedefoto">{printcoment name=formactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddFormulario" form_name="frmFormulario"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdateFormulario" form_name="frmFormulario" loadFields="formulario__formcodigon,formulario__formnombres" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeleteFormulario" form_name="frmFormulario" loadFields="formulario__formcodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListFormulario" form_name="frmFormulario"}
				{btn_clean table_name="Formulario" form_name="frmFormulario"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="formulario__formcodigon"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Formulario}
</html>