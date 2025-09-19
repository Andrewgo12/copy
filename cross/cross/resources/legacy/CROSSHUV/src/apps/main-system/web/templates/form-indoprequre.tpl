<html>
{loadlabels table_name=indoprequre&controls[]=CmdAdd&controls[]=CmdClean&controls[]=CmdAccept}
<head>
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsIndoprequre.js&files[]=encode.js}
</head>
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmIndoprequre" method="post"}

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
      <td>{printlabel name=ordefecregdb&blBold=true}</td>
      <td>
      {calendar id="ordefecregdb" name="ordefecregdb" is_null="true" form_name ="frmIndoprequre" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecregdb}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecregde&blBold=true}</td>
      <td>
      {calendar id="ordefecregde" name="ordefecregde" is_null="true" form_name ="frmIndoprequre" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecregde}</td>
   </tr>

   <tr>
      <td>{printlabel name=ordefecingdb}</td>
      <td>
      {calendar id="ordefecingdb" name="ordefecingdb" is_null="true" form_name ="frmIndoprequre" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecingdb}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecingde}</td>
      <td>
      {calendar id="ordefecingde" name="ordefecingde" is_null="true" form_name ="frmIndoprequre" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecingde}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=tiorcodigos}</td>
      <td>{select_row_table id="tiorcodigos" 
      name="tiorcodigos" sqlid="tipoorden" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true" 
      onchange="if(this.value!='')LoadSelect('tipoorden_evento','tiorcodigos',Array(this),document.frmIndoprequre.evencodigos,'evencodigos,causcodigos');"}
      <br>
      <div id="tiordescrips"></div>
      </td>
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
		     onchange="if(this.value)LoadSelect('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,document.frmIndoprequre.tiorcodigos),document.frmIndoprequre.causcodigos,'causcodigos');"}
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
		     sqlid="tipoorden_evento_causa""}  
      </td>
  	<td class="piedefoto">{printcoment name=causcodigos}</td>
   </tr>
   
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow" name="FeEnCmdShowIndoprequre" onClick="jsShowIndoprequre();"}
				{btn_clean table_name="Indoprequre" form_name="frmIndoprequre"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2">{div id="div_indoprequre" align="center"}{/div}</td>
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
{droptmpfile table_name=indoprequre}
</html>