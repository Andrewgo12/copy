<html>
{loadlabels table_name=Proceso&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
      
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=jsLoadSelect.js&files[]=fncWindowOpen.js&files[]=jsManageRutas.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmProceso" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <!--<tr>
      <td>{printlabel name=proccodigos}</td>
      <td>{textfield id="proccodigos" name="proceso__proccodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=proccodigos}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=procnombres&blBold=true}</td>
      <td>{textfield id="procnombres" name="proceso__procnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=procnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>{select_dataservices id="orgacodigos" name="proceso__orgacodigos" value="orgacodigos" label="organombres" is_null="true" service="Human_resources" method="getActiveEntesOrg"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=procdescris}</td>
      <td>{textarea id="procdescris" name="proceso__procdescris" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=procdescris}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=perscodigos}</td>
      <td>{hidden name="proceso__perscodigos"}</td>
  	<td class="piedefoto">{printcoment name=perscodigos}</td>
   </tr>-->
   <!--<tr>
      <td>{printlabel name=procestinis}</td>
      <td>{select_row_table id="procestinis" name="proceso__procestinis" table_name="estadoproces" label="esprnombres" value="esprcodigos" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=procestinis}</td>
   </tr>
   <tr>
      <td>{printlabel name=procestfins}</td>
      <td>{select_row_table id="procestfins" name="proceso__procestfins" table_name="estadoproces" label="esprnombres" value="esprcodigos" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=procestfins}</td>
   </tr>-->
   <!--<tr>
      <td>{printlabel name=procfeccren}</td>
      <td>{calendar id="procfeccren" name="proceso__procfeccren" form_name ="frmProceso"}</td>
  	<td class="piedefoto">{printcoment name=procfeccren}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=proctiempon&blBold=true}</td>
      <td>
          {proctiempon}
      </td>
  	<td class="piedefoto">{printcoment name=proctiempon}<b>*</b></td>
   </tr>
   <tr>
      <td>{printlabel name=procactivas}</td>
      <td>{select_estado id="procactivas" name="proceso__procactivas" table="proceso"}</td>
  	<td class="piedefoto">{printcoment name=procactivas}</td>
   </tr>
	
	<tr>
		<th colspan="3"><div align='left'>{printlabel name=configuration}</div></th>
	</tr>
 
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{select_row_table id="tiorcodigos" 
      		name="tiorcodigos" 
      		sqlid="tipoorden" 
      		table_name="tipoorden" 
      		value="tiorcodigos" 
      		label="tiornombres" 
      		is_null="true" 
      		onchange="if(this.value)LoadSelect('tipoorden_evento','tiorcodigos',Array(this),this.form.evencodigos,'evencodigos,causcodigos');"
      	}<b>*</b></td>
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
		     onchange="if(this.value)LoadSelect('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,this.form.tiorcodigos),this.form.causcodigos);"
		 }
   	  	</td>
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
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddProceso" form_name="frmProceso"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateProceso" form_name="frmProceso" loadFields="proceso__procnombres,proceso__orgacodigos" confirm="9"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeWFCmdDeleteProceso" form_name="frmProceso" loadFields="proceso__procnombres,proceso__orgacodigos" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListProceso" form_name="frmProceso"}
				{btn_clean table_name="Proceso" form_name="frmProceso"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="proceso__proccodigos"}
{/form}
<table border="0" align="center" width="80%">
	<tr>
		<td colspan="3" class="piedefoto">{viewrutas}</td>
	</tr>
</table>

{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{literal}
		<script>
			if(document.frmNewRuta)
				document.frmNewRuta.tarecodigos.focus();
		</script>
{/literal}
{droptmpfile table_name=Proceso}
</html>