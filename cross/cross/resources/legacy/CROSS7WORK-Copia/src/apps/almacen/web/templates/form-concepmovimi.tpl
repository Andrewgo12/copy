<html>
{loadlabels table_name=Concepmovimi&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmConcepmovimi" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=comocodigos&blBold=true}</td>
      <td>{textfield id="comocodigos" name="concepmovimi__comocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=comocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=comonombres&blBold=true}</td>
      <td>{textfield id="comonombres" name="concepmovimi__comonombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=comonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=comosentidos&blBold=true}</td>
      <td>{select_sentido}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=comosentidos}</td>
   </tr>
   <tr>
      <td>{printlabel name=comodescrips}</td>
      <td>{textarea id="comodescrips" name="concepmovimi__comodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=comodescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=comoactivas}</td>
      <td>{select_estado id="comoactivas" name="concepmovimi__comoactivas" table="concepmovimi"}</td>
  	<td class="piedefoto">{printcoment name=comoactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddConcepmovimi" form_name="frmConcepmovimi"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateConcepmovimi" form_name="frmConcepmovimi"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteConcepmovimi" form_name="frmConcepmovimi" table="concepmovimi"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListConcepmovimi" form_name="frmConcepmovimi"}
				{btn_clean table_name="Concepmovimi" form_name="frmConcepmovimi"}
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
{droptmpfile table_name=Concepmovimi}

</html>
