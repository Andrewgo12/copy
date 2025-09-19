<html>
{loadlabels_pub table_name=Cliente controls="CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCliente" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context_pub}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <!-- <tr>
      <td>{printlabel_pub name=cliecodigos blBold=true}</td>
      <td>{textfield id="cliecodigos" name="cliente__cliecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=cliecodigos}</td>
   </tr>-->
   <tr>
      <td>{printlabel_pub name=clieidentifs blBold=true}</td>
      <td>{textfield id="clieidentifs" name="cliente__clieidentifs" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=clieidentifs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=tiidcodigos blBold=true}</td>
      <td>{select_row_table_lang id="tiidcodigos" name="cliente__tiidcodigos" table_name="tipoidentifi" value="tiidcodigos" label="tiidnombres" is_null="true" sqlid="tipoidentifi"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=tiidcodigos}</td>
   </tr>   
   <tr>
      <td>{printlabel_pub name=ticlcodigos blBold=true}</td>
      <td>{select_row_table_lang id="ticlcodigos" name="cliente__ticlcodigos" table_name="tipocliente" value="ticlcodigos" label="ticlnombres" is_null="true" sqlid="tipocliente"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=ticlcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=clienombres blBold=true}</td>
      <td>{textfield id="clienombres" name="cliente__clienombres" size="50" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=clienombres}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="clierepprnos"}</td>
      <td>{textfield id="clierepprnos" name="cliente__clierepprnos" maxlength="20" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=clierepprnos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="clierepsenos"}</td>
      <td>{textfield id="clierepsenos" name="cliente__clierepsenos" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=clierepsenos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="cliereppraps"}</td>
      <td>{textfield id="cliereppraps" name="cliente__cliereppraps" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=cliereppraps}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="clierepseaps"}</td>
      <td>{textfield id="clierepseaps" name="cliente__clierepseaps" maxlength="30" typeData="string"}</td>
  	<td class="piedefoto">{printcoment_pub name=clierepseaps}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=clielocalizs blBold=true}</td>
      <td>{textfield id="clielocalizs" name="cliente__clielocalizs" size="50" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=clielocalizs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=clietelefons blBold=true}</td>
      <td>{textfield id="clietelefons" name="cliente__clietelefons" maxlength="13" typeData="int"}<B>*</B></td>
  	<td class="piedefoto">{printcoment_pub name=clietelefons}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=locacodigos blBold=true}</td>
      <td> 
      	{textfield id="locacodigos" name="cliente__locacodigos" onBlur="if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmCliente.cliente_locacodigos_desc);else document.frmCliente.cliente_locacodigos_desc.value='';"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='absmiddle'></img>"
	      		onclick="javascript:fncopenwindows('FeCuCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=cliente__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmCliente.locacodigos.value+'&localizacion__locanombres='+document.frmCliente.cliente_locacodigos_desc.value);"
	    }
        {textfield name="cliente_locacodigos_desc"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment_pub name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=cliepagwebs}</td>
      <td>{textfield id="cliepagwebs" name="cliente__cliepagwebs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment_pub name=cliepagwebs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=cliemails}</td>
      <td>{textfield id="cliemails" name="cliente__cliemails" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment_pub name=cliemails}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=esclcodigos blBold=true}</td>
      <td>{select_row_table_lang id="esclcodigos" name="cliente__esclcodigos" table_name="estadoclient" value="esclcodigos" label="esclnombres" is_null="true" sqlid="estadoclient"}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name=esclcodigos}</td>
   </tr>

   <!--<tr>
      <td>{printlabel_pub name=grclcodigos}</td>
      <td>{textfield id="grclcodigos" name="cliente__grclcodigos" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment_pub name=grclcodigos}</td>
   </tr>-->
   <tr>
      <td>{printlabel_pub name=clienumfaxs}</td>
      <td>{textfield id="clienumfaxs" name="cliente__clienumfaxs" maxlength="13" typeData="int"}</td>
  	<td class="piedefoto">{printcoment_pub name=clienumfaxs}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=clieaparaers}</td>
      <td>{textfield id="clieaparaers" name="cliente__clieaparaers" maxlength="200"}</td>
  	<td class="piedefoto">{printcoment_pub name=clieaparaers}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name=clieactivas}</td>
      <td>{select_estado id="clieactivas" name="cliente__clieactivas" table="cliente"}</td>
  	<td class="piedefoto">{printcoment_pub name=clieactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddCliente" form_name="frmCliente"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateCliente" form_name="frmCliente" loadFields="cliente__cliecodigos,cliente__clieidentifs,cliente__locacodigos,cliente__esclcodigos,cliente__ticlcodigos,cliente__clienombres,cliente__tiidcodigos,cliente__clielocalizs,cliente__clietelefons" confirm="8"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteCliente" form_name="frmCliente" loadFields="cliente__cliecodigos" confirm="9"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListCliente" form_name="frmCliente"}
				{btn_clean table_name="Cliente" form_name="frmCliente"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden id="cliecodigos" name="cliente__cliecodigos"}
{/form}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Cliente}
</html>