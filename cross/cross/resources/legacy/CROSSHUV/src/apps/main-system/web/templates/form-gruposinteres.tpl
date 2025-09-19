<html>
{loadlabels table_name=Gruposinteres&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmGruposinteres" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=grincodigos&blBold=true}</td>
      <td>{textfield id="grincodigos" name="gruposinteres__grincodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grincodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=grinnombres&blBold=true}</td>
      <td>{textfield id="grinnombres" name="gruposinteres__grinnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grinnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=grindescrips}</td>
      <td>{textarea id="grindescrips" name="gruposinteres__grindescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=grindescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=grinactivos}</td>
      <td>{select_estado id="grinactivos" name="gruposinteres__grinactivos" table="gruposinteres"}</td>
  	<td class="piedefoto">{printcoment name=grinactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddGruposinteres" form_name="frmGruposinteres"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateGruposinteres" form_name="frmGruposinteres" loadFields="gruposinteres__grincodigos,gruposinteres__grinnombres" confirm="8"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeleteGruposinteres" form_name="frmGruposinteres" loadFields="gruposinteres__grincodigos,gruposinteres__grinnombres" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListGruposinteres" form_name="frmGruposinteres"}
				{btn_clean table_name="Gruposinteres" form_name="frmGruposinteres"}
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
{droptmpfile table_name=Gruposinteres}

</html>