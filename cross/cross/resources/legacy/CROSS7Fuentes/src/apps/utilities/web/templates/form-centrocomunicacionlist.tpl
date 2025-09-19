<html>
{loadlabels table_name=Comunicacion&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsAccionesCT.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmComunicacionList" method="post"}
<table border="0" align="center" width="100%">
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
	    	<td colspan="2" class="piedefoto">{consult_table_comunicacion 
	    	table="comunicacion" 
   			submit="FeGeCmdCentroComunicacionList"
   			command="FeGeCmdCentroComunicacionPreview"
   			key_return="comucodigos"
   			jsfunction="jsPreviewCT"
   			form="frmComunicacionList"
   			cache="false"
   			checkbox="1"
   			checkbox_value="comucodigos"
   			num_rows="20"
   }</td>
	        <td class="piedefoto"></td>
	    </tr>
</table>
{hidden name="action" value=""}
{hidden id="ordenumeros" name="comunicacion__ordenumeros"}
{hidden id="focacodigos" name="comunicacion__focacodigos"}
{hidden id="ordefecregdi" name="orden__ordefecregdi"}
{hidden id="ordefecregdf" name="orden__ordefecregdf"}
{hidden id="emaiestados" name="comunicacion__comuestados"}
{hidden name="selectcheck" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Comunicacion}
</html>