<html>
{loadlabels table_name=Actuareq&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmActuareq" method="post"}
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center">{help_context}</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=ordenumeros}</td>
      <td>{textfield id="ordenumeros" name="orden__ordenumeros" is_null="true"}</td>
      <td class="piedefoto">{printcoment name=ordenumeros}</td>
	</tr>
   <tr>
      <td>{printlabel name=grupnombres}</td>
      <td>{select_row_table id="grupcodigos" name="organizacion__grupcodigos" sqlid="grupo" table_name="grupo" value="grupcodigos" label="grupnombres" is_null="true" sqlid="grupo"}</td>
  	<td class="piedefoto">{printcoment name=grupnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=acemfeccren}</td>
      <td>
      {calendar id="acemfeccren" name="actaempresa__acemfeccren" is_null="true" form_name ="frmActuareq" }
      {calendar id="acemfeccren" name="actaempresa__acemfeccren2" is_null="true" form_name ="frmActuareq" }
      </td>
  	<td class="piedefoto">{printcoment name=acemfeccren}</td>
   </tr>
   <tr>
      <td>{printlabel name=acemfecaten}</td>
      <td>
      {calendar id="acemfecaten" name="actaempresa__acemfecaten" is_null="true" form_name ="frmActuareq" }
      {calendar id="acemfecaten" name="actaempresa__acemfecaten2" is_null="true" form_name ="frmActuareq" }
      </td>
  	<td class="piedefoto">{printcoment name=acemfecaten}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button type="button" value="Consultar" id="CmdShow" name="FeCrCmdDefaultActuareq" form_name="frmActuareq" 
				onClick="fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyActuareq&ordenumeros='+this.form.orden__ordenumeros.value+'&grupcodigos='+this.form.organizacion__grupcodigos.value+'&acemfeccren='+this.form.actaempresa__acemfeccren.value+'&acemfeccren2='+this.form.actaempresa__acemfeccren2.value+'&acemfecaten='+this.form.actaempresa__acemfecaten.value+'&acemfecaten2='+this.form.actaempresa__acemfecaten2.value+'&vars=ordenumeros,grupcodigos,acemradics,orgacodigos,acemfeccren,acemfeccren2,acemfecaten,acemfecaten2');"}				
                {btn_clean table_name="Actuareq" form_name="frmActuareq"}
            </div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultfrmActuareq"}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/form}
{/body}
{droptmpfile table_name=Actuareq}
</html>