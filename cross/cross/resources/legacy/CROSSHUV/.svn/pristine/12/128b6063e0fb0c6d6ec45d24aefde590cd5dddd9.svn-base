<html>
{loadlabels_pub table_name="CitasWeb" controls="CmdAdd,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=encode.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmContacto" enctype="multipart/form-data" method="post"}

<table border="0" align="center" width="60%">

   
	<tr>
		<td class="piedefoto" colspan="3">
			<div align="center">{help_context_pub}</div>
		</td>
	</tr>
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
</table>

<table border="0" align="center" width="60%">
   	<tr>
      	<td colspan="2"><b>{printlabel_pub name="denunciante"}</b></td>
      	<td class="piedefoto"></td>
   	</tr>
</table>

<!-- Denunciante nuevo-->
	<table border="0" align="center" width="60%">
		<tr>
			<td class="piedefoto" colspan="3">
				<div align="center">
					<fieldset class=context_help>
						{printlabel_pub name="newcontact"}
					</fieldset>
				</div>
			</td>
		</tr>
	   	   <tr>
      <td>{printlabel_pub name="contcodigon" blBold="true"}</td>
      <td>
      	{dataselectdojo htmlid="contidentis" name="contacto__contcodigon" sqlid="contacto_ident" value="contcodigon" label="contindentis" forceautoreference="true"}
	    {href 
	      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
			onclick="javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"
	    }
	</td>
  	<td class="piedefoto">{printcoment_pub name="contcodigon"}</td>
   </tr>

<br>
<table border="0" align="center" width="60%">
   	<tr>
      	<td colspan="2"><b>{printlabel_pub name="orderdata"}</b></td>
      	<td class="piedefoto"></td>
   	</tr>

   	<tr>
   		<td>{printlabel_pub name="tiorcodigos" blBold="true"}</td>
   		<td>
        {select_row_table_lang table_name="categoria" value="catecodigon" label="catenombres" id="catecodigon" name="catecodigon" form="frmContacto" is_null=true}
      </td>  
  		<td class="piedefoto">{printcoment_pub name="tiorcodigos"}</td>
   	</tr>
	<tr>
      	<td>{printlabel_pub name="ordeobservs" blBold="true"}</td>
      	<td>{textarea id="ordeobservs" name="orden__ordeobservs" cols="60" rows="5" }{/textarea}<b>*</b></td>
      	<td class="piedefoto">{printcoment_pub name="ordeobservs"}</td>
   	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeScCmdAddEntradaWeb" form_name="frmContacto"}
		    	{btn_command type="button" value="Limpiar" id="CmdClean" onClick="this.form.clean.value=1;" name="FeScCmdDefaultCitasWeb" form_name="frmContacto"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="3" class="piedefoto">&nbsp;</td>
	</tr>
	
</table>
{hidden name="action" value="FeScCmdDefaultCitasWeb"}
{hidden name="langcodigos"}
{hidden name="clean"}

{/form}
{putjsacceskey_pub}
{fieldset legend="Resultado"}
   {message id=$cod_message param=$param}
{/fieldset}
{/body}
{droptmpfile table_name=WebUser}
</html>