<html>
{loadlabels table_name=Formattofile&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsSendConfiguration.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFormattofile" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td>{printlabel name=tiarcodigos&blBold=true}</td>
      <td>{select_row_table name="configarchiv__tiarcodigos" table_name="tipoarchivo" id="tiarcodigos"   sqlid="tipoarchivo" command_default="FeGeCmdDefaultFormattofile" value="tiarcodigos" form_name="frmFormattofile"  is_null="true"  label="tiarnombres"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiarcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=pathtofile&blBold=true}</td>
      <td>{textfield id="pathtofile" name="formattofile__pathtofile" maxlength="150" type="file" size="40"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=pathtofile}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	    	<!-- Pinta la tabla de las tareas -->
	    	<td colspan="2">{consult_table_configarchiv 
	    	table="configarchiv" 
   			submit="FeGeCmdDefaultFormattofile"
   			command_default="FeGeCmdAddFormattofile"
   			key_return="cogacodigos"
   			jsfunction="fncsendconfiguration"
   			form="frmFormattofile"
   			cache="true"
   			num_rows="20"
   }</td>
	        <td class="piedefoto"></td>
	    </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_clean table_name="Formattofile" form_name="frmFormattofile"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="configarchiv__cogacodigos" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Formattofile}
</html>