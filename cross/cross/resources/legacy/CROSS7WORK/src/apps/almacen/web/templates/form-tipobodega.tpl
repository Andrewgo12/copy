<html>
{loadlabels table_name=Tipobodega&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTipobodega" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tibocodigos&blBold=true}</td>
      <td>{textfield id="tibocodigos" name="tipobodega__tibocodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tibocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tibonombres&blBold=true}</td>
      <td>{textfield id="tibonombres" name="tipobodega__tibonombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tibonombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tibodescrips}</td>
      <td>{textarea id="tibodescrips" name="tipobodega__tibodescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=tibodescrips}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddTipobodega" form_name="frmTipobodega"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateTipobodega" form_name="frmTipobodega"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteTipobodega" form_name="frmTipobodega"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListTipobodega" form_name="frmTipobodega"}
				{btn_clean table_name="Tipobodega" form_name="frmTipobodega"}
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
{droptmpfile table_name=Tipobodega}

</html>
