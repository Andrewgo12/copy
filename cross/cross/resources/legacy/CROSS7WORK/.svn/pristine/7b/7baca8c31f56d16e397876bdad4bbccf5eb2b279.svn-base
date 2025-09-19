<html>
{loadlabels table_name=Permisosentes&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsLoadSelect.js&files[]=sort.js}

{/head}
{body 
onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}

<br>
{form name="frmPermisosentes" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=schecodigon&blBold=true}</td>
      <td>{select_row_table_service service="Profiles" method="getSessionSchema" table_name="schema" name="schecodigon"
      		field="schecodigon" label="schenombres" id="schecodigon" is_null=false
      		onchange="LoadSelect('userschema','schecodigon',Array(this),this.form.authusernams);selectnone(this.form.orgacodigos);"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=schecodigon}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=authusernams&blBold=true}</td>
      <td><select name='authusernams' id='authusernams' onchange="LoadSelectEntes(this.form.schecodigon.value,'authusernams',Array(this),this.form.orgacodigos)"><option value="" selected>---</option></SELECT><B>*</B></td>
  	<td class="piedefoto">{printcoment name=authusernams}</td>
   </tr>
   
  <tr>
      <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>{select_multiple service="Human_resources" table_name="organizacion" 
      		field="orgacodigos" label="organombres" id="orgacodigos" name="orgacodigos"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdatePermisosEntes" form_name="frmPermisosentes" loadFields="schecodigon,authusernams,orgacodigos" confirm="46"}
				{btn_command type="button"  value="Eliminar" id="CmdDelete" name="FeGeCmdDeletePermisosEntes" form_name="frmPermisosentes" loadFields="schecodigon,authusernams" confirm="47"}
				{btn_clean table_name="PermisosEntes" form_name="frmPermisosentes"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="username"}
{/form}
<script>
LoadSelect('userschema','schecodigon',Array(document.frmPermisosentes.schecodigon),document.frmPermisosentes.authusernams);
</script>

{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Permisosentes}
</html>
