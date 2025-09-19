<html>
{loadlabels table_name=FichaOrd&controls[]=CmdShow&controls[]=CmdShowInnova}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFichaOrd" method="post"}
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center">{help_context}</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=ordenumeros&blBold=true}</td>
      <td>{textfield id="ordenumeros" name="orden__ordenumeros" is_null="true"}<B>*</B></td>
      <td class="piedefoto">{printcoment name=ordenumeros}</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button type="button" value="Consultar" id="CmdShow" name="FeCrCmdDefaultFichaOrd" form_name="frmFichaOrd" 
				onClick="if(!this.form.orden__ordenumeros.value)location='index.php?action=FeCrCmdDefaultFichaOrd&cod_message=0'; if(this.form.orden__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO='+this.form.orden__ordenumeros.value+'&vars=ordenumerosFO');if(this.form.orden__ordenumeros.value)this.form.action.value='FeCrCmdDefaultFichaOrd';"}				
				{btn_viewinnova type="button" value="Consultar" id="CmdShowInnova" name="FeCrCmdDefaultDocsInnova" form_name="frmFichaOrd"}				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultFichaOrd"}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/form}
{/body}
{droptmpfile table_name=FichaOrd}
</html>