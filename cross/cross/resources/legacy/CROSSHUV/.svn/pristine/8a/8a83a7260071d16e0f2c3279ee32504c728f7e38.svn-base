<html>
{loadlabels table_name=Unidadmedida&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmUnidadmedida" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=unmecodigos&blBold=true}</td>
      <td>{textfield id="unmecodigos" name="unidadmedida__unmecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=unmecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=unmenombres&blBold=true}</td>
      <td>{textfield id="unmenombres" name="unidadmedida__unmenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=unmenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=unmesiglas&blBold=true}</td>
      <td>{textfield id="unmesiglas" name="unidadmedida__unmesiglas" maxlength="10"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=unmesiglas}</td>
   </tr>
   <tr>
      <td>{printlabel name=unmedescrips}</td>
      <td>{textarea id="unmedescrips" name="unidadmedida__unmedescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=unmedescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=unmeactivas}</td>
      <td>{select_estado id="unmeactivas" name="unidadmedida__unmeactivas" table="unidadmedida"}</td>
  	<td class="piedefoto">{printcoment name=unmeactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddUnidadmedida" form_name="frmUnidadmedida"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateUnidadmedida" form_name="frmUnidadmedida"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteUnidadmedida" form_name="frmUnidadmedida" table="unidadmedida"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListUnidadmedida" form_name="frmUnidadmedida"}
				{btn_clean table_name="Unidadmedida" form_name="frmUnidadmedida"}
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
{droptmpfile table_name=Unidadmedida}

</html>
