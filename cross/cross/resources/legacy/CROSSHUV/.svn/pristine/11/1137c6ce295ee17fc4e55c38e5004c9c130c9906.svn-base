<html>
{loadlabels table_name=Contacto&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmContacto" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=contindentis&blBold=true}</td>
      <td>{textfield id="contindentis" name="contacto__contindentis" maxlength="100"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=contindentis}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiidcodigos&blBold=true}</td>
      <td>{select_dataservices id="tiidcodigos" name="contacto__tiidcodigos" service="Customers" method="getAllTipoidentifi" table_name="contacto" value="tiidcodigos" label="tiidnombres" is_null="true"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=tiidcodigos}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=cliecodigon}</td>
      <td>{select_dataservices service="Customers" method="getActiveCustomers" id="cliecodigon" name="contacto__cliecodigon" value="cliecodigos" label="clienombres" is_null="true"}
  	<td class="piedefoto">{printcoment name=cliecodigon}</td>
   </tr>
   <tr>-->
      <td>{printlabel name=contnombre&blBold=true}</td>
      <td>{textfield id="contnombre" name="contacto__contnombre" maxlength="100"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=contnombre}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=contfecnacis}</td>
      <td>{calendar id="contfecnacis" name="contacto__contfecnacis" form_name ="frmContacto" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=contfecnacis}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=contsexos&blBold=true}</td>
      <td>
      <select id="contsexos" name="contacto__contsexos">
      <option value="">---</option>
      {php}
      	switch($_REQUEST['contacto__contsexos']){
      		case 'M':
      			echo "<option value=\"ND\">ND</option>";
      			echo "<option value=\"M\" selected>M</option>";
      			echo "<option value=\"F\">F</option>";
      		break;
      		case 'F':
      			echo "<option value=\"ND\">ND</option>";
      			echo "<option value=\"M\">M</option>";
      			echo "<option value=\"F\" selected>F</option>";
      		break;
      		case 'ND':
      			echo "<option value=\"ND\" selected>ND</option>";
      			echo "<option value=\"M\">M</option>";
      			echo "<option value=\"F\">F</option>";
      		break;
      		default:
      			echo "<option value=\"ND\">ND</option>";
      			echo "<option value=\"M\">M</option>";
      			echo "<option value=\"F\">F</option>";
      	}
      {/php}
      </select><b>*</b>
      </td>
  	<td class="piedefoto">{printcoment name=contsexos}</td>
   </tr>   
   <tr>
      <td>{printlabel name=contemail}</td>
      <td>{textfield id="contemail" name="contacto__contemail" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment name=contemail}</td>
   </tr>
   <tr>
      <td>{printlabel name=locacodigos}</td>
      <td> 
      	{textfield id="locacodigos" name="contacto__locacodigos" onBlur="if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.contacto_locacodigos_desc)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindow('FeCrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=contacto__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmContacto.locacodigos.value);"
	    }
        {textfield name="contacto_locacodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=contdirecios}</td>
      <td>{textfield id="contdirecios" name="contacto__contdirecios" maxlength="100" size="52"}</td>
  	<td class="piedefoto">{printcoment name=contdirecios}</td>
   </tr>
   <tr>
      <td>{printlabel name=conttelefons}</td>
      <td>{textfield id="conttelefons" name="contacto__conttelefons" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=conttelefons}</td>
   </tr>
   <tr>
      <td>{printlabel name=contobservs}</td>
      <td>{textarea id="contobservs" name="contacto__contobservs" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=contobservs}</td>
   </tr>
   <tr>
      <td>{printlabel name=contactivas}</td>
      <td>{select_estado id="contactivas" name="contacto__contactivas" table="contacto"}</td>
  	<td class="piedefoto">{printcoment name=contactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddContacto" form_name="frmContacto"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateContacto" form_name="frmContacto" loadFields="contacto__contindentis,contacto__contnombre,contacto__contsexos" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCrCmdDeleteContacto" form_name="frmContacto" loadFields="contacto__contindentis,contacto__contnombre" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListContacto" form_name="frmContacto"}
				{btn_clean table_name="Contacto" form_name="frmContacto"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="contacto__contcodigon"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Contacto}

</html>
