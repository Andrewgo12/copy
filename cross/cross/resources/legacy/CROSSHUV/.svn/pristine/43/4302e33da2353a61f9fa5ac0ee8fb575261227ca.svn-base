<html>
{loadlabels table_name=tareapersona&controls[]=CmdClean&controls[]=CmdAccept&controls[]=CmdDelete}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=relacionTP.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmTareaPersona" method="post"}

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
      <td>{printlabel name=proccodigos&blBold=true}</td>
      <td colspan="2">{select_row_table_service id="proccodigos" name="relatarepers__proccodigos" table_name="proceso" value="proccodigos" label="procnombres" is_null="true" service="Workflow" onchange="jsLoadTarea();"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=proccodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tarecodigos&blBold=true}</td>
      <td colspan="2"><select id="tarecodigos" name="relatarepers__tarecodigos" onchange="jsDrawRelacion();"><option value="">---</option></select><B>*</B></td>
  	<td class="piedefoto">{printcoment name=tarecodigos}</td>
  	</tr>
  	<tr>
   	  <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td colspan="2">
        {select_entes_esp id="orgacodigos" name="relatarepers__orgacodigos" form="frmTareaPersona" is_null=true}<B>*</B>
        {href 
	      	label="<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>"
	      	onclick="javascript:jsAddEnte();"
	  }
      </td> 
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
				{btn_button value="Aceptar" id="CmdAccept" name="FeGeCmdSaveRelacion" onClick="jsSaveRelacion();"}
				{btn_button value="Eliminar" id="CmdDelete" name="FeGeCmdDeleteRelacion" onClick="jsDeleteRelacion();"}
				{btn_clean table_name="RelacionTarea_Persona" form_name="frmTareaPersona"}
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