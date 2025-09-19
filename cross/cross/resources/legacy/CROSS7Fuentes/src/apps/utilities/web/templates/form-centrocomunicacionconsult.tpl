<html>
{loadlabels table_name=Comunicacionconsult&controls[]=CmdShow&controls[]=CmdNew&controls[]=CmdDelete}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsAccionesCC.js&files[]=encode.js&files[]=../../../../lib/dojo/dojo.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmComunicacionConsult" method="post"}
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
      <td>{printlabel name=ordenumeros&blBold=true}</td>
      <td>{textfield id="ordenumeros" name="comunicacion__ordenumeros" maxlength="30"}<B>*</B></td>
      <td class="piedefoto">{printcoment name=ordenumeros}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecregdi}</td>
      <td>{date_set_proc id="ordefecregdi" name="orden__ordefecregdi" form_name ="frmComunicacionConsult"}{printlabel name=ordefecregdf}
   		  {date_set_proc id="ordefecregdf" name="orden__ordefecregdf" form_name ="frmComunicacionConsult"}</td>
   	  <td class="piedefoto">{printcoment name=ordefecregdi}</td>
   </tr>
   <tr>
      <td>{printlabel name=focacodigos&blBold=true}</td> 
      <td>{select_row_table id="focacodigos" name="comunicacion__focacodigos" value="focacodigos" sqlid="formatocarta" label="focanombres" is_null="true"}<B>*</B></td>
      <td class="piedefoto">{printcoment name=focacodigos}</td>
    </tr>
   <tr>
      <td>{printlabel name=comuestados}</td>
      <td>{select_state id="comuestados" name="comunicacion__comuestados" option="6" is_null="true"}</td>
      <td class="piedefoto">{printcoment name=comuestados}</td>
    </tr>
   <tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow" name="FeGeCmdCentroComunicacionConsult" onClick="jsDrawListado();"}
				{btn_button value="Nuevo" id="CmdNew" name="FeGeCmdCentroComunicacionCreate" onClick="jsCreateCT();"}
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
{hidden_message value="66"}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Comunicacionconsult}
</html>