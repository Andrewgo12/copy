<html>
{loadlabels table_name=Listadollave&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>Llave</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=encode.js&files[]=prototype/dist/prototype.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmLlave" enctype="multipart/form-data" method="post"}
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
      <td>{printlabel name=llavefecha&blBold=true}</td>
      <td>{calendar name="llav__llavefecini" id="llavefecini" form_name="frmLlave" hour="true"}
      {printlabel name=to&blBold=true}
      {calendar name="llav__llavefecfin" id="llavefecfin" form_name="frmLlave" hour="true"}<b>*</b></td>
      <td class="piedefoto">{printcoment name=llavefecha}</td>
   </tr>
   <tr>
      <td>{printlabel name=llavusuauts}</td>
      <td> 
      	{textfield id="llavusuauts" name="llave__llavusuauts" onBlur="if(this.value!='')autoReference('personal','perscodigos',Array(this),document.frmLlave.llavusuauts__desc);else document.frmLlave.llavusuauts__desc.value='';"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdLstHelp','table=personal&sqlid=personal&return_obj=llave__llavusuauts&return_key=perscodigos&personal__perscodigos='+document.frmLlave.llave__llavusuauts.value+'&personal__persnombres='+document.frmLlave.llavusuauts__desc.value);"
	    }
        {textfield name="llavusuauts__desc"}
     </td>
  	<td class="piedefoto">{printcoment name=llavusuauts}</td>
   </tr>
   <tr>
      <td>{printlabel name=llavususols}</td>
      <td> 
      	{textfield id="llavususols" name="llave__llavususols" onBlur="if(this.value!='')autoReference('personal','perscodigos',Array(this),document.frmLlave.llavususols__desc);else document.frmLlave.llavususols__desc.value='';"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdLstHelp','table=personal&sqlid=personal&return_obj=llave__llavususols&return_key=perscodigos&personal__perscodigos='+document.frmLlave.llave__llavususols.value+'&personal__persnombres='+document.frmLlave.llavususols__desc.value);"
	    }
        {textfield name="llavususols__desc"}
     </td>
  	<td class="piedefoto">{printcoment name=llavususols}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
	</td>
</tr>
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
		<tr><td colspan="3"><div align="center">
		    	{btn_command type="button" value="Consultar" id="CmdShow" onClick="consult__flag.value = 1;" name="FeCrCmdDefaultListadoLlave" form_name="frmLlave"}
				{btn_clean table_name="ListadoLlave" form_name="frmLlave"}
			</div></td></tr>
		<tr><td colspan="3" class="piedefoto">&nbsp;</td></tr>
		</table>
	</td>
</tr>
</table>
{hidden name="action" value=""}
{hidden name="focusposition"}
{hidden name="consult__flag" value=""} 
{hidden name="total"}
{hidden name="orderby"}
{hidden name="page" value="1"}
{listadollave}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>