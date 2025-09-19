<html>
{loadlabels table_name=Proveedor&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmProveedor" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=provcodigos&blBold=true}</td>
      <td>{textfield id="provcodigos" name="proveedor__provcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=provcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=provnombres&blBold=true}</td>
      <td>{textfield id="provnombres" name="proveedor__provnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=provnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=provnnomreprs}</td>
      <td>{textfield id="provnnomreprs" name="proveedor__provnnomreprs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=provnnomreprs}</td>
   </tr>
   <tr>
      <td>{printlabel name=provdireccis}</td>
      <td>{textfield id="provdireccis" name="proveedor__provdireccis" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=provdireccis}</td>
   </tr>
   <tr>
      <td>{printlabel name=protelefons}</td>
      <td>{textfield id="protelefons" name="proveedor__protelefons" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=protelefons}</td>
   </tr>
   <tr>
      <td>{printlabel name=provemails}</td>
      <td>{textfield id="provemails" name="proveedor__provemails" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=provemails}</td>
   </tr>
   <tr>
      <td>{printlabel name=provwebs}</td>
      <td>{textfield id="provwebs" name="proveedor__provwebs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=provwebs}</td>
   </tr>
   <tr>
      <td>{printlabel name=paiscodigos}</td>
      <td>{textfield id="paiscodigos" name="proveedor__paiscodigos" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=paiscodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=depacodigos}</td>
      <td>{textfield id="depacodigos" name="proveedor__depacodigos" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=depacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=ciudcodigos}</td>
      <td>{textfield id="ciudcodigos" name="proveedor__ciudcodigos" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=ciudcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=provactivas}</td>
      <td>{select_estado id="provactivas" name="proveedor__provactivas" table="proveedor"}</td>
  	<td class="piedefoto">{printcoment name=provactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddProveedor" form_name="frmProveedor"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateProveedor" form_name="frmProveedor"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteProveedor" form_name="frmProveedor" table="proveedor"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListProveedor" form_name="frmProveedor"}
				{btn_clean table_name="Proveedor" form_name="frmProveedor"}
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
{droptmpfile table_name=Proveedor}

</html>
