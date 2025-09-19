<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Schedule&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     
{loadDatosAppoint}
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=entrada.js&files[]=fncWindowOpen.js&files[]=jsLoadSelect.js&files[]=select_list.js&files[]=encode.js&files[]=prototype/dist/prototype.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();jsLoadEntrada();" onunload=""}
<br>
{form name="frmEntrada" method="post"}
<table border="0" align="center" width="60%">
<tr>
<td>
<table border="0" align="center" width="80%">

  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	{hidden name="focusposition"}
	{hidden name="date"}
   <tr>
      <td>{printlabel name=entrfechorun&blBold=true}</td>
      <td colspan="2">{calendar hour="yes" id="entrfechorun" name="entrada__entrfechorun" is_null="true" form_name ="frmEntrada" }<B>*</B></td>
  	<td class="piedefoto">{printcoment name=entrfechorun}</td>
   </tr>
   <tr>
      <td>{printlabel name=entrduracion&blBold=true}</td>
      <td colspan="2">{calendar hour="yes" id="entrduracion" name="entrada__entrduracion" is_null="true" form_name ="frmEntrada"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=entrduracion}</td>
   </tr>
   <tr>
      <td>{printlabel name=agprcodigos}</td>
      <td colspan="2">{select_row_table id="agprcodigos" name="entrada__agprcodigos" sqlid="agendapriori" table_name="agprcodigos" value="agprcodigos" label="agprnombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=agprcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=catecodigon&blBold=true}</td>
      <td colspan="2">{select_row_table id="catecodigon" is_null="true" name="entrada__catecodigon" table_name="categoria" value="catecodigon" label="catenombres"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=catecodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
      <td colspan="2">
        {select_row_table_service service="Human_resources" method="getAllEntesOrg" table_name="organizacion" label="organombres" id="orgacodigos" value="orgacodigos" name="orgacodigos" form="frmEntrada" is_null=true}
        <a href='javascript:Availability(0,"orgacodigos","orgacodigos");'><img border=0 src='web/images/calendar.gif'></a>
        {href 
	      	label="<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>"
	      	onclick="javascript:drawOrg();"
	  	}
      </td>
  	<td class="piedefoto">{printcoment name=catecodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=entrdescris&blBold=true}</td>
      <td colspan="2">{textarea id="entrdescris" name="entrada__entrdescris" cols="40" rows="5" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=entrdescris}</td>
   </tr>
   
   <tr>
      <td><b>{printlabel name=datarepet}</b></td>
      <td colspan="2">&nbsp;</td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
   <tr>
      <td>{printlabel name=freq}</td>
      <td colspan="2">{select_constant_repet id="frequency" is_null="true" name="frequency"}</td>
  	<td class="piedefoto">{printcoment name=freq}</td>
   </tr>
   <tr>
      <td>{printlabel name=fechafinfreq}</td>
      <td colspan="2">{calendar_repet hour="yes" id="fechafinfreq" name="fechafinfreq" is_null="true" form_name ="frmEntrada" }</td>
  	<td class="piedefoto">{printcoment name=fechafinfreq}</td>
   </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeScCmdAddEntrada" form_name="frmEntrada"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeScCmdUpdateEntrada" form_name="frmEntrada"}
				{btn_clean table_name="Entrada" form_name="frmEntrada"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>	
</td>	
 <td align="center">{div id="div_org" align="center"}{/div}</td>
 </tr>	
</table>
{hidden name="action"}
{hidden name="perscodigos"}
{hidden name="orgacodigospart"}
{hidden name="preecodigon"}
{hidden name="entrada__entrcodigon" id="entrcodigon"}
{hidden name="entrada__entrusucreas"}
{hidden name="entrada__entractivas"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Entrada}


</html>
