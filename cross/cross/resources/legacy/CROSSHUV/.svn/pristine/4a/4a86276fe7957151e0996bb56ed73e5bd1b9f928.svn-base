<html>
{loadlabels table_name=Schema&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmSchema" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
    <!-- Impide la modificación del código y el nombre -->
   <tr>
      <td class="celda">{printlabel name=schecodigon}</td>
      <td class="celda">{textfield id="schecodigon" name="schema__schecodigon" class="campos" maxlength="30" readonly="true"}</td>
 	   <td class="piedefoto">{printcoment name=schecodigon}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=schenombres&blBold=true}</td>
      <td class="celda">{textfield id="schenombres" name="schema__schenombres" class="campos" maxlength="100"}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=schenombres}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=scheobservas&blBold=true}</td>
      <td class="celda">{textarea id="scheobservas" name="schema__scheobservas" class="campos" cols="40" rows="5" wrap="OFF"}{/textarea}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=scheobservas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddSchema" form_name="frmSchema"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateSchema" form_name="frmSchema" loadFields="schema__schecodigon,schema__schenombres,schema__scheobservas" confirm="11"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FePrCmdDeleteSchema" form_name="frmSchema" loadFields="schema__schecodigon,schema__schenombres" confirm="12"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListSchema" form_name="frmSchema"}
				{btn_clean table_name="Schema" form_name="frmSchema"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message param=$param}
{/fieldset}
<br>
{/body}
</html>