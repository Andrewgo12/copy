<html>
{loadlabels table_name=Contrato&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=AutoCompletar.js&files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmContrato" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=contnics&blBold=true}</td>
      <td>{textfield id="contnics" name="contrato__contnics" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=contnics}</td>
   </tr>
   <tr>
      <td>{printlabel name=clieidentifs&blBold=true}</td>
      <td>
      	{textfield id="clieidentifs" name="contrato__clieidentifs" onBlur="if(this.value)autoReference('cliente','clieidentifs',Array(this),this.form.contrato_clieidentifs_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdLstHelp','table=cliente&sqlid=cliente&return_obj=contrato__clieidentifs&return_key=clieidentifs');"
	    }
        {textfield name="contrato_clieidentifs_desc"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=clieidentifs}</td>
   </tr>
   <tr>
      <td>{printlabel name=ticocodigos&blBold=true}</td>
      <td>{select_row_table id="ticocodigos" name="contrato__ticocodigos" table_name="tipocontrato" value="ticocodigos" label="ticonombres" is_null="true" sqlid="tipocontrato"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ticocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=contobjetos&blBold=true}</td>
      <td>{textarea id="contobjetos" name="contrato_contobjetos" cols="40" rows="5" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=contobjetos}</td>
   </tr>
   <tr>
      <td>{printlabel name=timocodigos&blBold=true}</td>
      <td>{select_row_table id="timocodigos" name="contrato__timocodigos" table_name="tipomoneda" value="timocodigos" label="timonombres" is_null="true" sqlid="tipomoneda"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=timocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=contmonton}</td>
      <td>{textfield id="contmonton" name="contrato__contmonton" maxlength="NaN" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=contmonton}</td>
   </tr>
   <tr>
      <td>{printlabel name=fopacodigos&blBold=true}</td>
      <td>{select_row_table id="fopacodigos" name="contrato__fopacodigos" table_name="formapago" value="fopacodigos" label="fopanombres" is_null="true" sqlid="formapago"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=fopacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=contfchainin&blBold=true}</td>
      <td>
      {calendar id="contfchainin" name="contrato__contfchainin" form_name ="frmContrato" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=contfchainin}</td>
   </tr>
   <tr>
      <td>{printlabel name=contfchafinn}</td>
      <td>{calendar id="contfchafinn" name="contrato__contfchafinn" form_name ="frmContrato" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=contfchafinn}</td>
   </tr>
   <tr>
      <td>{printlabel name=contfchfirmn}</td>
      <td>{calendar id="contfchfirmn" name="contrato__contfchfirmn" is_null="true" form_name ="frmContrato" }</td>
  	<td class="piedefoto">{printcoment name=contfchfirmn}</td>
   </tr>
   <tr>
      <td>{printlabel name=contdescrips}</td>
      <td>{textarea id="contdescrips" name="contrato_contdescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=contdescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=contestados}</td>
      <td>{select_estado id="contestados" name="contrato__contestados" table="contrato"}</td>
  	<td class="piedefoto">{printcoment name=contestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddContrato" form_name="frmContrato"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateContrato" form_name="frmContrato" loadFields="contrato__contnics,contrato__clieidentifs,contrato__ticocodigos,contrato_contobjetos,contrato__timocodigos,contrato__fopacodigos,contrato__contfchainin" confirm="8"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCuCmdDeleteContrato" form_name="frmContrato" loadFields="contrato__contnics,contrato__clieidentifs,contrato__ticocodigos,contrato_contobjetos,contrato__timocodigos,contrato__fopacodigos,contrato__contfchainin" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListContrato" form_name="frmContrato"}
				{btn_clean table_name="Contrato" form_name="frmContrato"}
			</div>
		</td>
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
{droptmpfile table_name=Contrato}

</html>
