<html>
{loadlabels table_name=Proveerecurs&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmProveerecurs" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=prrecodigos&blBold=true}</td>
      <td>{textfield id="prrecodigos" name="proveerecurs__prrecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=prrecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=provcodigos&blBold=true}</td>
      <td>{select_row_table id="provcodigos" name="proveerecurs__provcodigos" table_name="proveedor" value="provcodigos" label="provnombres" is_null="true" sqlid="proveedor"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=provcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=recucodigos&blBold=true}</td>
      <td>{select_row_table id="recucodigos" name="proveerecurs__recucodigos" table_name="recurso" value="recucodigos" label="recunombres" is_null="true" sqlid="recurso"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=recucodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=prrevalorecf}</td>
      <td>{textfield id="prrevalorecf" name="proveerecurs__prrevalorecf" maxlength="NaN" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=prrevalorecf}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddProveerecurs" form_name="frmProveerecurs"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateProveerecurs" form_name="frmProveerecurs"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteProveerecurs" form_name="frmProveerecurs" table="proveerecurs"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListProveerecurs" form_name="frmProveerecurs"}
				{btn_clean table_name="Proveerecurs" form_name="frmProveerecurs"}
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
{droptmpfile table_name=Proveerecurs}

</html>
