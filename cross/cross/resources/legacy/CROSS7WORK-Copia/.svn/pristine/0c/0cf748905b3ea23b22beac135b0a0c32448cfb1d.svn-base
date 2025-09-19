<html>
{loadlabels table_name=encuesta&controls[]=CmdClean&controls[]=CmdAccept}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=encuesta.js&files[]=encode.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="jsShowFormulario();putFocus();" onunload=""}
{form name="frmEncuesta" method="post"}

<table border="0" align="center" width="80%">
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
      <td>{printlabel name=contidentis}</td>
      <td>
      	{dataselectdojo htmlid="contidentis" name="formulario__contidentis" sqlid="contacto_ident" value="contcodigon" label="contindentis" forceautoreference="true"}
	    {href 
	      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante');"
	    }
     </td>
  	<td class="piedefoto">{printcoment name=contidentis}</td>
   </tr>
   <tr>
	<td>{printlabel name=paciente&blBold=true}</td>
	<td> 
		{dataselectdojo htmlid="paciindentis" name="formulario__paciindentis" sqlid="paciente_ref" value="paciindentis" label="pacinombres" forceautoreference="true"}
	    <B>*</B>
	</td>
   </tr>
   <tr>
   	  <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>
        {select_row_servorg id="orgacodigos" value="orgacodigos" label="organombres" name="formulario__orgacodigos" is_null=true}<B>*</B>
      </td>  
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">{div id="div_encuesta" align="center"}{/div}</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Aceptar" id="CmdAccept" name="FeEnCmdSaveConfig" onClick="jsSaveEncuestaWeb();"}
				{btn_clean table_name="EncuestaWeb" form_name="frmEncuesta"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
{hidden name="action" value=""}
{hidden name="formulario__formcodigon" value="" id="formcodigon"}
{hidden name="formulario__orgacodigos" value="" id="orgacodigos"}
{hidden name="formulario__ordenumeros" value="" id="ordenumeros"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=configencuesta}
</html>