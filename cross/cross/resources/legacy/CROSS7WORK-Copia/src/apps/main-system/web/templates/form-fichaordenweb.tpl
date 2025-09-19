<html>
{loadlabels_pub table_name="FichaOrd" controls="CmdShow,CmdShowInnova"}
{head}
      <title>{printtitle_pub}</title>
{putstylepub}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsdrawDynamicColumns.js&files[]=encode.js&files[]=jsDrawdiv.js&files[]=prototype/dist/prototype.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFichaOrd" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center">{help_context_pub}</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td class="tdlabels">{printlabel_pub name="ordenumeros" blBold="true"}</td>
      <td>{textfield id="ordenumeros" name="orden__ordenumeros" is_null="true"}<B>*</B></td>
      <td class="piedefoto">{printcoment_pub name=ordenumeros}</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button type="button" value="Consultar" id="CmdShow" name="FeCrCmdDefaultFichaOrdWeb" form_name="frmFichaOrd" 
				onClick="if(!this.form.orden__ordenumeros.value)location='index.php?action=FeCrCmdDefaultFichaOrd&cod_message=0'; if(this.form.orden__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb&ordenumerosFO='+this.form.orden__ordenumeros.value+'&vars=ordenumerosFO');if(this.form.orden__ordenumeros.value)this.form.action.value='FeCrCmdDefaultFichaOrdWeb';"}				
				{btn_viewinnova type="button" value="Consultar" id="CmdShowInnova" name="FeCrCmdDefaultDocsInnova" form_name="frmFichaOrd"}				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultFichaOrdWeb"}
{hidden name="langcodigos"}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/form}
{/body}
{droptmpfile table_name=FichaOrd}
</html>