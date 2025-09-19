<html>
{loadlabels table_name=transfertareas&controls[]=CmdAdd&controls[]=CmdCancel}
{head}
      <title>Permisions</title>
{putstyle style=""}
{putjsfiles files[]=select_list.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmTranferTareas" method="post"}
  <table border="0" align="center" width="80%">
  <tr><td class="piedefoto" colspan="3"><div align="center">
	{help_context}
  </div></td></tr>
  <tr><th colspan="3">&nbsp;</th></tr>
  <tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
  <tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
		<tr>
	      <td>{printlabel name=orgacodigos&blBold=true}</td>
	      <td>{select_transference id="orgacodigost" name="orgacodigost" is_null="true" form="frmTranferTareas"}<b>*</b></td>
	      <td class="piedefoto">{printcoment name=orgacodigos}</td>
        </tr>
         <tr>
      	 <td>{printlabel name=trtafechan&blBold=true}</td>
      	 <td>{date_set_proc name="trtafechan" id="trtafechan" form_name="frmTranferTareas" is_null="true"}<b>*</b></td>
  		 <td class="piedefoto">{printcoment name=trtafechan}</td>
   		</tr>
        <tr>
	      <td>{printlabel name=trtaobservas}</td>
	      <td>{textarea id="trtaobservas" name="trtaobservas" cols="40" rows="5" }{/textarea}</td>
	      <td class="piedefoto">{printcoment name=trtaobservas}</td>
        </tr>
	    <tr> 
	      <td colspan="2">&nbsp;</td>
	      <td class="piedefoto" ></td>
	    </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdTransferTareas" form_name="frmTranferTareas"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdDefaultAdminTareas" form_name="frmTranferTareas"}
			</div>
		</td>
        <td class="piedefoto" ></td>
	</tr>
 	<tr>	<td class="piedefoto" colspan="3">&nbsp;</td></tr>
 	<tr>
 		<td class="piedefoto" colspan="3">
			{fieldset}
			   {message id=$cod_message}
			{/fieldset}
 		</td>
 	</tr>
  </table><br>
  <table border="0" align="center" width="80%">
    <tr>
       <td class="piedefoto" colspan="3"><hr></td>
    </tr>
    <!-- Pinta el titulo de la ficha-->
    <tr><th colspan="3"><div align="left">{printlabel name=card}</div></th></tr>
    <tr>
    	<!-- Pinta la ficha de tarea -->
    	<td class="piedefoto" colspan="3"><div align="center">{fichatarea}</div></td>
    </tr>
  </table>
  
{hidden name="action" value=""}
{hidden name="acta"}
{hidden name="orgacodigos"}
{hidden name="orgacodigos_desc"}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Permisions}

</html>
