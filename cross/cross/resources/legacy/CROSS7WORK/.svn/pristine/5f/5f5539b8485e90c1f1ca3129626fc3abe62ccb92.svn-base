<html>
{loadlabels_pub table_name="Solicitante" controls="CmdAdd,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstylepub style="estilospub.css"}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=prototype/dist/prototype.js&files[]=encode.js&files[]=SelectControl.js&files[]=jsSolicitantePub.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();jsDrawTypeSolPub('1');" onunload=""}
<br>
{form name="frmSolicitante" method="post"}
<table border="0" align="center" width="1000px">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context_pub}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">{printlabel_pub name=typepn blBold="true"}
      	  {radio id="typesol1" name="typesol" checked="true" onClick="jsDrawTypeSolPub('1');"}
      	  {printlabel_pub name=typepj blBold="true"}
      	  {radio id="typesol2" name="typesol" onClick="jsDrawTypeSolPub('2');"}  
      </td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
   <tr>
		<td colspan="2" class="piedefoto">
		<!-- tabla en donde iran los divs -->
		<table border="0" align="center" width="100%">
			<tr>
				<td>
					<div id="div_sol">
						&nbsp;
					<div>
				</td>
			</tr>
		</table>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;</td>
	<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Adicionar" id="CmdAdd" name="CmdAdd" onClick="jsAddSolicitantePub();"}
				{btn_clean table_name="SolicitantePub" form_name="frmSolicitante"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden id="contcodigon" name="contacto__contcodigon"}
{hidden id="cliecodigos" name="cliente__cliecodigos"}
{hidden id="signal" name="signal"}
{/form}
{putjsacceskey_pub}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Solicitante}
</html>
