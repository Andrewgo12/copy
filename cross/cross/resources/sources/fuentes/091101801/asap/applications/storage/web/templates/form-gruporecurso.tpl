<html>
{loadlabels table_name=Gruporecurso&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmGruporecurso" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=grrecodigos&blBold=true}</td>
      <td>{textfield id="grrecodigos" name="gruporecurso__grrecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grrecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=grrenombres&blBold=true}</td>
      <td>{textfield id="grrenombres" name="gruporecurso__grrenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grrenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=grredescrips}</td>
      <td>{textarea id="grredescrips" name="gruporecurso__grredescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=grredescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=grreactivas}</td>
      <td>{select_estado id="grreactivas" name="gruporecurso__grreactivas" table="gruporecurso"}</td>
  	<td class="piedefoto">{printcoment name=grreactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddGruporecurso" form_name="frmGruporecurso"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateGruporecurso" form_name="frmGruporecurso"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteGruporecurso" form_name="frmGruporecurso" table="gruporecurso"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListGruporecurso" form_name="frmGruporecurso"}
				{btn_clean table_name="Gruporecurso" form_name="frmGruporecurso"}
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
{droptmpfile table_name=Gruporecurso}

</html>
