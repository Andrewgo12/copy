<html>
{loadlabels table_name=Tipomoneda&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipomoneda" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=timocodigos&blBold=true}</td>
      <td>{textfield id="timocodigos" name="tipomoneda__timocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=timocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=timonombres&blBold=true}</td>
      <td>{textfield id="timonombres" name="tipomoneda__timonombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=timonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=timoequivaln}</td>
      <td>{textfield id="timoequivaln" name="tipomoneda__timoequivaln" maxlength="NaN" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=timoequivaln}</td>
   </tr>
   <tr>
      <td>{printlabel name=timodescrips}</td>
      <td>{textarea id="timodescrips" name="tipomoneda__timodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=timodescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=timoactivas}</td>
      <td>{select_estado id="timoactivas" name="tipomoneda__timoactivas" table="tipomoneda"}</td>
  	<td class="piedefoto">{printcoment name=timoactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddTipomoneda" form_name="frmTipomoneda"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateTipomoneda" form_name="frmTipomoneda"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteTipomoneda" form_name="frmTipomoneda" table="tipomoneda"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListTipomoneda" form_name="frmTipomoneda"}
				{btn_clean table_name="Tipomoneda" form_name="frmTipomoneda"}
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
{droptmpfile table_name=Tipomoneda}

</html>
