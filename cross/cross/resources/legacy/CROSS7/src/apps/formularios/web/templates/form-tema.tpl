<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Tema&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTema" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
      <td>{printlabel name=ejtecodigon&blBold=true}</td>
      <td>{select_row_table id="ejtecodigon" name="tema__ejtecodigon" table_name="ejetematico" value="ejtecodigon" label="ejtenombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ejtecodigon}</td>
   </tr>	
   <tr>
      <td>{printlabel name=temanombres&blBold=true}</td>
      <td>{textfield id="temanombres" name="tema__temanombres" maxlength="255"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=temanombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=temadescrips}</td>
      <td>{textarea id="temadescrips" name="tema__temadescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=temadescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddTema" form_name="frmTema"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdateTema" form_name="frmTema" loadFields="tema__temacodigon,tema__temanombres,tema__ejtecodigon" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeleteTema" form_name="frmTema" loadFields="tema__temacodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListTema" form_name="frmTema"}
				{btn_clean table_name="Tema" form_name="frmTema"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="tema__temacodigon"}
{hidden name="action"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Tema}
</html>