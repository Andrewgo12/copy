<html>
{loadlabels table_name=Organizacion&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=prototype/dist/prototype.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmOrganizacion" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>{textfield id="orgacodigos" name="organizacion__orgacodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=organombres&blBold=true}</td>
      <td>{textfield id="organombres" name="organizacion__organombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=organombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiorcodigos&blBold=true}</td>
      <td>{select_row_table id="tiorcodigos" sqlid="tipoorgani" name="organizacion__tiorcodigos" table_name="tipoorgani" value="tiorcodigos" label="tiornombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacgpads}</td>
      <td>{select_row_father father="orgacgpads" sqlid="organizacion" id="orgacgpads" name="organizacion__orgacgpads" table_name="organizacion" value="orgacodigos" label="organombres" is_null="true"}</td>
  	  <td class="piedefoto">{printcoment name=orgacgpads}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgafechcred}</td>
      <td>{calendar id="orgafechcred" name="organizacion__orgafechcred" form_name ="frmOrganizacion"}</td>
  	<td class="piedefoto">{printcoment name=orgafechcred}</td>
   </tr>
   <tr>
      <td>{printlabel name=esorcodigos&blBold=true}</td>
      <td>{select_row_table id="esorcodigos" name="organizacion__esorcodigos" sqlid="estadoorgani" table_name="estadoorgani" value="esorcodigos" label="esornombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esorcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=grupcodigos&blBold=true}</td>
      <td>{select_row_table id="grupcodigos" name="organizacion__grupcodigos" sqlid="grupo" table_name="grupo" value="grupcodigos" label="grupnombres" is_null="true" sqlid="grupo"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grupcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgatelefo1s}</td>
      <td>{textfield id="orgatelefo1s" name="organizacion__orgatelefo1s" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=orgatelefo1s}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgatelefo2s}</td>
      <td>{textfield id="orgatelefo2s" name="organizacion__orgatelefo2s" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=orgatelefo2s}</td>
   </tr>
   <tr>
      <td>{printlabel name=locacodigos}</td>
      <td> 
      	{textfield id="locacodigos" name="organizacion__locacodigos" onBlur="if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.organizacion_locacodigos_desc)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeHrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=organizacion__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmOrganizacion.locacodigos.value+'&locacodigos_desc='+document.frmOrganizacion.organizacion_locacodigos_desc.value);"
	    }
        {textfield name="organizacion_locacodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment name=locacodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>

	{showPhisicalDep}
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddOrganizacion" form_name="frmOrganizacion"}
				{btn_command_organizacion_update type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateOrganizacion" form_name="frmOrganizacion" loadFields="organizacion__orgacodigos,organizacion__organombres,organizacion__tiorcodigos,organizacion__esorcodigos,organizacion__grupcodigos" confirm="14"}
				{btn_command type="button" value="Mover" id="CmdMove" name="FeHrCmdShowOrgHasOpenCases" form_name="frmOrganizacion"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteOrganizacion" form_name="frmOrganizacion" loadFields="organizacion__orgacodigos,organizacion__organombres,organizacion__tiorcodigos,organizacion__esorcodigos,organizacion__grupcodigos" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListOrganizacion" form_name="frmOrganizacion"}
				{btn_clean table_name="Organizacion" form_name="frmOrganizacion"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message extra=$extra confirm="FeHrCmdMoveDependency"}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Organizacion}
</html>