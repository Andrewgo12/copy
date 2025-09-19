<html>
{loadlabels table_name=Actaempresa&controls[]=CmdAdd&controls[]=CmdCancel&controls[]=CmdClean}

{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=jsdrawDynamicColumns.js&files[]=encode.js&files[]=jsDrawdiv.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();drawDynamicColumns('dynamic_columns');" onunload=""}
<br>
{form name="frmActaempresa" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="80%">
  	
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	
   <tr>
      <td class="piedefoto" colspan="2">{card_summary}</td>
	  <td class="piedefoto"></td>
    </tr>
	
   <tr>
      <td width='25%'>{printlabel name=esaccodigos&blBold=true}</td>
      <td width='60%'>{select_estadotarea}<b>*</b></td>
  	<td  width='15%'class="piedefoto">{printcoment name=esaccodigos}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=acemfeccren}</td>
      <td>{textfield id="acemfeccren" name="actaempresa__acemfeccren" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=acemfeccren}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=acemfecaten&blBold=true}</td>
      <td>{calendar name="actaempresa__acemfecaten" id="acemfecaten" form_name="frmActaempresa" hour="true"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=acemfecaten}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=acemhorainn&blBold=true}</td>
      <td>{textfield_hour id="acemhorainn" name="actaempresa__acemhorainn"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=acemhorainn}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=acemhorafin}</td>
      <td>{textfield_hour id="acemhorafin" name="actaempresa__acemhorafin"}</td>
  	<td class="piedefoto">{printcoment name=acemhorafin}</td>
   </tr>
   <tr>
      <td>{printlabel name=acemobservas&blBold=true}</td>
      <td>{textarea_ext id="acemobservas" name="actaempresa__acemobservas"  cols="100" rows="15" }{/textarea_ext}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=acemobservas}</td>
   </tr>
   <tr>
	<td colspan="3" class="piedefoto">
		{div id="dynamic_columns" align="justify"}
		<table border="0" align="center" width="0%">
		<tr><td width='25%'>&nbsp;</td><td width='60%'>&nbsp;</td><td width='15%' class="piedefoto"></td></tr>
		</table>
   		{/div}
	</td>
	</tr>
   <tr>
		<td colspan="2" class="piedefoto">{register_activ form="frmActaempresa"}</td>
		<td class="piedefoto">&nbsp</td>
   </tr>
   <tr>
      <td colspan="2" class="piedefoto">{register_attachment_atencion form="frmActaempresa"}</td>
      <td class="piedefoto">&nbsp</td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddActaempresa" form_name="frmActaempresa"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdDefaultAdminTareas" form_name="frmActaempresa"}
				{btn_clean table_name="Actaempresa" form_name="frmActaempresa"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>	
	
</table>
{hidden name="action" value=""}
{hidden name="focusposition"}
{hidden name="acta" id="acta"}
{hidden name="orgacodigos" id="orgacodigos"}
{hidden name="orgacodigos_desc"}
{hidden name="actaempresa__acemnumeros"}
{hidden name="activities"}
{hidden name="delactiviacta" value=""}
{hidden name="acemcompromis"}
{hidden name="compromiso"}
{hidden name="acemnumerosupd"}
{hidden name="ordenumeros" id="ordenumeros"}
{hidden name="tarecodigos" id="tarecodigos"}
{hidden name="delacemcompromis" value=""}
{hidden name="deleteattachment" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message_orden id=$cod_message param=$param signal=$signal}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Actaempresa}
</html>