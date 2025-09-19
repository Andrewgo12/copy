<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Respuestausu&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmRespuestausu" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=usuacodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=usuacodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=formcodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=formcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=pregcodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=pregcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=reuscodigon}</td>
      <td><B>*</B></td>
  	<td class="piedefoto">{printcoment name=reuscodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=varecodigon}</td>
      <td>{textfield id="varecodigon" name="respuestausu__varecodigon" maxlength="8" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=varecodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=respcodigon}</td>
      <td>{textfield id="respcodigon" name="respuestausu__respcodigon" maxlength="8" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=respcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=reusvalorabis}</td>
      <td>{textarea id="reusvalorabis" name="respuestausu__reusvalorabis" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=reusvalorabis}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="TeEnCmdAdd" name="CmdAddRespuestausu" form_name="frmRespuestausu"}
				{btn_command type="button" value="Modificar" id="TeEnCmdUpdate" name="CmdUpdateRespuestausu" form_name="frmRespuestausu"}
				{btn_clean table_name="Respuestausu" form_name="frmRespuestausu"}
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
{droptmpfile table_name=Respuestausu}


</html>
