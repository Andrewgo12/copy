<html>
{loadlabels table_name=Recurso&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmRecurso" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=recucodigos&blBold=true}</td>
      <td>{textfield id="recucodigos" name="recurso__recucodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=recucodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=recunombres&blBold=true}</td>
      <td>{textfield id="recunombres" name="recurso__recunombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=recunombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=grrecodigos&blBold=true}</td>
      <td>{select_row_table id="grrecodigos" name="recurso__grrecodigos" table_name="gruporecurso" value="grrecodigos" label="grrenombres" is_null="true" sqlid="gruporecurso"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grrecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tirecodigos&blBold=true}</td>
      <td>{select_row_table id="tirecodigos" name="recurso__tirecodigos" table_name="tiporecurso" value="tirecodigos" label="tirenombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tirecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=unmecodigos&blBold=true}</td>
      <td>{select_row_table id="unmecodigos" name="recurso__unmecodigos" table_name="unidadmedida" value="unmecodigos" label="unmenombres" is_null="true" sqlid="unidadmedida"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=unmecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=recudescrips}</td>
      <td>{textarea id="recudescrips" name="recurso__recudescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=recudescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=recuactivas}</td>
      <td>{select_estado id="recuactivas" name="recurso__recuactivas" table="recurso"}</td>
  	<td class="piedefoto">{printcoment name=recuactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddRecurso" form_name="frmRecurso"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateRecurso" form_name="frmRecurso"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteRecurso" form_name="frmRecurso" table="recurso"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListRecurso" form_name="frmRecurso"}
				{btn_clean table_name="Recurso" form_name="frmRecurso"}
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
{droptmpfile table_name=Recurso}

</html>
