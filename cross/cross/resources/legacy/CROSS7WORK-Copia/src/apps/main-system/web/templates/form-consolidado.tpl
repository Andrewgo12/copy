<html>
{loadlabels table_name=Consolidado&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmConsolidado" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ordefecingdini&blBold=true}</td>
      <td>
      {calendar id="ordefecingdini" name="orden__ordefecingdini" is_null="true" form_name ="frmConsolidado" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdini}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecingdfin&blBold=true}</td>
      <td>
      {calendar id="ordefecingdfin" name="orden__ordefecingdfin" is_null="true" form_name ="frmConsolidado" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdfin}</td>
   </tr>

   <tr>
      <td>{printlabel name=ordefecdiginin}</td>
      <td>
      {calendar id="ordefecdiginin" name="orden__ordefecdiginin" is_null="true" hour="true" form_name ="frmConsolidado" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdiginin}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecdigfinn}</td>
      <td>
      {calendar id="ordefecdigfinn" name="orden__ordefecdigfinn" is_null="true" hour="true" form_name ="frmConsolidado" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdigfinn}</td>
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
					onClick="if(valDatos())fncopenwindows('FeCrCmdDefaultRepConsolidado','ordefecingdini='+this.form.orden__ordefecingdini.value+'&ordefecingdfin='+this.form.orden__ordefecingdfin.value+'&orgacodigos='+this.form.organizacion__orgacodigos.value+'&ordefecdiginin='+this.form.orden__ordefecdiginin.value+'&ordefecdigfinn='+this.form.orden__ordefecdigfinn.value);"
                }
		</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{literal}
<script language='javascript'>
    function valDatos(){
        if(!document.frmConsolidado.orden__ordefecingdini.value || 
            !document.frmConsolidado.orden__ordefecingdfin.value){
            location='index.php?action=FeCrCmdDefaultConsolidado&cod_message=0';
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
{droptmpfile table_name=Consolidado}
</html>