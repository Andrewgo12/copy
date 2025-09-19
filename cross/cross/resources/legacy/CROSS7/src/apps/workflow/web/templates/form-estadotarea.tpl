<html>
{loadlabels table_name=estadotarea&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmEstadotarea" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td class="celda">{printlabel name=tarecodigos&blBold=true}</td>
      <td class="celda">{select_row_table id="tarecodigos" name="estadotarea__tarecodigos" sqlid="tarea" table_name="tarea" value="tarecodigos" label="tarenombres" is_null="true"}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=Tarecodigos}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=esaccodigos&blBold=true}</td>
      <td class="celda">{select_row_table id="esaccodigos" name="estadotarea__esaccodigos" sqlid="estadoacta" table_name="estadoacta" value="esaccodigos" label="esacnombres" is_null="true"}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=Esaccodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
    	<td colspan="2">
    		<div align="center">
	    		{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddEstadotarea" form_name="frmEstadotarea"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateEstadotarea" form_name="frmEstadotarea" loadFields="estadotarea__tarecodigos,estadotarea__esaccodigos" confirm="9"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeWFCmdDeleteEstadotarea" form_name="frmEstadotarea" loadFields="estadotarea__tarecodigos,estadotarea__esaccodigos" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListEstadotarea" form_name="frmEstadotarea"}
				{btn_command type="button" value="Limpiar" id="CmdClean"  name="FeWFCmdClearEstadotarea" form_name="frmEstadotarea"}
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
