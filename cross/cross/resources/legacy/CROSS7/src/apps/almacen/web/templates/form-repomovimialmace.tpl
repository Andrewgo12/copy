<html>
{loadlabels table_name=Repomovimialmace&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=overlib_mini.js&files[]=Calendar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
{form name="frmMovimialmace" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=moalnumedocs}</td>
      <td>{textfield id="moalnumedocs" name="movimialmace__moalnumedocs"}</td>
  	<td class="piedefoto">{printcoment name=moalnumedocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodecodigos}</td>
      <td>{select_row_table id="bodecodigos" name="movimialmace__bodecodigos" table_name="bodega" value="bodecodigos" label="bodenombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=resources}</td>
      <td>
	  {textfield id="resources" name="movimialmace__resources" onBlur="if(this.value)autoReference('recurso','recucodigos',Array(this),this.form.resources_desc)"}
      {href 
      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=recurso&sqlid=recurso&return_obj=movimialmace__resources&return_key=recucodigos');"
      }
      {textfield id="resources_desc" name="movimialmace__resources_desc" }</td>
  	<td class="piedefoto">{printcoment name=resources}</td>
   </tr>
   <tr>
      <td>{printlabel name=moalfechmovd1}</td>
      <td>{calendar id="moalfechmovd1" name="movimialmace__moalfechmovd1" form_name ="frmMovimialmace" icon="web/images/calendar.gif"}</td>
  	<td class="piedefoto">{printcoment name=moalfechmovd1}</td>
   </tr>
   <tr>
      <td>{printlabel name=moalfechmovd2}</td>
      <td>{calendar id="moalfechmovd2" name="movimialmace__moalfechmovd2" form_name ="frmMovimialmace" icon="web/images/calendar.gif"}</td>
  	<td class="piedefoto">{printcoment name=moalfechmovd2}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=numrows}</td>
      <td>{textfield id="numrows" name="movimialmace__numrows" maxlength="4" size="5" typeData="int"}</td>
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
					name="FeStCmdDefaultRepomovimialmace" 
					form_name="frmMovimialmace"
					onClick="fncopenwindows('FeStCmdDefaultFichas','topFrame=FeStCmdDefaultHeadRepomovimialmace&mainFrame=FeStCmdDefaultBodyRepomovimialmace&moalnumedocs='+this.form.movimialmace__moalnumedocs.value+'&bodecodigos='+this.form.movimialmace__bodecodigos.value+'&recucodigos='+this.form.movimialmace__resources.value+'&moalfechmovd1='+this.form.movimialmace__moalfechmovd1.value+'&moalfechmovd2='+this.form.movimialmace__moalfechmovd2.value+'&numrows='+this.form.movimialmace__numrows.value+'&vars=moalnumedocs,bodecodigos,recucodigos,moalfechmovd1,moalfechmovd2,numrows');"
					}
				{btn_clean table_name="Repomovimialmace" form_name="frmMovimialmace"	}
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
{droptmpfile table_name=Repomovimialmace}

</html>