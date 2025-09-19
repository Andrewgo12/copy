<html>
{loadlabels table_name=listadoseguimientos&controls[]=CmdShow&controls[]=CmdPrint&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmSeguimiento" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	{loadTarecodigos}
	<tr>
      <td width='25%'>{printlabel name=ordenumeros}</td>
      <td width='60%'>{textfield_ordenumeros id="ordenumeros" name="ordenumeros" maxlength="30"}</td>
  	<td class="piedefoto" width='15%'>{printcoment name=ordenumeros}</td>
   </tr>
  	
   <tr>
      <td>{printlabel name=ordefecregd}</td>
      <td>
      {calendar id="ordefecregd" name="ordefecregd" is_null="true" form_name ="frmSeguimiento" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecregd}</td>
   </tr>
<!--   <tr>
      <td>{printlabel name=infrcodigos}</td>
      <td> 
      	{textfield id="infrcodigos" name="infrcodigos" onBlur="if(this.value!='')autoReference('infractor','infrcodigos',Array(this),document.frmSeguimiento.infrcodigos_desc); else document.frmSeguimiento.infrcodigos_desc.value='';"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdLstHelp','table=infractor&sqlid=infractor&return_obj=infrcodigos&return_key=infrcodigos&infractor__infrcodigos='+document.frmSeguimiento.infrcodigos.value+'&infractor__infrnombres='+document.frmSeguimiento.infrcodigos_desc.value);"
	    }
        {textfield name="infrcodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment name=infrcodigos}</td>
   </tr>
 -->  
   <tr>
      <td>{printlabel name=tiorcodigos}</td>
      <td>{select_row_table id="tiorcodigos" name="tiorcodigos" sqlid="tipoorden" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true" command_default="FeCrCmdDefaultSeguimiento"}</td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
   	  <td>{printlabel name=evencodigos}</td>
   	  <td>
		{select_son name="evencodigos"
		     table_hijo="evento" 
		     id_hijo="evencodigos"
		     label_hijo="evennombres"
		     foreign_name=""
		     select_papa="tiorcodigos"
		     sqlid="tipoorden_evento"
		     command_default="FeCrCmdDefaultSeguimiento"}
  	<td class="piedefoto">{printcoment name=evencodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=causcodigos}</td>
      <td>
		{select_son name="causcodigos"
		     table_hijo="causa" 
		     id_hijo="causcodigos"
		     label_hijo="causnombres"
		     foreign_name=""
		     select_papa="tiorcodigos,evencodigos"
		     sqlid="tipoorden_evento_causa"}     
      </td>
  	<td class="piedefoto">{printcoment name=causcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
      <td>
          {select_entes_esp id="orgacodigos" name="orgacodigos" is_null="true" form="frmSeguimiento"}
          {checkbox name="children" value="OK"}
      </td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
   	  <td>{printlabel name=locacodigos}</td>
   	  <td>
      	{textfield id="locacodigos" name="locacodigos" onBlur="if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.locacodigos_desc)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmSeguimiento.locacodigos.value+'&locacodigos_desc='+document.frmSeguimiento.locacodigos_desc.value);"
	    }
        {textfield name="locacodigos_desc"}      
      </td>
  	<td class="piedefoto">{printcoment name=locacodigos}</td>
   </tr>
   <tr>
   	  <td>{printlabel name=compcodigos}</td>
   	  <td>
      	{select_row_table table_name="compromiso" is_null="true" id="compcodigos" name="compcodigos" value="compcodigos" label="compdescris"}
      </td>
  	<td class="piedefoto">{printcoment name=compcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=accofecrevn}</td>
      <td>
      {calendar id="accofecrevn" name="accofecrevn" is_null="true" form_name ="frmSeguimiento" }
      </td>
  	<td class="piedefoto">{printcoment name=accofecrevn}</td>
   </tr>
   <tr>
   	  <td>{printlabel name=accoactivas}</td>
   	  <td>
      	{select_constant id="accoactivas" name="accoactivas"}
      </td>
  	<td class="piedefoto">{printcoment name=accoactivas}</td>
   </tr>
	
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Consultar" onClick="document.frmSeguimiento.consult__flag.value = 1;" id="CmdShow" name="FeCrCmdDefaultSeguimiento" form_name="frmSeguimiento"}
				{btn_clean table_name="Seguimiento" form_name="frmSeguimiento"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table><br><br>
{hidden name="action" value=""}
{hidden name="consult__flag"}
{hidden name="acta"}
{hidden name="tarecodigos"}
{hidden name="compromiso"}
{hidden name="acemnumerosupd"}
{hidden name="orga"}
{hidden name="orden"}

{viewListadoSeguimientos form="frmSeguimiento"}

{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Orden}
</html>