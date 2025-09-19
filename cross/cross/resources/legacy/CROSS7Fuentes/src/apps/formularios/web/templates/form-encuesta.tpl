<html>
{loadlabels table_name=encuesta&controls[]=CmdClean&controls[]=CmdAccept}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=encuesta.js&files[]=encode.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
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
      <td width='25%'>{printlabel name=formcodigon&blBold=true}</td>
      <td width='60%'>{select_row_table id="formcodigon" sqlid="formulario" name="formulario__formcodigon" table_name="formulario" value="formcodigon" label="formnombres" is_null="true" onchange="jsShowFormulario();"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=formcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=contidentis}</td>
      <td>
      	{dataselectdojo htmlid="contidentis" name="formulario__contidentis" sqlid="contacto_ref" value="contcodigon" label="contnombre" forceautoreference="true"}
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
	    {href 
	      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:OpenWindows('../customers/index.php?action=FeCuCmdDefaultPaciente','');"
	    }
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
      <td>{printlabel name=ordenumeros}</td>
      <td>{textfield id="ordenumeros" name="formulario__ordenumeros" maxlength="30"}
      {href 
	      	label="<img src='web/images/zoomprev.gif' border='0' align='absmiddle'></img>"
	      	onclick="javascript:var sbOrdenumeros=document.frmEncuesta.formulario__ordenumeros.value;if(sbOrdenumeros)OpenWindows('../cross300/index.php?action=FeCrCmdDefaultFichas&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO='+sbOrdenumeros+'&vars=ordenumerosFO');"
	  }
      </td>
  	<td class="piedefoto">{printcoment name=ordenumeros}</td>
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
				{btn_button value="Aceptar" id="CmdAccept" name="FeEnCmdSaveConfig" onClick="jsSaveEncuesta();"}
				{btn_clean table_name="Encuesta" form_name="frmEncuesta"}
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
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=configencuesta}
</html>