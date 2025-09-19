<html>
{loadlabels table_name=RepoTiemposEjec&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmRepoTiemposEjec" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ordenumeros&blBold=true}</td>
      <td>{textfield id="ordenumeros" name="repotiemposeject__ordenumeros" }<b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordenumeros}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button 
					value="Consultar" 
					id="CmdShow"  
					name="consultar" 
					onClick="if(!this.form.repotiemposeject__ordenumeros.value)location='index.php?action=FeCrCmdDefaultRepoTiemposEjec&cod_message=0'; if(this.form.repotiemposeject__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyRepoTiemposEjec&ordenumeros='+this.form.repotiemposeject__ordenumeros.value+'&vars=ordenumeros');if(this.form.repotiemposeject__ordenumeros.value)this.form.action.value='FeCrCmdDefaultRepoTiemposEjec';"
					}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultRepoTiemposEjec"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=RepoTiemposEjec}

</html>