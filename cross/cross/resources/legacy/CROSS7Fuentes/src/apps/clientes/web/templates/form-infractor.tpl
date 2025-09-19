<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels_pub table_name=Infractor controls="CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"}
{head}
<title>{printtitle_pub}</title>

     

{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmInfractor" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context_pub}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel_pub name=tiidcodigos}</td>
      <td>{select_row_table_lang id="tiidcodigos" name="infractor__tiidcodigos" table_name="tipoidentifi" label="tiidnombres" id="tiidcodigos" value="tiidcodigos" is_null="true"}</td>
  	<td class="piedefoto">{printcoment_pub name=tiidcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=infrcodigos blBold=true}</td>
      <td>{textfield id="infrcodigos" name="infractor__infrcodigos" size=20 maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=infrcodigos}</td>
   </tr>
  
   <tr>
      <td>{printlabel_pub name=infrnombres blBold=true}</td>
      <td>{textfield id="infrnombres" name="infractor__infrnombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=infrnombres}</td>
   </tr>
   
   <tr>
      <td>{printlabel_pub name=infrlocalizs}</td>
      <td>{textfield id="infrlocalizs" name="infractor__infrlocalizs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment_pub name=infrlocalizs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=infrtelefons}</td>
      <td>{textfield id="infrtelefons" name="infractor__infrtelefons" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment_pub name=infrtelefons}</td>
   </tr>
   <tr>
   	  <td>{printlabel_pub name=locacodigos blBold=true}</td>
  	<td> 
      	{textfield id="locacodigos" name="infractor__locacodigos" onBlur="if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmInfractor.infractor_locacodigos_desc);else document.frmInfractor.infractor_locacodigos_desc.value='';"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=infractor__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmInfractor.infractor__locacodigos.value+'&localizacion__locanombres='+document.frmInfractor.infractor_locacodigos_desc.value);"
	    }
        {textfield name="infractor_locacodigos_desc"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment_pub name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=infrnumfaxs}</td>
      <td>{textfield id="infrnumfaxs" name="infractor__infrnumfaxs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment_pub name=infrnumfaxs}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddInfractor" form_name="frmInfractor"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateInfractor" form_name="frmInfractor"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteInfractor" form_name="frmInfractor"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListInfractor" form_name="frmInfractor"}
				{btn_clean table_name="Infractor" form_name="frmInfractor"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="infractor__infractivas" value=""}
{/form}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Infractor}


</html>
