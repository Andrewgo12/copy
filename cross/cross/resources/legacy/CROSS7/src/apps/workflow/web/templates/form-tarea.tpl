<html>
{loadlabels table_name=Tarea&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTarea" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tarecodigos&blBold=true}</td>
      <td>{textfield id="tarecodigos" name="tarea__tarecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tarecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tarenombres&blBold=true}</td>
      <td>{textfield id="tarenombres" name="tarea__tarenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tarenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
      <td>{select_dataservices service="Human_resources" method="getActiveEntesOrg" id="orgacodigos" name="tarea__orgacodigos" value="orgacodigos" label="organombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=taredescris}</td>
      <td>{textarea id="taredescris" name="tarea__taredescris" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=taredescris}</td>
   </tr>
   <tr>
      <td>{printlabel name=tareactivas}</td>
      <td>{select_estado id="tareactivas" name="tarea__tareactivas" table="tarea"}</td>
  	<td class="piedefoto">{printcoment name=tareactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddTarea" form_name="frmTarea"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateTarea" form_name="frmTarea" loadFields="tarea__tarecodigos,tarea__tarenombres" confirm="9"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeWFCmdDeleteTarea" form_name="frmTarea" loadFields="tarea__tarecodigos,tarea__tarenombres" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListTarea" form_name="frmTarea"}
				{btn_clean table_name="Tarea" form_name="frmTarea"}
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
{droptmpfile table_name=Tarea}
</html>