<html>
{loadlabels table_name=Llave&controls[]=CmdAdd&controls[]=CmdClean}
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
      <td>{printlabel name=llavusuauts&blBold=true}</td>
      <td> 
      	{textfield id="llavusuauts" name="llave__llavusuauts" onBlur="if(this.value!='')autoReference('personal','perscodigos',Array(this),document.frmLlave.llavusuauts__desc);else document.frmLlave.llavusuauts__desc.value='';"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdLstHelp','table=personal&sqlid=personal&return_obj=llave__llavusuauts&return_key=perscodigos&personal__perscodigos='+document.frmLlave.llave__llavusuauts.value+'&personal__persnombres='+document.frmLlave.llavusuauts__desc.value);"
	    }
        {textfield name="llavusuauts__desc"}<b>*</b>
     </td>
  	<td class="piedefoto">{printcoment name=llavusuauts}</td>
   </tr>
   <tr>
      <td>{printlabel name=llavususols&blBold=true}</td>
      <td> 
      	{textfield id="llavususols" name="llave__llavususols" onBlur="if(this.value!='')autoReference('personal','perscodigos',Array(this),document.frmLlave.llavususols__desc);else document.frmLlave.llavususols__desc.value='';"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdLstHelp','table=personal&sqlid=personal&return_obj=llave__llavususols&return_key=perscodigos&personal__perscodigos='+document.frmLlave.llave__llavususols.value+'&personal__persnombres='+document.frmLlave.llavususols__desc.value);"
	    }
        {textfield name="llavususols__desc"}<b>*</b>
     </td>
  	<td class="piedefoto">{printcoment name=llavususols}</td>
   </tr>
   <tr>
      <td>{printlabel name=llavfecinid&blBold=true}</td>
      <td>{calendar name="llave__llavfecinid" id="llavfecinid" form_name="frmLlave" hour="true"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=llavfecinid}</td>
   </tr>
   
    <tr>
      <td>{printlabel name=llavfecvend&blBold=true}</td>
      <td>{calendar name="llave__llavfecvend" id="llavfecvend" form_name="frmLlave" hour="true"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=llavfecvend}</td>
   </tr>
   <tr>
      <td>{printlabel name=llavobservs&blBold=true}</td>
      <td>{textarea id="llavobservs" name="llave__llavobservs" cols="60" rows="8" }{/textarea}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=llavobservs}</td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
   		<td colspan="2">
   			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddLlave" form_name="frmLlave"}
				{btn_clean table_name="Llave" form_name="frmLlave"}
			</div></td>
		<td class="piedefoto"></td>
  </tr>
</table>
	</td>
</tr>
</table>
{hidden name="action" value=""}
{hidden name="focusposition"} 
{/form}
{putjsacceskey}
{fieldset legend="Resultado"}
   {message_orden id=$cod_message param=$param signal=$signal error_field=$error_field label_file="fichaord"}
{/fieldset}
<br>
{/body}
</html>