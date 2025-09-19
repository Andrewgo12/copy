<html>
{loadlabels table_name=Mediorecepcion&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmMediorecepcion" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=merecodigos&blBold=true}</td>
      <td>{textfield id="merecodigos" name="mediorecepcion__merecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=merecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=merenombres&blBold=true}</td>
      <td>{textfield id="merenombres" name="mediorecepcion__merenombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=merenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=mereescrips}</td>
      <td>{textarea id="mereescrips" name="mediorecepcion__mereescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=mereescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=mereactivos}</td>
      <td>{select_estado id="mereactivos" name="mediorecepcion__mereactivos" table="mediorecepcion"}</td>
  	<td class="piedefoto">{printcoment name=mereactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center"> 
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddMediorecepcion" form_name="frmMediorecepcion"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateMediorecepcion" form_name="frmMediorecepcion" loadFields="mediorecepcion__merecodigos,mediorecepcion__merenombres" confirm="33"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeleteMediorecepcion" form_name="frmMediorecepcion" loadFields="mediorecepcion__merecodigos,mediorecepcion__merenombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListMediorecepcion" form_name="frmMediorecepcion"}
				{btn_clean table_name="Mediorecepcion" form_name="frmMediorecepcion"}
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
{droptmpfile table_name=Mediorecepcion}

</html>
