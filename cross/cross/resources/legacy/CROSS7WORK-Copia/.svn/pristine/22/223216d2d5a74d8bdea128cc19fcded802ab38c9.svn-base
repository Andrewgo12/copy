<html>
{loadlabels table_name=integralog&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsIntegraLog.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmIntegraLog" method="post"}

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
      <td>{printlabel name=inlofchaejin&blBold=true}</td>
      <td>
      {calendar id="inlofchaejin1" name="integralog__inlofchaejin1" is_null="true" form_name ="frmIntegraLog" hour="true"}
      {calendar id="inlofchaejin2" name="integralog__inlofchaejin2" is_null="true" form_name ="frmIntegraLog" hour="true"}
      <B>*</B></td>
  	<td class="piedefoto">{printcoment name=inlofchaejin}</td>
   </tr>
   <tr>
      <td>{printlabel name=inloidcrosss}</td>
      <td>{textfield id="inloidcrosss" name="integralog__inloidcrosss" size="30" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=inloidcrosss}</td>
   </tr>
   <tr>
      <td>{printlabel name=inlousuarios}</td>
      <td>{select_dataservices id="inlousuarios" name="integralog__inlousuarios" service="Human_resources" method="getAllActiveAuthPersonal" table_name="personal" value="persusrnams" label="persusrnams" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=inlousuarios}</td>
   </tr>
   <tr>
      <td>{printlabel name=inloapps}</td>
      <td>{select_state id="inloapps" name="integralog__inloapps" option="4" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=inloapps}</td>
   </tr>
   <tr>
      <td>{printlabel name=inloestados}</td>
      <td>{select_state id="inloestados" name="integralog__inloestados" option="7" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=inloestados}</td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	{btn_button value="Adicionar" id="CmdShow" name="CmdShow" onClick="jsLoadIntegraLog();"}
				<!--{btn_button value="Aceptar" id="CmdAccept" name="FeEnCmdSaveConfig" onClick="jsSaveConfig();"}-->
				{btn_clean table_name="Integralog" form_name="frmIntegraLog"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="3">{div id="div_integralog" align="center"}{/div}</td>
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
{droptmpfile table_name=integralog}
</html>