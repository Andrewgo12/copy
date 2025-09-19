<html>
{loadlabels table_name=RevertPerformance&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js}

{/head}

{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmRevertPerformance" method="post"}
<table border="0" align="center" width="80%">
	<tr><td colspan="3" class="piedefoto" align="center">{help_context}</td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
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
				{btn_command type="button" value="Consultar" onClick="signal.value=1;" id="CmdShow" name="FeCrCmdDefaultRevertPerformance" form_name="frmRevertPerformance"}
				{btn_clean table_name="RevertPerformance" onClick="signal.value=0;" form_name="frmRevertPerformance"}				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<table border="0" align="center" width="80%">
    <tr>
        <td class='piedefoto'>{viewrevertperformance form="frmRevertPerformance"}</td>
    </tr>
</table>
{hidden name="action"}
{hidden name="signal"}
{hidden name="message"}
{hidden name="orden"}
{hidden name="acta"}
{hidden name="acemnumeros"}
{putjsacceskey}
{fieldset}
     {message_orden id=$cod_message param=$param signal=$signal}
{/fieldset}
<br>
{/form}
{/body}
{droptmpfile table_name=RevertPerformance}
</html>