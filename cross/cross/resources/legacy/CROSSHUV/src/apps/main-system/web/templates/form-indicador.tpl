<html>
{loadlabels table_name=indicador&controls[]=CmdAdd&controls[]=CmdClean&controls[]=CmdAccept}
<head>
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsIndicador.js&files[]=encode.js}
</head>
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmIndicador" method="post"}

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
      <td>{printlabel name=ordefecingdini&blBold=true}</td>
      <td>
      {calendar id="ordefecingdini" name="ordefecingdini" is_null="true" form_name ="frmIndicador" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdini}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecingdfin&blBold=true}</td>
      <td>
      {calendar id="ordefecingdfin" name="ordefecingdfin" is_null="true" form_name ="frmIndicador" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdfin}</td>
   </tr>

   <tr>
      <td>{printlabel name=ordefecdiginin}</td>
      <td>
      {calendar id="ordefecdiginin" name="ordefecdiginin" is_null="true" form_name ="frmIndicador" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdiginin}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecdigfinn}</td>
      <td>
      {calendar id="ordefecdigfinn" name="ordefecdigfinn" is_null="true" form_name ="frmIndicador" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdigfinn}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
      <td>{textfield id="orgacodigos" name="orgacodigos" onBlur="if(this.value=='')document.frmIndicador.orgacodigos_desc.value=''; else autoReference('organizacion','orgacodigos',Array(this),document.frmIndicador.orgacodigos_desc);"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmIndicador.orgacodigos.value+'&orgacodigos_desc='+document.frmIndicador.orgacodigos_desc.value);"
	    }
        {textfield name="orgacodigos_desc"}</td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow" name="FeEnCmdShowIndicador" onClick="jsShowIndicador();"}
				{btn_clean table_name="Indicador" form_name="frmIndicador"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2">{div id="div_indicador" align="center"}{/div}</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=indicador}
</html>