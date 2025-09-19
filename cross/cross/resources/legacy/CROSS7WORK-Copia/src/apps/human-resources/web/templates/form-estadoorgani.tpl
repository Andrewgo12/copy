<html>
{loadlabels table_name=Estadoorgani&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEstadoorgani" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=esorcodigos&blBold=true}</td>
      <td>{textfield id="esorcodigos" name="estadoorgani__esorcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=esornombres&blBold=true}</td>
      <td>{textfield id="esornombres" name="estadoorgani__esornombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esornombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=esordescrips}</td>
      <td>{textarea id="esordescrips" name="estadoorgani__esordescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=esordescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=esoractivas}</td>
      <td>{select_estado id="esoractivas" name="estadoorgani__esoractivas" table="estadoorgani"}</td>
  	<td class="piedefoto">{printcoment name=estadoorgani}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddEstadoorgani" form_name="frmEstadoorgani"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateEstadoorgani" form_name="frmEstadoorgani" loadFields="estadoorgani__esorcodigos,estadoorgani__esornombres" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteEstadoorgani" form_name="frmEstadoorgani" loadFields="estadoorgani__esorcodigos,estadoorgani__esornombres" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListEstadoorgani" form_name="frmEstadoorgani"}
				{btn_clean table_name="Estadoorgani" form_name="frmEstadoorgani"}
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
{droptmpfile table_name=Estadoorgani}

</html>
