<html>
{loadlabels table_name=Estadoproces&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEstadoproces" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=esprcodigos&blBold=true}</td>
      <td>{textfield id="esprcodigos" name="estadoproces__esprcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esprcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=esprnombres&blBold=true}</td>
      <td>{textfield id="esprnombres" name="estadoproces__esprnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esprnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=esprdescrips}</td>
      <td>{textarea id="esprdescrips" name="estadoproces__esprdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=esprdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=espractivas}</td>
      <td>{select_estado id="espractivas" name="estadoproces__espractivas" table="estadoproces"}</td>
  	<td class="piedefoto">{printcoment name=espractivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddEstadoproces" form_name="frmEstadoproces"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateEstadoproces" form_name="frmEstadoproces"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeWFCmdDeleteEstadoproces" form_name="frmEstadoproces" table="estadoproces"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListEstadoproces" form_name="frmEstadoproces"}
				{btn_clean table_name="Estadoproces" form_name="frmEstadoproces"}
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
{droptmpfile table_name=Estadoproces}
</html>