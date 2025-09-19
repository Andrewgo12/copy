<html>
{loadlabels table_name=Estadoclient&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEstadoclient" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=esclcodigos&blBold=true}</td>
      <td>{textfield id="esclcodigos" name="estadoclient__esclcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esclcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=esclnombres&blBold=true}</td>
      <td>{textfield id="esclnombres" name="estadoclient__esclnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esclnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=escldescrips}</td>
      <td>{textarea id="escldescrips" name="estadoclient__escldescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=escldescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=esclactivos}</td>
      <td>{select_estado id="esclactivos" name="estadoclient__esclactivos" table="estadoclient"}</td>
      <td class="piedefoto">{printcoment name=esclactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddEstadoclient" form_name="frmEstadoclient"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateEstadoclient" form_name="frmEstadoclient" loadFields="estadoclient__esclcodigos,estadoclient__esclnombres" confirm="8"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteEstadoclient" form_name="frmEstadoclient" loadFields="estadoclient__esclcodigos,estadoclient__esclnombres" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListEstadoclient" form_name="frmEstadoclient"}
				{btn_clean table_name="Estadoclient" form_name="frmEstadoclient"}
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
{droptmpfile table_name=Estadoclient}

</html>
