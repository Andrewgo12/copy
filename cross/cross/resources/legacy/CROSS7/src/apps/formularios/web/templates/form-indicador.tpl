<html>
{loadlabels table_name=Indicador&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>Indicador</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmIndicador" enctype="multipart/form-data" method="post"}
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
      <td>{calendar name="indicador__fechaini" id="fechaini" form_name="frmIndicador" hour="true"}
      {printlabel name=to&blBold=true}
      {calendar name="indicador__fechafin" id="fechafin" form_name="frmIndicador" hour="true"}<b>*</b></td>
      <td class="piedefoto">{printcoment name=reusfecingn}</td>
   </tr>
   
   <tr>
      <td width='25%'>{printlabel name=orgacodigos&blBold=true}</td>
      <td width='60%'>{textfield id="orgacodigos" name="indicador__orgacodigos" value="" onBlur="if(this.value!='')autoReference('organizacion','orgacodigos',Array(this),document.frmIndicador.orgacodigos_desc);else document.frmIndicador.orgacodigos_desc.value=''"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:OpenWindows('../cross300/index.php?action=FeCrCmdTreeHelp&table=organizacion&sqlid=organizacion&return_obj=indicador__orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmIndicador.indicador__orgacodigos.value+'&orgacodigos_desc='+document.frmIndicador.orgacodigos_desc.value);"
	    }
        {textfield name="orgacodigos_desc" value=""}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   
   <tr>
      <td width='25%'>{printlabel name=formcodigon&blBold=true}</td>
      <td width='60%'>{select_row_table id="formcodigon" sqlid="formulario" name="indicador__formcodigon" table_name="formulario" value="formcodigon" label="formnombres" is_null="true"}<B>*</B></td>
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
		    	{btn_button value="Consultar" id="CmdShow"	name="consultar" onClick="if(valDatos())fncopenwindows('FeEnCmdViewIndicador','fechaini='+this.form.indicador__fechaini.value+'&fechafin='+this.form.indicador__fechafin.value+'&formcodigon='+this.form.indicador__formcodigon.value+'&orgacodigos='+this.form.indicador__orgacodigos.value);"}
				{btn_clean table_name="Indicador" form_name="frmIndicador"}
			</div></td></tr>
		<tr><td colspan="3" class="piedefoto">&nbsp;</td></tr>
		</table>
		<td class="piedefoto">&nbsp;</td>
	</td>
</tr>
</table>
	</td>
</tr>
</table>
{literal}
<script language='javascript'>
    function valDatos(){
        if(!document.frmIndicador.indicador__fechaini.value || 
           !document.frmIndicador.indicador__orgacodigos.value ||
           !document.frmIndicador.indicador__fechafin.value){
            location='index.php?action=FeEnCmdDefaultIndicador&cod_message=0';
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