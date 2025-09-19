<html>
{loadlabels table_name=Emailconsult&controls[]=CmdAdd&controls[]=CmdSend&controls[]=CmdNew&controls[]=CmdDelete}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=jsAccionesCE.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmEmailConsult" method="post"}
<table border="0" align="center" width="90%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
   <tr>
      <td>{printlabel name=ordenumeros&blBold=true}</td>
   </tr>
   <tr>   
      <td>{textfield id="ordenumeros" name="email__ordenumeros" maxlength="30"}<B>*</B></td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos}</td>
   </tr>
   <tr>
      <td>
        {select_entes_esp id="orgacodigos" name="email__orgacodigos" form="frmEmailConsult" is_null=true}
      </td> 
   </tr>
   <tr>
      <td>{printlabel name=ordefecregdi}</td>
   </tr>
   <tr>   
      <td>{date_set_proc id="ordefecregdi" name="orden__ordefecregdi" form_name ="frmEmailConsult"}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecregdf}</td>
   </tr>
   <tr>   
      <td>{date_set_proc id="ordefecregdf" name="orden__ordefecregdf" form_name ="frmEmailConsult"}</td>
   </tr>
   <tr>
      <td>{printlabel name=foemcodigos}</td>
   </tr>
   <tr>   
      <td>{select_row_table id="foemcodigos" name="email__foemcodigos" value="foemcodigos" sqlid="formatoemail" label="foemnombres" is_null="true"}</td>
    </tr>
   <tr>
      <td>{printlabel name=emaiestados}</td>
  	</tr>
  	<tr>    
      <td>{select_state id="emaiestados" name="email__emaiestados" option="3" is_null="true"}</td>
    </tr>
   <tr>
		<td>
			<div align="left">
		    	{btn_commandCE type="button" value="Adicionar" id="CmdAdd"  name="CmdAdd" 
		    	onclick="jsRefreshCE('FeGeCmdCentroEmailConsult','FeGeCmdCentroEmailList');" form_name="frmEmailConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Emailconsult}
</html>