<html>
{loadlabels table_name=Estadogrupo&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEstadogrupo" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=esgrcodigos&blBold=true}</td>
      <td>{textfield id="esgrcodigos" name="estadogrupo__esgrcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esgrcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=esgrnombres&blBold=true}</td>
      <td>{textfield id="esgrnombres" name="estadogrupo__esgrnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esgrnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=esgrdescrips}</td>
      <td>{textarea id="esgrdescrips" name="estadogrupo__esgrdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=esgrdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=esgractivas}</td>
      <td>{select_estado id="esgractivas" name="estadogrupo__esgractivas" table="estadogrupo"}</td>
  	<td class="piedefoto">{printcoment name=esgractivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddEstadogrupo" form_name="frmEstadogrupo"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateEstadogrupo" form_name="frmEstadogrupo" loadFields="estadogrupo__esgrcodigos,estadogrupo__esgrnombres" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteEstadogrupo" form_name="frmEstadogrupo" loadFields="estadogrupo__esgrcodigos,estadogrupo__esgrnombres" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListEstadogrupo" form_name="frmEstadogrupo"}
				{btn_clean table_name="Estadogrupo" form_name="frmEstadogrupo"}
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
{droptmpfile table_name=Estadogrupo}

</html>
