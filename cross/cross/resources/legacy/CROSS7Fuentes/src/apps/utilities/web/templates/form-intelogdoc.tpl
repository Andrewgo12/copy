<html>
{loadlabels table_name=intelogdoc&controls[]=CmdUpdate}
<head>
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsIntegraLog.js&files[]=encode.js}
</head>
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmIntelogdoc" method="post"}

<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="4"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td>{printlabel name=inlocodigon&blBold=true}</td>
      <td>{printvalue label="intelogdoc__inlocodigon" blBold=true blFont=true size=5}{hidden id="inlocodigon" name="intelogdoc__inlocodigon"}</td>
  	<td class="piedefoto">{printcoment name=inlocodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=d_id_cross&blBold=true}</td>
      <td>{printvalue label="intelogdoc__d_id_cross" blBold=true blFont=true size=5}{hidden id="d_id_cross" name="intelogdoc__d_id_cross"}</td>
  	<td class="piedefoto">{printcoment name=d_id_cross}</td>
   </tr>
   <tr>
      <td>{printlabel name=nmbre_srie&blBold=true}</td>
      <td>{textfield id="nmbre_srie" name="intelogdoc__nmbre_srie" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=nmbre_srie}</td>
   </tr>
   <tr>
      <td>{printlabel name=nmbre_tpo_crpta&blBold=true}</td>
      <td>{textfield id="nmbre_tpo_crpta" name="intelogdoc__nmbre_tpo_crpta" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=nmbre_tpo_crpta}</td>
   </tr>
   <tr>
      <td>{printlabel name=nmbre_crpta&blBold=true}</td>
      <td>{textfield id="nmbre_crpta" name="intelogdoc__nmbre_crpta" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=nmbre_crpta}</td>
   </tr>
   <tr>
      <td>{printlabel name=nmbre_tpo_dcto&blBold=true}</td>
      <td>{textfield id="nmbre_tpo_dcto" name="intelogdoc__nmbre_tpo_dcto" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=nmbre_tpo_dcto}</td>
   </tr>
   <tr>
      <td>{printlabel name=nmbre_dcto&blBold=true}</td>
      <td>{textfield id="nmbre_dcto" name="intelogdoc__nmbre_dcto" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=nmbre_dcto}</td>
   </tr>
   <tr>
      <td>{printlabel name=ext&blBold=true}</td>
      <td>{textfield id="extt" name="intelogdoc__ext" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ext}</td>
   </tr>
   <tr>
      <td>{printlabel name=fncnrio&blBold=true}</td>
      <td>{textfield id="fncnrio" name="intelogdoc__fncnrio" size="30" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=fncnrio}</td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	{btn_button value="Modificar" id="CmdUpdate" name="CmdUpdate" onClick="jsUpdateIntelogdoc();disableButtons();"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td colspan="3">&nbsp;</td>
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
{droptmpfile table_name=intelogdoc}
</html>