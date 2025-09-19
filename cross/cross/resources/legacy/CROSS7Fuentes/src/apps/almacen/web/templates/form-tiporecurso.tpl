<html>
{loadlabels table_name=Tiporecurso&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTiporecurso" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tirecodigos&blBold=true}</td>
      <td>{textfield id="tirecodigos" name="tiporecurso__tirecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tirecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tirenombres&blBold=true}</td>
      <td>{textfield id="tirenombres" name="tiporecurso__tirenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tirenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiredescrips}</td>
      <td>{textarea id="tiredescrips" name="tiporecurso__tiredescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiredescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddTiporecurso" form_name="frmTiporecurso"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateTiporecurso" form_name="frmTiporecurso"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteTiporecurso" form_name="frmTiporecurso"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListTiporecurso" form_name="frmTiporecurso"}
				{btn_clean table_name="Tiporecurso" form_name="frmTiporecurso"}
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
{droptmpfile table_name=Tiporecurso}

</html>
