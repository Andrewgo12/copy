<html>
{loadlabels table_name=Emailcreate&controls[]=CmdAdd&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsAccionesCE.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmEmailCreate" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="100%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=emaiparas&blBold=true}</td>
      <td>{textfield id="emaiparas" name="email__emaiparas" size="60" maxlength="60"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=emaiparas}</td>
   </tr>   
   <tr>
      <td>{printlabel name=emaiasuntos&blBold=true}</td>
      <td>{textfield id="emaiasuntos" name="email__emaiasuntos" size="60" maxlength="60"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=emaiasuntos}</td>
   </tr>
   <tr>
      <td>{printlabel name=emaiadjuntos&blBold=true}</td>
      <td>{textfield id="emaiadjuntos" name="email__emaiadjuntos" type="file" size="60" maxlength="60"}</td>
  	<td class="piedefoto">{printcoment name=emaiadjuntos}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordenumeros&blBold=true}</td>
      <td>{textfield id="ordenumeros" name="email__ordenumeros" size="30" maxlength="60" readonly=true}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ordenumeros}</td>
   </tr>
   <tr>
      <td>{printlabel name=emaitextos&blBold=true}</td>
      <td>{textarea id="emaitextos" name="email__emaitextos" cols="80" rows="10" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=emaitextos}</td>
   </tr>
   <tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdSendEmail" form_name="frmEmailCreate"}
				{btn_cleanCE table_name="email" command="FeGeCmdCentroEmailCreate" form_name="frmEmailCreate"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="email__foemcodigos" }
{hidden name="instance" value="1"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message param=$param close=$close}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Emailcreate}
</html>