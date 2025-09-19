<html>
{loadlabels table_name=Balance&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=overlib_mini.js&files[]=Calendar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
{form name="frmBalance" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=bodecodigos&blBold=true}</td>
      <td>{select_row_table id="bodecodigos" name="balance__bodecodigos" table_name="bodega" value="bodecodigos" label="bodenombres" is_null="true"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=fecha}</td>
      <td>{calendar id="fecha" name="balance__fecha" form_name ="frmBalance" icon="web/images/calendar.gif"}</td>
  	<td class="piedefoto">{printcoment name=fecha}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command 
					type="button" 
					value="Consultar" 
					id="CmdShow" 
					name="FeStCmdDefaultBalance" 
					form_name="frmBalance"
					onClick="fncopenwindows('FeStCmdDefaultFichas','topFrame=FeStCmdDefaultHeadBalance&mainFrame=FeStCmdDefaultBodyBalance&bodecodigos='+this.form.balance__bodecodigos.value+'&fecha='+this.form.balance__fecha.value+'&vars=bodecodigos,fecha');"
					}
				{btn_clean table_name="Balance" form_name="frmBalance"}
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
{/body}
{droptmpfile table_name=Balance}

</html>