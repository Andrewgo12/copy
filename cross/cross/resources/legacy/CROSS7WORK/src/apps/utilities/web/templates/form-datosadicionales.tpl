<html>
{loadlabels table_name=datosadicionales&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsLoadSelect.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmDatosAdic" method="post"}
<table border="0" align="center" width="60%">
  	
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
  	
  	<tr><td colspan="3">
	{viewDimensiones sbTabla="dimension" sbLlave="dimecodigon,dimedescrips,dimeusuarios"}
	</td></tr> 	
	
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td>{printlabel name=dedinombres&blBold=true}</td>
      <td>{textfield id="dedinombres" name="dedinombres" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=dedinombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=deditipodats&blBold=true}</td>
      <td>{select_constant id="deditipodats" name="deditipodats"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=deditipodats}</td>
   </tr>
   <tr>
      <td>{printlabel name=deditamtips&blBold=true}</td>
      <td>{textfield id="deditamtips" name="deditamtips" maxlength="3" typeData="int"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=deditamtips}</td>
   </tr>
   <tr>
      <td>{printlabel name=deditipobjes&blBold=true}</td>
      <td>{select_constant id="deditipobjes" name="deditipobjes"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=deditipobjes}</td>
   </tr>
   <tr>
      <td>{printlabel name=dedinotnulls&blBold=true}</td>
      <td>{select_constant id="dedinotnulls" name="dedinotnulls"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=dedinotnulls}</td>
   </tr>
   <tr>
      <td>{printlabel name=dediordenn&blBold=true}</td>
      <td>{textfield id="dediordenn" name="dediordenn" maxlength="2" typeData="int"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=dediordenn}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddDatosAdicionalesWeb" form_name="frmDatosAdic"}
				{btn_clean table_name="Localizacion" form_name="frmDatosAdic"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	
	<tr><td colspan="3">
	{viewDetalles sbTabla="detalledimens" sbLlave="dimecodigon,dedinombres,deditipodats,deditipobjes,dediordenn"}
	</td></tr> 	
	
</table>
{hidden name="action" value=""}
{hidden name="dimecodigon"}
{hidden name="dededidefaults"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>