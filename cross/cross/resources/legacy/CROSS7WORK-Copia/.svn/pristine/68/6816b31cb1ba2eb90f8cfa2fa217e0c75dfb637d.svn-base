<html>
{loadlabels table_name=Actividad&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmActividad" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=acticodigos&blBold=true}</td>
      <td>{textfield id="acticodigos" name="actividad__acticodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=acticodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=actinombres&blBold=true}</td>
      <td>{textfield id="actinombres" name="actividad__actinombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=actinombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=activalorn}</td>
      <td>{textfield id="activalorn" name="actividad__activalorn" maxlength="12" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=activalorn}</td>
   </tr>
   <tr>
      <td>{printlabel name=actiobservas}</td>
      <td>{textarea id="actiobservas" name="actividad__actiobservas" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=actiobservas}</td>
   </tr>
   <tr>
      <td>{printlabel name=actiactivas}</td>
      <td>{select_estado id="actiactivas" name="actividad__actiactivas" table="actividad"}</td>
  	<td class="piedefoto">{printcoment name=actiactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddActividad" form_name="frmActividad"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateActividad" form_name="frmActividad" loadFields="actividad__acticodigos,actividad__actinombres" confirm="9"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeWFCmdDeleteActividad" form_name="frmActividad" loadFields="actividad__acticodigos,actividad__actinombres" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListActividad" form_name="frmActividad"}
				{btn_clean table_name="Actividad" form_name="frmActividad"}
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
{droptmpfile table_name=Actividad}
</html>