<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Listschedule&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     
{loadDatosAppoint}
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=entrada.js&files[]=fncWindowOpen.js&files[]=jsLoadSelect.js&files[]=select_list.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEntrada" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	{hidden name="focusposition"}
	{hidden name="date"}
   <tr>
      <td>{printlabel name=entrfechorun&blBold=true}</td>
      <td>{calendar hour="yes" id="entrfechorun" name="entrfechorun" is_null="true" form_name ="frmEntrada" }<B>*</B></td>
  	<td class="piedefoto">{printcoment name=entrfechorun}</td>
   </tr>
   <tr>
      <td>{printlabel name=entrdurationn&blBold=true}</td>
      <td>{calendar hour="yes" id="entrdurationn" name="entrdurationn" is_null="true" form_name ="frmEntrada"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=entrdurationn}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>{select_entes_esp id="orgacodigos" name="orgacodigos" form="frmEntrada"}{checkbox name="children" value="OK"}<B>*</B></td>
      <td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=catecodigon}</td>
      <td>{select_row_table id="catecodigon" is_null="true" name="catecodigon" table_name="categoria" value="catecodigon" label="catenombres"}</td>
  	<td class="piedefoto">{printcoment name=catecodigon}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Consultar" id="CmdShow" onClick="this.form.consulta.value=1;" name="FeScCmdShowListSchedule" form_name="frmEntrada"}
				{btn_clean table_name="Entrada" form_name="frmEntrada"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>

	<center>{viewScheduleList}</center>

{hidden name="action"}
{hidden name="consulta"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Entrada}
</html>