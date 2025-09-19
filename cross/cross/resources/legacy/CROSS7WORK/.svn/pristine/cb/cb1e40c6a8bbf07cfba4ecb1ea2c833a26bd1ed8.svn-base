<html>
{loadlabels table_name=Formatoemail&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=jsAccionesCE.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br> 
{form name="frmFormatoemail" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=foemcodigos&blBold=true}</td>
      <td>{textfield id="foemcodigos" name="formatoemail__foemcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=foemcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=foemnombres&blBold=true}</td>
      <td>{textfield id="foemnombres" name="formatoemail__foemnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=foemnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=foemasuntos&blBold=true}</td>
      <td>{textarea id="foemasuntos" name="formatoemail__foemasuntos" cols="60" rows="2" nuMax=200 wrap="PHYSICAL"}{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=foemasuntos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tags_1}</td>
      <td>{select_tags id="tags_1" name="formatoemailf__tags_1" onchange="jsPutTagCE('tags_1','foemasuntos')" option="4" is_null="true" id_tag=EMAIL_TAGS}</td>
  	<td class="piedefoto">{printcoment name=tags}</td>
   </tr>
   <tr>
      <td>{printlabel name=foemplantils&blBold=true}</td>
      <td>{textarea id="foemplantils" name="formatoemail__foemplantils" cols="60" rows="8" wrap="PHYSICAL"}{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=foemplantils}</td>
   </tr>
   <tr>
      <td>{printlabel name=tags_2}</td>
      <td>{select_tags id="tags_2" name="formatoemailf__tags_2" onchange="jsPutTagCE('tags_2','foemplantils')" option="4" is_null="true" id_tag=EMAIL_TAGS}</td>
  	<td class="piedefoto">{printcoment name=tags}</td>
   </tr>
   <tr>
      <td>{printlabel name=foemestados}</td>
      <td>{select_estado id="foemestados" name="formatoemail__foemestados" table="formatoemail"}</td>
  	<td class="piedefoto">{printcoment name=foemestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddFormatoemail" form_name="frmFormatoemail"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateFormatoemail" form_name="frmFormatoemail" loadFields="formatoemail__foemcodigos,formatoemail__foemnombres,formatoemail__foemplantils" confirm="46"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeGeCmdDeleteFormatoemail" form_name="frmFormatoemail" loadFields="formatoemail__foemcodigos,formatoemail__foemnombres,formatoemail__foemplantils" confirm="47"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeGeCmdShowListFormatoemail" form_name="frmFormatoemail"}
				{btn_clean table_name="Formatoemail" form_name="frmFormatoemail"}
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
{droptmpfile table_name=Formatoemail}
</html>