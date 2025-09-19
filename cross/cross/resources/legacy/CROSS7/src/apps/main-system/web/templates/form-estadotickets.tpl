<html>
{loadlabels table_name=estadotickets&controls[]=CmdShow&controls[]=CmdPrint&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsdrawDynamicColumns.js&files[]=encode.js&files[]=jsDrawdiv.js&files[]=prototype/dist/prototype.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmListadoOrden" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=usuacodigos}</td>
      <td>
      {checkbox name="check1" value="orden__usuacodigos"}
      {select_authpersonal id="usuacodigos" name="orden__usuacodigos" service="Human_resources" method="getAllActiveAuthPersonal" table_name="personal" value="persusrnams" label="persusrnams" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=usuacodigos}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=ordefecregd}</td>
      <td>
      {checkbox name="check3" checked=true value="orden__ordefecregd"}
      {calendar id="ordefecregd1" name="orden__ordefecregd1" is_null="true" form_name ="frmListadoOrden" }
      {calendar id="ordefecregd2" name="orden__ordefecregd2" is_null="true" form_name ="frmListadoOrden" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecregd}</td>
   </tr>

   <tr>
      <td>{printlabel name=contidentis}</td>
      <td>
      	{checkbox name="check6" checked=true value="ordenempresa__contidentis"}
      	{dataselectdojo htmlid="ordenempresa__contidentis" name="ordenempresa__contidentis" sqlid="contacto_ref" value="contcodigon" label="contnombre" forceautoreference="true"}
     </td>
  	<td class="piedefoto">{printcoment name=contidentis}</td>
   </tr>
   
   {hidden name="check7" value="ordenempresa__evencodigos"}
   {hidden name='check8' value="ordeobservs"}
   {hidden name='check9' value="acta__tarecodigos"}
   {hidden name='check10' value="acta__actaestacts"}
   
   <tr>
      <td>{printlabel name=seltodos}</td>
      {literal}
      <td><input type='checkbox' name='all' onClick="with(document.frmListadoOrden){for(var i=0;i<elements.length;i++){if(elements[i].disabled==false){if(elements[i].type == 'checkbox'){if(this.checked == true)elements[i].checked = true;else elements[i].checked = false;}}}}"></td>
      {/literal}
  	<td class="piedefoto">{printcoment name=esaccodigos}</td>
   </tr>

	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Consultar" onClick="consult__flag.value = 1;total.value = '';" id="CmdShow" name="FeCrCmdDefaultEstadoTickets" form_name="frmListadoOrden"}
				{btn_command type="button" value="Imprimir" onClick="consult__flag.value = 2;" id="CmdPrint" name="FeCrCmdDefaultEstadoTickets" form_name="frmListadoOrden"}
				{btn_clean table_name="EstadoTickets" form_name="frmListadoOrden"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table><br><br>
{hidden name="action" value=""}
{hidden name="consult__flag" value=""}
{hidden name="total" value=""}
{hidden name="orden__ordenumeros" value=""}
{hidden name="orderby" value=""}
{hidden name="page" value="1"}
{estadotickets}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Orden}
</html>