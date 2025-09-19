<html>
{loadlabels table_name=Tipoarchivo&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipoarchivo" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiarcodigos&blBold=true}</td>
      <td>{textfield id="tiarcodigos" name="tipoarchivo__tiarcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiarcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiarnombres&blBold=true}</td>
      <td>{textfield id="tiarnombres" name="tipoarchivo__tiarnombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiarnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiarobservas}</td>
      <td>{textarea id="tiarobservas" name="tipoarchivo__tiarobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiarobservas}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiarestados}</td>
      <td>{select_estado id="tiarestados" name="tipoarchivo__tiarestados" table="tipoarchivo"}</td>
  	<td class="piedefoto">{printcoment name=tiarestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateTipoarchivo" form_name="frmTipoarchivo"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" table="tipoarchivo" name="FeGeCmdDeleteTipoarchivo" form_name="frmTipoarchivo"}
				{btn_clean table_name="Tipoarchivo" form_name="frmTipoarchivo"}
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
{droptmpfile table_name=Tipoarchivo}
</html>