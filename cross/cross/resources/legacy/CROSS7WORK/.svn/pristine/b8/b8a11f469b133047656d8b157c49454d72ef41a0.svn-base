<html>
{loadlabels table_name=Cargo&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCargo" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=cargcodigos&blBold=true}</td>
      <td>{textfield id="cargcodigos" name="cargo__cargcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cargcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=cargnombres&blBold=true}</td>
      <td>{textfield id="cargnombres" name="cargo__cargnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cargnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=cargdescrips}</td>
      <td>{textfield id="cargdescrips" name="cargo__cargdescrips" maxlength="150"}</td>
  	<td class="piedefoto">{printcoment name=cargdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=cargactivas}</td>
      <td>{select_estado id="cargactivas" name="cargo__cargactivas" table="cargo"}</td>
  	<td class="piedefoto">{printcoment name=cargactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddCargo" form_name="frmCargo"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateCargo" form_name="frmCargo" loadFields="cargo__cargcodigos,cargo__cargnombres" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteCargo" form_name="frmCargo" loadFields="cargo__cargcodigos,cargo__cargnombres" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListCargo" form_name="frmCargo"}
				{btn_clean table_name="Cargo" form_name="frmCargo"}
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
{droptmpfile table_name=Cargo}

</html>
