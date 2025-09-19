<html>
{loadlabels table_name=Prioridad&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPrioridad" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=priocodigos&blBold=true}</td>
      <td>{textfield id="priocodigos" name="prioridad__priocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=priocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=prionombres&blBold=true}</td>
      <td>{textfield id="prionombres" name="prioridad__prionombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=prionombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=priodescrips}</td>
      <td>{textarea id="priodescrips" name="prioridad__priodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=priodescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=prioactivas}</td>
      <td>{select_estado id="prioactivas" name="prioridad__prioactivas" table="prioridad"}</td>
  	<td class="piedefoto">{printcoment name=prioactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddPrioridad" form_name="frmPrioridad"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdatePrioridad" form_name="frmPrioridad" loadFields="prioridad__priocodigos,prioridad__prionombres" confirm="33"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeletePrioridad" form_name="frmPrioridad" loadFields="prioridad__priocodigos,prioridad__prionombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListPrioridad" form_name="frmPrioridad"}
				{btn_clean table_name="Prioridad" form_name="frmPrioridad"}
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
{droptmpfile table_name=Prioridad}
</html>