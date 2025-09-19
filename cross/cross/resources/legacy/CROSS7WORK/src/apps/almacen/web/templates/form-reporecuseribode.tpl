<html>
{loadlabels table_name=Reporecuseribode&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=overlib_mini.js&files[]=Calendar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmRecuseribode" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=resources}</td>
      <td>
	  {textfield id="resources" name="recuseribode__resources" onBlur="if(this.value)autoReference('recursoserie','recucodigos',Array(this),this.form.resources_desc)"}
      {href 
      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=recurso&sqlid=recursoserie&return_obj=recuseribode__resources&return_key=recucodigos');"
      }
      {textfield id="resources_desc" name="recuseribode__resources_desc" }</td>
  	<td class="piedefoto">{printcoment name=resources}</td>
   </tr>
   <tr>
      <td>{printlabel name=serial}</td>
      <td>{textfield id="serial" name="recuseribode__serial"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=serial}</td>
   </tr>
   <tr>
      <td>{printlabel name=numrows}</td>
      <td>{textfield id="numrows" name="recuseribode__numrows" maxlength="4" size="5" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=numrows}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command 
					type="button" 
					value="Consultar" 
					id="CmdShow" 
					name="FeStCmdDefaultReporecuseribode" 
					form_name="frmRecuseribode"
					onClick="fncopenwindows('FeStCmdDefaultFichas','topFrame=FeStCmdDefaultHeadReporecuseribode&mainFrame=FeStCmdDefaultBodyReporecuseribode&recucodigos='+this.form.recuseribode__resources.value+'&serial='+this.form.recuseribode__serial.value+'&numrows='+this.form.recuseribode__numrows.value+'&vars=recucodigos,serial,numrows');"
					}
				{btn_clean table_name="Reporecuseribode" form_name="frmRecuseribode"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Reporecuseribode}

</html>