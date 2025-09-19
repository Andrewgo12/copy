<html>
{loadlabels table_name=Tipodocument&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipodocument" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tidocodigos&blBold=true}</td>
      <td>{textfield id="tidocodigos" name="tipodocument__tidocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tidocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tidonombres&blBold=true}</td>
      <td>{textfield id="tidonombres" name="tipodocument__tidonombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tidonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tidodescrips}</td>
      <td>{textarea id="tidodescrips" name="tipodocument__tidodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tidodescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td>{printlabel name=tidoactivas}</td>
      <td>{select_estado id="tidoactivas" name="tipodocument__tidoactivas" table="tipodocument"}</td>
  	<td class="piedefoto">{printcoment name=tidoactivas}</td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddTipodocument" form_name="frmTipodocument"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateTipodocument" form_name="frmTipodocument"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteTipodocument" form_name="frmTipodocument" table="tipodocument"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListTipodocument" form_name="frmTipodocument"}
				{btn_clean table_name="Tipodocument" form_name="frmTipodocument"}
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
{droptmpfile table_name=Tipodocument}

</html>
