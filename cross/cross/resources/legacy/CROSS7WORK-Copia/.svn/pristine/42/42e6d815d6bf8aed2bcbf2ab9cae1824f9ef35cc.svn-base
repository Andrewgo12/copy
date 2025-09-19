<html>
{loadlabels table_name=Tipocliente&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipocliente" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ticlcodigos&blBold=true}</td>
      <td>{textfield id="ticlcodigos" name="tipocliente__ticlcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ticlcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticlnombres&blBold=true}</td>
      <td>{textfield id="ticlnombres" name="tipocliente__ticlnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ticlnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticldescrips}</td>
      <td>{textarea id="ticldescrips" name="tipocliente__ticldescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=ticldescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticlactivos}</td>
      <td>{select_estado id="ticlactivos" name="tipocliente__ticlactivos" table="tipocliente"}</td>
  	<td class="piedefoto">{printcoment name=ticlactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddTipocliente" form_name="frmTipocliente"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateTipocliente" form_name="frmTipocliente" loadFields="tipocliente__ticlcodigos,tipocliente__ticlnombres" confirm="8"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteTipocliente" form_name="frmTipocliente" loadFields="tipocliente__ticlcodigos,tipocliente__ticlnombres" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListTipocliente" form_name="frmTipocliente"}
				{btn_clean table_name="Tipocliente" form_name="frmTipocliente"}
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
{droptmpfile table_name=Tipocliente}

</html>
