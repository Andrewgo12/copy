<html>
{loadlabels table_name=Report&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>Reporte</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=encode.js&files[]=jsReporte.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmReport" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="80%">
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
		<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td>{printlabel name=reusfecingn&blBold=true}</td>
      <td>{calendar name="report__fechaini" id="fechaini" form_name="frmReport" hour="true"}
      {printlabel name=to&blBold=true}
      {calendar name="report__fechafin" id="fechafin" form_name="frmReport" hour="true"}<b>*</b></td>
      <td class="piedefoto">{printcoment name=reusfecingn}</td>
   </tr>
   <tr>
      <td width='25%'>{printlabel name=formcodigon&blBold=true}</td>
      <td width='60%'>{select_row_table id="formcodigon" sqlid="formulario" name="report__formcodigon" table_name="formulario" value="formcodigon" label="formnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=formcodigon}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   
   <tr>
	<td class="piedefoto" colspan="2">
		<table border="0" align="center" width="100%">
		<tr><td colspan="3"><div align="center">
		    	{btn_button value="Consultar" id="CmdShow"	name="consultar" onClick="if(valDatos())fncopenwindows('FeEnCmdViewReport','fechaini='+this.form.report__fechaini.value+'&fechafin='+this.form.report__fechafin.value+'&formcodigon='+this.form.report__formcodigon.value);"}
				{btn_clean table_name="Report" form_name="frmReport"}
			</div></td></tr>
		<tr><td colspan="3" class="piedefoto">&nbsp;</td></tr>
		</table>
	</td>
	<td class="piedefoto">&nbsp;</td>
</tr>
   
</table>
	</td>
</tr>
</table>
{literal}
<script language='javascript'>
    function valDatos(){
        if(!document.frmReport.report__fechaini.value || 
            !document.frmReport.report__fechafin.value){
            location='index.php?action=FeEnCmdDefaultReport&cod_message=0';
            return false
        }
        return true;
    }
</script>
{/literal}

{hidden name="action" value=""}
{hidden name="focusposition"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>