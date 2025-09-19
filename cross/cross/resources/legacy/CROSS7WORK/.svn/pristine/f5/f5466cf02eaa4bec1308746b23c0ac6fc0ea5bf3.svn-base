<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Ejetematico&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEjetematico" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ejtenombres&blBold=true}</td>
      <td>{textfield id="ejtenombres" name="ejetematico__ejtenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ejtenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=ejtedescrips}</td>
      <td>{textarea id="ejtedescrips" name="ejetematico__ejtedescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=ejtedescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddEjetematico" form_name="frmEjetematico"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdateEjetematico" form_name="frmEjetematico" loadFields="ejetematico__ejtecodigon,ejetematico__ejtenombres" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeleteEjetematico" form_name="frmEjetematico" loadFields="ejetematico__ejtecodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListEjetematico" form_name="frmEjetematico"}
				{btn_clean table_name="Ejetematico" form_name="frmEjetematico"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="ejetematico__ejtecodigon"}
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Ejetematico}
</html>