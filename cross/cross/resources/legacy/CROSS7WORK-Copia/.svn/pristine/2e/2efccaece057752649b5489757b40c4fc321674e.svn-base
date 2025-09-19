<html>
{loadlabels table_name=Tipoorgani&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipoorgani" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{textfield id="tiorcodigos" name="tipoorgani__tiorcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiornombres&blBold=true}</td>
      <td>{textfield id="tiornombres" name="tipoorgani__tiornombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiornombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiordesc}</td>
      <td>{textarea id="tiordesc" name="tipoorgani__tiordesc" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tiordesc}</td>
   </tr>
   <tr>
      <td>{printlabel name=tioractivos}</td>
      <td>{select_estado id="tioractivos" name="tipoorgani__tioractivos" table="tipoorgani"}</td>
  	<td class="piedefoto">{printcoment name=tioractivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddTipoorgani" form_name="frmTipoorgani"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateTipoorgani" form_name="frmTipoorgani" loadFields="tipoorgani__tiorcodigos,tipoorgani__tiornombres" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteTipoorgani" form_name="frmTipoorgani" loadFields="tipoorgani__tiorcodigos,tipoorgani__tiornombres" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListTipoorgani" form_name="frmTipoorgani"}
				{btn_clean table_name="Tipoorgani" form_name="frmTipoorgani"}
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
{droptmpfile table_name=Tipoorgani}

</html>
