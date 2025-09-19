<html>
{loadlabels table_name=Personal&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPersonal" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=perscodigos&blBold=true}</td>
      <td>{textfield id="perscodigos" name="personal__perscodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=perscodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=persidentifs&blBold=true}</td>
      <td>{textfield id="persidentifs" name="personal__persidentifs" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=persidentifs}</td>
   </tr>
   <tr>
      <td>{printlabel name=persnombres&blBold=true}</td>
      <td>{textfield id="persnombres" name="personal__persnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=persnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=persapell1s}</td>
      <td>{textfield id="persapell1s" name="personal__persapell1s" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=persapell1s}</td>
   </tr>
   <tr>
      <td>{printlabel name=persapell2s}</td>
      <td>{textfield id="persapell2s" name="personal__persapell2s" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=persapell2s}</td>
   </tr>
   <tr>
      <td>{printlabel name=persusrnams}</td>
      <td>{select_user id="persusrnams" name="personal__persusrnams" value="persusrnams" is_null="true" }</td>
  	<td class="piedefoto">{printcoment name=persusrnams}</td>
   </tr>
   <tr>
      <td>{printlabel name=cargcodigos&blBold=true}</td>
      <td>{select_row_table id="cargcodigos" name="personal__cargcodigos" table_name="cargo" value="cargcodigos" label="cargnombres"  is_null="true" sqlid="cargo"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cargcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=persprofecs}</td>
      <td>{textfield id="persprofecs" name="personal__persprofecs" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=persprofecs}</td>
   </tr>
   <tr>
      <td>{printlabel name=perstelefo1}</td>
      <td>{textfield id="perstelefo1" name="personal__perstelefo1" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=perstelefo1}</td>
   </tr>
   <tr>
      <td>{printlabel name=perstelefo2}</td>
      <td>{textfield id="perstelefo2" name="personal__perstelefo2" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=perstelefo2}</td>
   </tr>
   <tr>
      <td>{printlabel name=locacodigos}</td>
      <td> 
      	{textfield id="locacodigos" name="personal__locacodigos" onBlur="if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.personal_locacodigos_desc)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeHrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=personal__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmPersonal.locacodigos.value+'&locacodigos_desc='+document.frmPersonal.personal_locacodigos_desc.value);"
	    }
        {textfield name="personal_locacodigos_desc"}
     </td>
  	<td class="piedefoto">{printcoment name=locacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=persdireccis}</td>
      <td>{textfield id="persdireccis" name="personal__persdireccis" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=persdireccis}</td>
   </tr>
   <tr>
      <td>{printlabel name=persemails}</td>
      <td>{textfield id="persemails" name="personal__persemails" maxlength="150"}</td>
  	<td class="piedefoto">{printcoment name=persemails}</td>
   </tr>
   <tr>
      <td>{printlabel name=perscontacts}</td>
      <td>{textfield id="perscontacts" name="personal__perscontacts" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=perscontacts}</td>
   </tr>
   <tr>
      <td>{printlabel name=perstelcont}</td>
      <td>{textfield id="perstelcont" name="personal__perstelcont" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=perstelcont}</td>
   </tr>
   <tr>
      <td>{printlabel name=persestadoc}</td>
      <td>{select_estado id="persestadoc" name="personal__persestadoc" table="personal"}</td>
  	<td class="piedefoto">{printcoment name=persestadoc}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddPersonal" form_name="frmPersonal"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdatePersonal" form_name="frmPersonal" loadFields="personal__perscodigos,personal__persidentifs,personal__persnombres,personal__cargcodigos" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeletePersonal" form_name="frmPersonal" loadFields="personal__perscodigos,personal__persidentifs,personal__persnombres,personal__cargcodigos" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListPersonal" form_name="frmPersonal"}
				{btn_clean table_name="Personal" form_name="frmPersonal"}
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
<br>
{/body}
{droptmpfile table_name=Personal}

</html>
