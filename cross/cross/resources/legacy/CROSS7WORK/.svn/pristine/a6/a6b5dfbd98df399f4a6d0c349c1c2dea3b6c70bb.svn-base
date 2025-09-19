<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Categoria&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCategoria" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	{viewListaGenerica sbTabla='Categoria' sbLlave='catecodigon' sbLabel='catenombres'}
   
   <tr>
      <td>{printlabel name=catenombres}</td>
      <td>{textfield id="catenombres" name="categoria__catenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=catenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=catedescris}</td>
      <td>{textarea id="catedescris" name="categoria__catedescris" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=catedescris}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeScCmdAddCategoria" form_name="frmCategoria"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeScCmdUpdateCategoria" form_name="frmCategoria"}
				{btn_clean table_name="Categoria" form_name="frmCategoria"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="categoria__catecodigon"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Categoria}


</html>
