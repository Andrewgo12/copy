<html>
{loadlabels_pub table_name="Contacto" controls="CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=prototype/dist/prototype.js&files[]=encode.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmContacto" method="post"}
<table border="0" align="center" width="70%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context_pub}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
   <tr>
      <td width='25%'>{printlabel_pub name="contindentis" blBold="true"}</td>
      <td width='60%'>{textfield id="contindentis" name="contacto__contindentis" maxlength="100"}<b>*</b></td>
  	<td width='15%' class="piedefoto">{printcoment_pub name=contindentis}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="tiidcodigos" blBold="true"}</td>
      <td>{select_row_table_lang id="tiidcodigos" name="contacto__tiidcodigos" table_name="tipoidentifi" value="tiidcodigos" label="tiidnombres" is_null="true" sqlid="tipoidentifi"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=tiidcodigos}</td>
   </tr>
   <!-- <tr>
      <td>{printlabel_pub name="cliecodigos"}</td>
      <td>
      	 {dataselectdojo htmlid="contacto__cliecodigos" name="contacto__cliecodigos" sqlid="cliente_ref" value="cliecodigos" label="clienombres" forceautoreference="true"} 
	    {href 
	      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdDefaultCliente','');"
	    }
     </td>
  	<td class="piedefoto">{printcoment_pub name=cliecodigos}</td>
   </tr>-->
   <tr>
      <td>{printlabel_pub name="contprinoms" blBold="true"}</td>
      <td>{textfield id="contprinoms" name="contacto__contprinoms" maxlength="20" typeData="string"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=contprinoms}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contsegnoms"}</td>
      <td>{textfield id="contsegnoms" name="contacto__contsegnoms" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=contsegnoms}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contpriapes" blBold="true"}</td>
      <td>{textfield id="contpriapes" name="contacto__contpriapes" maxlength="30" typeData="string"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=contpriapes}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contsegapes"}</td>
      <td>{textfield id="contsegapes" name="contacto__contsegapes" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=contsegapes}</td>
   </tr>
	<tr>
      <td>{printlabel_pub name=contfecnacis}</td>
      <td>{calendar id="contfecnacis" name="contacto__contfecnacis" form_name ="frmContacto" is_null="true"}</td>
  	<td class="piedefoto">{printcoment_pub name=contfecnacis}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contedadn"}</td>
      <td>{textfield id="contedadn" name="contacto__contedadn" maxlength="3" readonly="true"}</td>
  	<td class="piedefoto">{printcoment_pub name=contedadn}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contsexos" blBold="true"}</td>
      <td>{select_row_table_lang id="contsexos" name="contacto__contsexos" table_name="sexo" value="sexocodigos" label="sexonombres" is_null="true" sqlid="sexo"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=contsexos}</td>
   </tr>   
   <tr>
      <td>{printlabel_pub name="contemail"}</td>
      <td>{textfield id="contemail" name="contacto__contemail" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment_pub name=contemail}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=locacodigos"}</td>
      <td> 
      	{textfield id="locacodigos" name="contacto__locacodigos" onBlur="if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmContacto.contacto_locacodigos_desc);else document.frmContacto.contacto_locacodigos_desc.value='';"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdTreeHelp',  'table=localizacion&sqlid=localizacion&return_obj=contacto__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmContacto.contacto__locacodigos.value+'&localizacion__locanombres='+document.frmContacto.contacto_locacodigos_desc.value);"
	    }
        {textfield name="contacto_locacodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment_pub name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contdirecios"}</td>
      <td>{textfield id="contdirecios" name="contacto__contdirecios" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment_pub name=contdirecios}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="conttelefons"}</td>
      <td>{textfield id="conttelefons" name="contacto__conttelefons" maxlength="13" typeData="int"}</td>
  	<td class="piedefoto">{printcoment_pub name=conttelefons}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contnumcels"}</td>
      <td>{textfield id="contnumcels" name="contacto__contnumcels" maxlength="13" typeData="int"}</td>
  	<td class="piedefoto">{printcoment_pub name=contnumcels}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contobservs"}</td>
      <td>{textarea id="contobservs" name="contacto__contobservs" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment_pub name=contobservs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="contactivas"}</td>
      <td>{select_estado id="contactivas" name="contacto__contactivas" table="contacto"}</td>
  	<td class="piedefoto">{printcoment_pub name=contactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddContacto" form_name="frmContacto"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateContacto" form_name="frmContacto" loadFields="contacto__contindentis,contacto__contprinoms,contacto__contpriapes,contacto__contsexos" confirm="8"}
				{btn_command type="button" value="Borrar" id="CmdDelete" name="FeCuCmdDeleteContacto" form_name="frmContacto" loadFields="contacto__contindentis" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListContacto" form_name="frmContacto"}
				{btn_clean table_name="Contacto" form_name="frmContacto"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="contacto__contcodigon"}
{hidden id="contacto__cliecodigos" name="contacto__cliecodigos"}
{/form}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Contacto}
</html>