<html>
{loadlabels table_name=Causa&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCausa" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{select_row_table sqlid="tipoorden" id="tiorcodigos" name="causa__tiorcodigos" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true" command_default="FeCrCmdDefaultCausa"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=evencodigos&blBold=true}</td>
      <td>
		{select_son name="causa__evencodigos"
		     table_hijo="evento" 
		     id_hijo="evencodigos"
		     label_hijo="evennombres"
		     foreign_name=""
		     select_papa="causa__tiorcodigos"
		     sqlid="tipoorden_evento"}<B>*</B>     
  	<td class="piedefoto">{printcoment name=evencodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=causcodigos&blBold=true}</td>
      <td>{textfield id="causcodigos" name="causa__causcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=causcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=causnombres&blBold=true}</td>
      <td>{textfield id="causnombres" name="causa__causnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=causnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=causdescrips}</td>
      <td>{textarea id="causdescrips" name="causa__causdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=causdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=causactivas}</td>
      <td>{select_estado id="causactivas" name="causa__causactivas" table="causa"}</td>
  	<td class="piedefoto">{printcoment name=causactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddCausa" form_name="frmCausa"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateCausa" form_name="frmCausa" loadFields="causa__tiorcodigos,causa__evencodigos,causa__causcodigos,causa__causnombres" confirm="33"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeleteCausa" form_name="frmCausa" loadFields="causa__tiorcodigos,causa__evencodigos,causa__causcodigos,causa__causnombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListCausa" form_name="frmCausa"}
				{btn_clean table_name="Causa" form_name="frmCausa"}
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
{droptmpfile table_name=Causa}

</html>
