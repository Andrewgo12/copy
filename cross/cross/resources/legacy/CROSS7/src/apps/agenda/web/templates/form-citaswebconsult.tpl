<html>
{loadlabels_pub table_name="citaswebconsult" controls="CmdShow,CmdClean"}
{head}
<title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=encode.js&files[]=SelectControl.js}

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
   	<tr>
      	<td colspan="2"><b>{printlabel_pub name="denunciante"}</b></td>
      	<td class="piedefoto"></td>
   	</tr>

	<tr>
      <td>{printlabel_pub name="contcodigon" blBold="true"}</td>
      <td>
        {dataselectdojo htmlid="contcodigon" name="contcodigon" sqlid="contacto_ident" value="contcodigon" label="contindentis" forceautoreference="true"}
     <b>*</b>
     </td>
  	<td class="piedefoto">{printcoment_pub name="contcodigon"}</td>
   </tr>
	<tr>
      <td>{printlabel_pub name="preecodigon"}</td>
      <td>{textfield id="preecodigon" name="preecodigon" size=10 maxlength="7"}</td>
  	<td class="piedefoto">{printcoment_pub name="preecodigon"}</td>
   </tr>
   
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Consultar" id="CmdShow" onClick="this.form.consulta.value=1;this.form.action.value='FeScCmdDefaultCitasWebConsult';" name="FeScCmdDefaultCitasWebConsult" form_name="frmContacto"}
		    	{btn_command type="button" value="Limpiar" id="CmdClean" onClick="this.form.consulta.value=0;this.form.clean.value=1;" name="FeScCmdDefaultCitasWebConsult" form_name="frmContacto"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="3" class="piedefoto">&nbsp;</td>
	</tr>
	
	{viewConsultaCitas}
	
</table>
{hidden name="action" value="FeScCmdDefaultCitasWebConsult"}
{hidden name="clean"}
{hidden name="consulta"}
{hidden name="langcodigos"}

{/form}
{putjsacceskey_pub}
{fieldset legend="Resultado"}
   {message id=$cod_message param=$param}
{/fieldset}
{/body}
{droptmpfile table_name=WebUser}
</html>