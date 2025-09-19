<html>
{loadlabels table_name=Email&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsAccionesCE.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmEmailList" method="post"}
<table border="0" align="center" width="100%">
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
	    	<td colspan="2" class="piedefoto">{consult_table_email 
	    	table="email" 
   			submit="FeGeCmdCentroEmailList"
   			command="FeGeCmdCentroEmailPreview"
   			key_return="emaicodigos"
   			jsfunction="jsPreviewCE"
   			form="frmEmailList"
   			cache="false"
   			checkbox="1"
   			checkbox_value="emaicodigos"
   			num_rows="20"
   }</td>
	        <td class="piedefoto"></td>
	    </tr>
</table>
{hidden name="action" value=""}
{hidden id="ordenumeros" name="email__ordenumeros"}
{hidden  id="orgacodigos" name="email__orgacodigos"}
{hidden id="ordefecregdi" name="orden__ordefecregdi"}
{hidden id="ordefecregdf" name="orden__ordefecregdf"}
{hidden id="emaiestados" name="email__emaiestados"}
{hidden id="foemcodigos" name="email__foemcodigos"}
{hidden name="selectcheck" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Email}
</html>