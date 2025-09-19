<html>
{loadlabels table_name=Pursuit&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPursuit" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ordefecingdini&blBold=true}</td>
      <td>
      {calendar id="ordefecingdini" name="pursuit__ordefecingdini" is_null="true" form_name ="frmPursuit" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdini}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecingdfin&blBold=true}</td>
      <td>
      {calendar id="ordefecingdfin" name="pursuit__ordefecingdfin" is_null="true" form_name ="frmPursuit" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdfin}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
	  <td>{select_entes_esp id="orgacodigos" name="organizacion__orgacodigos" form="frmConsolidado"}</td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow"	name="consultar"
					onClick="if(valDatos())fncopenwindows('FeCrCmdDefaultPursuit','ordefecingdini='+this.form.pursuit__ordefecingdini.value+'&ordefecingdfin='+this.form.pursuit__ordefecingdfin.value+'&orgacodigos='+this.form.organizacion__orgacodigos.value);"
                }
		</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{literal}
<script language='javascript'>
    function valDatos(){
        if(!document.frmPursuit.pursuit__ordefecingdini.value || 
            !document.frmPursuit.pursuit__ordefecingdfin.value){
            location='index.php?action=FeCrCmdDefaultPursuit_Report&cod_message=0';
            return false
        }
        return true;
    }
</script>
{/literal}
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Pursuit}
</html>