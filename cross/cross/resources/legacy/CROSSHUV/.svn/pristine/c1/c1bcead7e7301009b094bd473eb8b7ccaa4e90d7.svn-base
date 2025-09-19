<html>
{loadlabels table_name=Reqeps&controls[]=CmdShow&controls[]=CmdClean}
<head>
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}
</head>
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmReqeps" method="post"}
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center">{help_context}</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=ordefecregd&blBold=true}</td>
      <td>
      {calendar id="ordefecregd" name="orden__ordefecregd" is_null="true" form_name ="frmReqeps" }
      {calendar id="ordefecregd" name="orden__ordefecregd2" is_null="true" form_name ="frmReqeps" }<B>*</B>
      </td>
  	<td class="piedefoto">{printcoment name=ordefecregd}</td>
   </tr>
   <tr>
      <td>{printlabel name=ipsecodigos}</td>
      <td>{select_row_table id="ipsecodigos" name="ordenempresa__ipsecodigos" sqlid="ips" table_name="ipsservicio" value="ipsecodigos" label="ipsenombres" is_null="true" }</td>
  	<td class="piedefoto">{printcoment name=ipsecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiorcodigos}</td>
      <td>{select_row_table id="tiorcodigos" name="ordenempresa__tiorcodigos" sqlid="tipoorden" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
	<tr>
		<td colspan="2"><b>{printlabel name=detail}</b></td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td>{printlabel name=evencodigos}</td>
      <td>{checkbox id="evencodigos" name="evencodigos" }</td>
  	<td class="piedefoto">{printcoment name=evencodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=causcodigos}</td>
      <td>{checkbox id="causcodigos" name="causcodigos" }</td>
  	<td class="piedefoto">{printcoment name=causcodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button type="button" value="Consultar" id="CmdShow" name="FeCrCmdDefaultReqeps" form_name="frmReqeps" 
				onClick="fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyReqeps&ipsecodigos='+this.form.ordenempresa__ipsecodigos.value+'&tiorcodigos='+this.form.ordenempresa__tiorcodigos.value+'&ordefecregd='+this.form.orden__ordefecregd.value+'&ordefecregd2='+this.form.orden__ordefecregd2.value+'&evencodigos='+this.form.evencodigos.checked+'&causcodigos='+this.form.causcodigos.checked+'&vars=ipsecodigos,tiorcodigos,ordefecregd,ordefecregd2,causcodigos,evencodigos');"}				
                {btn_clean table_name="Reqeps" form_name="frmReqeps"}
            </div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultReqeps"}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/form}
{/body}
{droptmpfile table_name=Reqeps}
</html>