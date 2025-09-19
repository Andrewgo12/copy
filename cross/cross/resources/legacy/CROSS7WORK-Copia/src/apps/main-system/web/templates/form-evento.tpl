<html>
{loadlabels table_name=Evento&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEvento" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{select_row_table id="tiorcodigos" sqlid="tipoorden" name="evento__tiorcodigos" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=evencodigos&blBold=true}</td>
      <td>{textfield id="evencodigos" name="evento__evencodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=evencodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=evennombres&blBold=true}</td>
      <td>{textfield id="evennombres" name="evento__evennombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=evennombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=evendescrips}</td>
      <td>{textarea id="evendescrips" name="evento__evendescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=evendescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=evenactivos}</td>
      <td>{select_estado id="evenactivos" name="evento__evenactivos" table="evento"}</td>
  	<td class="piedefoto">{printcoment name=evenactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddEvento" form_name="frmEvento"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateEvento" form_name="frmEvento" loadFields="evento__evencodigos,evento__evennombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCrCmdDeleteEvento" form_name="frmEvento" loadFields="evento__evencodigos,evento__evennombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListEvento" form_name="frmEvento"}
				{btn_clean table_name="Evento" form_name="frmEvento"}
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
{droptmpfile table_name=Evento}

</html>
