<html>
{loadlabels_pub table_name="Paciente" controls="CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=prototype/dist/prototype.js&files[]=encode.js&files[]=SelectControl.js&files[]=jsPaciente.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPaciente" method="post"}
<table border="0" align="center" width="70%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
   <tr>
      <td width='25%'>{printlabel_pub name="paciindentis" blBold="true"}</td>
      <td width='60%'>{textfield id="paciindentis" name="paciente__paciindentis" maxlength="100" onChange="jsLoadPaciente();"}<b>*</b></td>
  	<td width='15%' class="piedefoto">{printcoment_pub name=paciindentis}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="tiidcodigos" blBold="true"}</td>
      <td>{select_row_table id="tiidcodigos" name="paciente__tiidcodigos" table_name="tipoidentifi" value="tiidcodigos" label="tiidnombres" is_null="true" sqlid="tipoidentifi"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=tiidcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="paciprinoms" blBold="true"}</td>
      <td>{textfield id="paciprinoms" name="paciente__paciprinoms" maxlength="20" typeData="string"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=paciprinoms}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacisegnoms"}</td>
      <td>{textfield id="pacisegnoms" name="paciente__pacisegnoms" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacisegnoms}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacipriapes" blBold="true"}</td>
      <td>{textfield id="pacipriapes" name="paciente__pacipriapes" maxlength="30" typeData="string"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=pacipriapes}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacisegapes"}</td>
      <td>{textfield id="pacisegapes" name="paciente__pacisegapes" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacisegapes}</td>
   </tr>
	<tr>
      <td>{printlabel_pub name=pacifecnacis}</td>
      <td>{calendar id="pacifecnacis" name="paciente__pacifecnacis" form_name ="frmPaciente" is_null="true"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacifecnacis}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="sexocodigos" blBold="true"}</td>
      <td>{select_row_table id="sexocodigos" name="paciente__sexocodigos" table_name="sexo" value="sexocodigos" label="sexonombres" is_null="true" sqlid="sexo"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=sexocodigos}</td>
   </tr>   
   <tr>
      <td>{printlabel_pub name="paciemail"}</td>
      <td>{textfield id="paciemail" name="paciente__paciemail" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment_pub name=paciemail}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=locacodigos"}</td>
      <td> 
      	{textfield id="locacodigos" name="paciente__locacodigos" onBlur="if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmPaciente.paciente_locacodigos_desc);else document.frmPaciente.paciente_locacodigos_desc.value='';"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdTreeHelp',  'table=localizacion&sqlid=localizacion&return_obj=paciente__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmPaciente.paciente__locacodigos.value+'&localizacion__locanombres='+document.frmPaciente.paciente_locacodigos_desc.value);"
	    }
        {textfield id="paciente_locacodigos_desc" name="paciente_locacodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment_pub name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacidirecios"}</td>
      <td>{textfield id="pacidirecios" name="paciente__pacidirecios" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacidirecios}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacitelefons"}</td>
      <td>{textfield id="pacitelefons" name="paciente__pacitelefons" maxlength="13" typeData="int"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacitelefons}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="pacinumcels"}</td>
      <td>{textfield id="pacinumcels" name="paciente__pacinumcels" maxlength="13" typeData="int"}</td>
  	<td class="piedefoto">{printcoment_pub name=pacinumcels}</td>
   </tr>
   <tr>
      <td width='25%'>{printlabel_pub name="pacihisclis"}</td>
      <td width='60%'>{textfield id="pacihisclis" name="paciente__pacihisclis" maxlength="100" size="52"}</td>
  	<td width='15%' class="piedefoto">{printcoment_pub name=pacihisclis}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="paciobservs"}</td>
      <td>{textarea id="paciobservs" name="paciente__paciobservs" cols="50" rows="2" }{/textarea}</td>
  	<td class="piedefoto">{printcoment_pub name=paciobservs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="paciactivos"}</td>
      <td>{select_estado id="paciactivos" name="paciente__paciactivos" table="paciente"}</td>
  	<td class="piedefoto">{printcoment_pub name=paciactivos}</td>
   </tr>
   <tr>
      <td>{printlabel name=contacto}</td>
      <td>{checkbox id="contacto" value="1" name="contacto"}</td>
  	<td class="piedefoto">{printcoment name=contacto}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddPaciente" form_name="frmPaciente"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdatePaciente" form_name="frmPaciente" loadFields="paciente__paciindentis,paciente__paciprinoms,paciente__pacipriapes,paciente__sexocodigos" confirm="8"}
				{btn_command type="button" value="Borrar" id="CmdDelete" name="FeCuCmdDeletePaciente" form_name="frmPaciente" loadFields="paciente__paciindentis" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListPaciente" form_name="frmPaciente"}
				{btn_clean table_name="Paciente" form_name="frmPaciente"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Paciente}
</html>