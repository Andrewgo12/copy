<html>
{loadlabels table_name=Contratoprod&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>{putstyle}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmContratoprod" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td class="celda">{printlabel name=contnics&blBold=true}</td>
      <td class="celda">{select_row_table id="contnics" name="contratoprod__contnics" class="campos" table_name="contrato" value="contnics" is_null="true"}*</td>
 	   <td class="piedefoto">{printcoment name=Contnics}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=prodcodigos&blBold=true}</td>
      <td class="celda">{select_row_table id="prodcodigos" sqlid="producto" name="contratoprod__prodcodigos" class="campos" table_name="producto" value="prodcodigos" label="prodnombres" is_null="true"}*</td>
 	   <td class="piedefoto">{printcoment name=Prodcodigos}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=coprcantidan}</td>
      <td class="celda">{textfield id="coprcantidan" name="contratoprod__coprcantidan" class="campos" maxlength="4" typeData="int"}</td>
 	   <td class="piedefoto">{printcoment name=Coprcantidan}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=coprvalunidn}</td>
      <td class="celda">{textfield id="coprvalunidn" name="contratoprod__coprvalunidn" class="campos" maxlength="7" typeData="int"}</td>
 	   <td class="piedefoto">{printcoment name=Coprvalunidn}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=coprserials}</td>
      <td class="celda">{textfield id="coprserials" name="contratoprod__coprserials" class="campos" maxlength="100"}</td>
 	   <td class="piedefoto">{printcoment name=coprserials}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=copovigencn}</td>
      <td class="celda">{textfield id="copovigencn" name="contratoprod__copovigencn" class="campos" maxlength="4" typeData="int"}</td>
 	   <td class="piedefoto">{printcoment name=copovigencn}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=copodefinis}</td>
      <td class="celda">{textarea id="copodefinis" name="contratoprod_copodefinis" class="campos" cols="40" rows="5" }{/textarea}</td>
 	   <td class="piedefoto">{printcoment name=Copodefinis}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=copoclausus}</td>
      <td class="celda">{textarea id="copoclausus" name="contratoprod_copoclausus" class="campos" cols="40" rows="5" }{/textarea}</td>
 	   <td class="piedefoto">{printcoment name=Copoclausus}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=coporestris}</td>
      <td class="celda">{textarea id="coporestris" name="contratoprod_coporestris" class="campos" cols="40" rows="5" }{/textarea}</td>
 	   <td class="piedefoto">{printcoment name=Coporestris}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
    	<td colspan="2">
    		<div align="center">
	    		{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddContratoprod" form_name="frmContratoprod"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateContratoprod" form_name="frmContratoprod" loadFields="contratoprod__contnics,contratoprod__prodcodigos" confirm="8"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteContratoprod" form_name="frmContratoprod" loadFields="contratoprod__contnics,contratoprod__prodcodigos" confirm="9"}
				{btn_command type="button" value="Limpiar" id="CmdClean"  name="FeCuCmdClearContratoprod" form_name="frmContratoprod"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListContratoprod" form_name="frmContratoprod"}
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
</html>