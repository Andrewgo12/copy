<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Pregformula&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPregformula" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=pregcodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=pregcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=formcodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=formcodigon}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="TeEnCmdAdd" name="CmdAddPregformula" form_name="frmPregformula"}
				{btn_command type="button" value="Modificar" id="TeEnCmdUpdate" name="CmdUpdatePregformula" form_name="frmPregformula"}
				{btn_clean table_name="Pregformula" form_name="frmPregformula"}
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
{droptmpfile table_name=Pregformula}


</html>
