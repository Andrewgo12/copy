<html>
{loadlabels table_name=Saldobodega&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmSaldobodega" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=bodecodigos}</td>
      <td>{select_row_table id="bodecodigos" name="saldobodega__bodecodigos" table_name="bodega" value="bodecodigos" label="bodenombres" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=resources}</td>
      <td>
	  {textfield id="resources" name="saldobodega__resources" onBlur="if(this.value)autoReference('recurso','recucodigos',Array(this),this.form.resources_desc)"}
      {href 
      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=recurso&sqlid=recurso&return_obj=saldobodega__resources&return_key=recucodigos');"
      }
      {textfield id="resources_desc" name="saldobodega__resources_desc" }</td>
  	<td class="piedefoto">{printcoment name=resources}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiporecurso}</td>
      <td>{select_row_table id="tiporecurso" name="saldobodega__tirecodigos" table_name="tiporecurso" value="tirecodigos" label="tirenombres"}</td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=numrows}</td>
      <td>{textfield id="numrows" name="saldobodega__numrows" maxlength="4" size="5" typeData="int"}</td>
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
					name="FeStCmdDefaultSaldobodega" 
					form_name="frmSaldobodega"
					onClick="fncopenwindows('FeStCmdDefaultFichas','topFrame=FeStCmdDefaultHeadSaldobodega&mainFrame=FeStCmdDefaultBodySaldobodega&bodecodigos='+this.form.saldobodega__bodecodigos.value+'&tirecodigos='+this.form.saldobodega__tirecodigos.value+'&recucodigos='+this.form.saldobodega__resources.value+'&numrows='+this.form.saldobodega__numrows.value+'&vars=bodecodigos,tirecodigos,recucodigos,numrows');"
					}
				{btn_clean table_name="Saldobodega" form_name="frmSaldobodega"	}
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
{droptmpfile table_name=Saldobodega}

</html>