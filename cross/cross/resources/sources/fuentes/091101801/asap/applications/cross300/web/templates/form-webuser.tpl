<html>
{loadlabels_pub table_name="WebUser" controls="CmdAdd,CmdClean"}
{head}
      <title>{printtitle_pub}</title>
{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsdrawDynamicColumns.js&files[]=encode.js&files[]=jsDrawdiv.js&files[]=prototype/dist/prototype.js&files[]=jsOrden.js&files[]=SelectControl.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();drawDynamicColumns('dynamic_columns');" onunload=""}
<br>
{form name="frmOrden" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="70%">

   
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
		<tr><td class="piedefoto" colspan="3"><div align="justify">
		{help_context_pub}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle_pub}</div></th></tr>
   <tr>
      <td width='25%'>{printlabel_pub name="tiorcodigos" blBold="true"}</td>
      <td width='60%'>
      {select_row_table_lang id="tiorcodigos" name="ordenempresa__tiorcodigos" sqlid="tipoorden_web" table_name="tipoorden" value="tiorcodigos" label="tiornombres" is_null="true" 
      onchange="if(this.value!='')LoadSelect_lang('tipoorden_evento','tiorcodigos',Array(this),this.form.ordenempresa__evencodigos,'evento_evencodigos_evennombres','ordenempresa__evencodigos,ordenempresa__causcodigos');
      if(this.value!='')LoadDescTipoorden(this.value);
      drawDynamicColumns('dynamic_columns');"}<b>*</b>
      <br>
      <div id="tiordescrips"></div>
      </td>
  	<td class="piedefoto" width='15%'>{printcoment_pub name="tiorcodigos"}</td>
   </tr>
   <tr>
   	  <td>{printlabel_pub name="evencodigos" blBold="true"}</td>
   	  	<td>
   	  	{select_son name="ordenempresa__evencodigos"
		     table_hijo="evento" 
		     id_hijo="evencodigos"
		     label_hijo="evennombres"
		     foreign_name=""
		     select_papa="ordenempresa__tiorcodigos"
		     sqlid="tipoorden_evento"
		     onchange="if(this.value)LoadSelect_lang('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,this.form.ordenempresa__tiorcodigos),this.form.ordenempresa__causcodigos,'causa_causcodigos_causnombres');
		     drawDynamicColumns('dynamic_columns');"}<b>*</b>
   	  	</td>
  	<td class="piedefoto">{printcoment_pub name="evencodigos"}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="causcodigos"}</td>
      <td>
      {select_son name="ordenempresa__causcodigos"
		     table_hijo="causa" 
		     id_hijo="causcodigos"
		     label_hijo="causnombres"
		     foreign_name=""
		     select_papa="ordenempresa__tiorcodigos,ordenempresa__evencodigos"
		     sqlid="tipoorden_evento_causa"
		     onchange="drawDynamicColumns('dynamic_columns');"} 
      </td>
  	<td class="piedefoto">{printcoment_pub name="causcodigos"}</td>
   </tr>
   <tr>
      <td>{printlabel_pub name="ordeobservs" blBold="true"}</td>
      <td>{textarea_ext id="ordeobservs" name="orden__ordeobservs" cols="100" rows="10" }{/textarea_ext}<b>*</b></td>
  	<td class="piedefoto">{printcoment_pub name="ordeobservs"}</td>
   </tr>
      <tr>
      <td colspan="2"><br></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td>{printlabel_pub name="ordesitiejes" blBold="true"}</td>
      <td>
      	{textfield id="ordesitiejes" name="orden__ordesitiejes" onBlur="if(this.value)autoReference('dep_fisica','orgacodigos',Array(this),this.form.orden_ordesitiejes_desc)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeCrCmdTreeHelp','table=organizacion&sqlid=dep_fisica&return_obj=orden__ordesitiejes&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&param=geografia&value='+document.frmOrden.orden__ordesitiejes.value+'&visibility=ancestry:1');"
	      		title="Desplegar"
	    }
      {textfield name="orden_ordesitiejes_desc"}<B>*</B>
      </td>
  	<td class="piedefoto">{printcoment_pub name="ordesitiejes"}</td>
   </tr>
   <tr>
      <td colspan="2"><br></td>
      <td class="piedefoto">{printcoment_pub name="denunciante"}</td>
   </tr>
   <tr>
      <td colspan="2">
      	{printlabel_pub name="question"}&nbsp;
      	{printlabel_pub name="yes"}&nbsp;<input type="radio" id="radio_paciente" name="answer" value="1" onClick="setDenunciante('1')">&nbsp;
      	{printlabel_pub name="no"}&nbsp;<input type="radio" id="radio_denunciante" name="answer" value="2" onClick="setDenunciante('2')">&nbsp;
      	{printlabel_pub name="anonimo"}&nbsp;<input type="radio" id="radio_anonimo" name="answer" value="0" onClick="setDenunciante('0')">
      </td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
    </tr>
    <!-- Paciente -->
    <tr>
    <td colspan="2">
    
	<div id="paciente" style="visibility:hidden; display:none ">
		<table border="0" align="center" width="100%">
			<tr>
				<td colspan="2"><strong>{printlabel_pub name="paciente_info"}</strong></td>
			</tr>
			<tr>
				<td>{printlabel_pub name="paciente" blBold="true"}</td>
				<td> 
					{dataselectdojo htmlid="paciindentis" name="ordenempresa__paciindentis" sqlid="paciente_ident" value="paciindentis_c" label="paciindentis" forceautoreference="true"} 
				    {href 
				      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
				      		onclick="javascript:OpenWindows('../customers/index.php?action=FeCuCmdDefaultPaciente&web=1','');"
				    }
				</td>
			</tr>
			<tr>
				<td>{printlabel_pub name="sesocodigos" blBold="true"}</td>
				<td>
				{select_row_table name="ordenempresa__sesocodigos" id="sesocodigos" label="sesonombres" sqlid="segurisocial" is_null="true" value="sesocodigos"}<B>*</B>
				</td>
			</tr>
			<tr>
				<td>{printlabel_pub name="couscodigos" blBold="true"}</td>
				<td>
				{select_row_table name="ordenempresa__couscodigos" id="couscodigos" label="cousnombres" sqlid="condiusuario" is_null="true" value="couscodigos"}<B>*</B>
				</td>
			</tr>
			<tr>
				<td>{printlabel_pub name="ipscodigos" blBold="true"}</td>
				<td>
				{select_row_table name="ordenempresa__ipsecodigos" id="ipsecodigos" label="ipsenombres" sqlid="ips" is_null="true" value="ipsecodigos"}<B>*</B>
				</td>
			</tr>
			<tr>
		      <td>{printlabel_pub name="contidentis_p"}</td>
		      <td>
		      	{dataselectdojo htmlid="contidentis_p" name="ordenempresa__contidentis_p" sqlid="contacto_ident" value="contcodigon" label="contindentis" forceautoreference="true"} 
			    {href 
			      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
			      		onclick="javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"
			    }
		     </td>
		   </tr>
		</table>
	</div>
    </td>
    <td class="piedefoto"></td>
    </tr>
    <!-- Fin paciente -->
     <!-- Denunciante -->
    <tr>
    <td colspan="2">
   
	<div id="denunciante"  style="visibility:hidden; display:none ">
		<table border="0" align="center" width="100%">
			<tr>
				<td colspan="2"><strong>{printlabel_pub name="denunciante_info"}</strong></td>
			</tr>
		<tr>
	      <td>{printlabel_pub name="contidentis" blBold="true"}</td>
	      <td>
	      	{dataselectdojo htmlid="contidentis" name="ordenempresa__contidentis" sqlid="contacto_ident" value="contcodigon" label="contindentis" forceautoreference="true"} 
		    {href 
		      		label="<img src='web/images/crear.gif' border='0' align='absmiddle'></img>"
		      		onclick="javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"
		    }
	     </td>
	   </tr>
		</table>
	</div>
    </td>
    <td class="piedefoto"></td>
    </tr>
    <!-- Fin Denunciante -->
		</table>
	</td>
</tr>
<tr>
	<td class="piedefoto">
		{div id="dynamic_columns" align="justify"}
		<table border="0" align="center" width="100%">
		<tr><td width='25%'>&nbsp;</td><td width='60%'>&nbsp;</td><td width='15%' class="piedefoto"></td></tr>
		</table>
   		{/div}
	</td>
</tr>
<tr>
	<td class="piedefoto">
	<table border="0" align="center" width="100%">
		<tr><td colspan="2"><div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddOrdenWeb" form_name="frmOrden"}
				{btn_clean table_name="WebUser" form_name="frmOrden"}
	   </div></td><td width='15%' class="piedefoto"></td></tr>
		<tr><td colspan="2" class="piedefoto">{register_attachment_web form="frmOrden"}</td><td class="piedefoto"></td></tr>
		</table>
	</td>
</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultWebUser"}
{hidden name="deleteattachment" value=""}
{hidden name="consult"}
{hidden name="ordenempresa__orgacodigos"}
{hidden name="ordenempresa__merecodigos"}
{hidden name="orden__ordefecregd"}
{hidden name="ordenempresa__oremradicas"}
{hidden name="ordenempresa__infrcodigos"}
{hidden name="langcodigos"}
{hidden name="customer_type" id="customer_type"}
<script language="javascript">
	setDenunciante('{php}echo $_REQUEST['customer_type'];{/php}');
	activeRadio('{php}echo $_REQUEST['customer_type'];{/php}');
</script>
{/form}
{putjsacceskey_pub}
{fieldset legend="Resultado"}
   {message_orden id=$cod_message param=$param signal=$signal error_field=$error_field label_file="fichaord"}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=WebUser}
</html>