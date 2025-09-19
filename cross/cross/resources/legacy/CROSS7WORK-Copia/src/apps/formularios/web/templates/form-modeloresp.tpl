<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Modeloresp&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmModeloresp" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=morenombres&blBold=true}</td>
      <td>{textfield id="morenombres" name="modeloresp__morenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=morenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=moredescrips}</td>
      <td>{textarea id="moredescrips" name="modeloresp__moredescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=moredescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddModeloresp" form_name="frmModeloresp"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdateModeloresp" form_name="frmModeloresp" loadFields="modeloresp__morecodigon,modeloresp__morenombres" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeleteModeloresp" form_name="frmModeloresp" loadFields="modeloresp__morecodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListModeloresp" form_name="frmModeloresp"}
				{btn_clean table_name="Modeloresp" form_name="frmModeloresp"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="modeloresp__morecodigon"}
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Modeloresp}
</html>