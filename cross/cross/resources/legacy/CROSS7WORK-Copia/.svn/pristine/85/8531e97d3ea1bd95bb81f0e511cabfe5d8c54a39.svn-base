<html>
{loadlabels table_name=nuevadescripcion&controls[]=CmdShow&controls[]=CmdNew&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsAccionesND.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="jsLoadTabla();putFocus();" onunload=""}
{form name="frmDescription" method="post"}
<table border="0" align="center" width="60%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td>{printlabel name=entidad&blBold=true}</td>
      <td><select id="entidad" name="descripcion__entidad" onchange="clearContainer('div_listado');"><option value="">---</option></select><B>*</B></td>
      <td class="piedefoto">{printcoment name=entidad}</td>
   </tr>
   <tr>
      <td>{printlabel name=langcodigos&blBold=true}</td>
      <td>{select_row_table_service id="langcodigos" service="Profiles" name="descripcion__langcodigos" method="getAllLanguage" value="langcodigos" label="langnombres" is_null="true" onchange="clearContainer('div_listado');"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=langcodigos}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow" name="FeGeCmdDrawND" onClick="jsDrawListado();"}
				{btn_clean table_name="NuevaDescripcion" form_name="frmDescription"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2">{div id="div_listado" align="center"}{/div}</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=nuevadescripcion}
</html>