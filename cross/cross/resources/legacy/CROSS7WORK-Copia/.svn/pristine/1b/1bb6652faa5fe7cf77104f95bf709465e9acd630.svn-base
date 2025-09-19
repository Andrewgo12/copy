<html>
{loadlabels table_name=configencuesta&controls[]=CmdAdd&controls[]=CmdClean&controls[]=CmdAccept}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=configEncuesta.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmConfigEncuesta" method="post"}

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
      <td>{printlabel name=formcodigon&blBold=true}</td>
      <td colspan="2">{select_row_table id="formcodigon" sqlid="formulario" name="formulario__formcodigon" table_name="formulario" value="formcodigon" label="formnombres" is_null="true" onchange="jsLoadFormulario();"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=formcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=pregpadren}</td>
      <td colspan="2"><select id="pregpadren" name="formulario__pregpadren" onchange="jsAction();"><option value="">---</option></select></td>
  	<td class="piedefoto">{printcoment name=pregpadren}</td>
   </tr>
      <td>{printlabel name=pregcodigon&blBold=true}</td>
      <td colspan="2">{select_row_table id="pregcodigon" sqlid="pregunta" name="formulario__pregcodigon" table_name="pregunta" value="pregcodigon" label="pregdescris" is_null="true" onchange="jsLoadRespuesta();"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=pregcodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=objecodigon&blBold=true}</td>
      <td colspan="2"><select id="objecodigon" name="formulario__objecodigon" ><option value="">---</option></select><B>*</B></td>
  	<td class="piedefoto">{printcoment name=objecodigon}</td>
   </tr>
   </tr>
      <td>{printlabel name=oprecodigon&blBold=true}</td>
      <td><select id="oprecodigon" name="formulario__oprecodigon" multiple><option value="">---</option></select><B>*</B>
      {href 
	      	label="<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>"
	      	onclick="javascript:drawRespuesta();"
	  }
      </td>
      <td>{div id="div_respuesta" align="center"}{/div}</td>
  	<td class="piedefoto">{printcoment name=oprecodigon}</td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	{btn_button value="Adicionar" id="CmdAdd" name="FeEnCmdAddAnswers" onClick="jsAddPregunta();"}
				{btn_button value="Aceptar" id="CmdAccept" name="FeEnCmdSaveConfig" onClick="jsSaveConfig();"}
				{btn_clean table_name="ConfigEncuesta" form_name="frmConfigEncuesta"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="3">{div id="div_configuracion" align="center"}{/div}</td>
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
{droptmpfile table_name=configencuesta}
</html>