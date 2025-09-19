<html>
{loadlabels table_name=Permisospersonal&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsLoadSelect.js&files[]=sort.js&files[]=select_list.js}

{/head}
{body 
onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}

<br>
{form name="frmPermisospersonal" method="post"}
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
      		field="schecodigon" label="schenombres" id="schecodigon" is_null=true
      		onchange="LoadSelect('userschema','schecodigon',Array(this),this.form.authusernams);selectnone(this.form.perscodigos);"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=schecodigon}</td>
   </tr>
  	
   <tr>
      <td>{printlabel name=authusernams&blBold=true}</td>
      <td><select name='authusernams' id='authusernams' onchange="LoadSelectPersonal(this.form.schecodigon.value,'authusernams',Array(this),this.form.perscodigos)"><option value="" selected>---</option></SELECT><B>*</B></td>
  	<td class="piedefoto">{printcoment name=authusernams}</td>
   </tr>
   
   <!--
   <tr>
      <td>{printlabel name=authusernams&blBold=true}</td>
      <td>{textfield id="authusernamsdesc" name="authusernamsdesc" size="10" onKeyUp="HideAndSeek(this.value,'authusernamslist','authusernams','frmPermisospersonal','__SEP1__','__SEP2__');"}
      {select_row_table_service service="Profiles" method="getAuth" table_name="auth" name="authusernams"
      		field="indice" label="nombre" id="authusernams" is_null=true filter="authusernamslist" sbSep1="__SEP1__" sbSep2="__SEP2__"
      		onchange="LoadSelect('personal','perscodigos',Array(this),this.form.perscodigos);selectnone(this.form.perscodigos);"}
      		<script>
      			var rcObject = document.frmPermisospersonal.authusernams.options;
      			var nuSizeObject = document.frmPermisospersonal.authusernams.options.length;
      			var sbLista = document.forms['frmPermisospersonal'].elements['authusernamslist'].value;
				var rcLista = sbLista.split('__SEP2__');
				var nuSize = rcLista.length;
      		</script>
  	<td class="piedefoto">{printcoment name=authusernams}</td>
   </tr>
   -->
   
  <tr>
      <td>{printlabel name=perscodigos&blBold=true}</td>
      <td>{select_row_table_service_personal multiple=1 service="Human_resources" method="getActiveEmployee" table_name="personal" name="perscodigos"
      		field="indice" label="nombre" id="perscodigos" is_null=true size="20"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=perscodigos}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdatePermisosPersonal" form_name="frmPermisospersonal" loadFields="schecodigon,authusernams,perscodigos" confirm="46"}
				{btn_command type="button"  value="Eliminar" id="CmdDelete" name="FeGeCmdDeletePermisosPersonal" form_name="frmPermisospersonal" loadFields="schecodigon,authusernams" confirm="47"}
				{btn_clean table_name="PermisosPersonal" form_name="frmPermisospersonal"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="username"}
{/form}
<script>
LoadSelect('userschema','schecodigon',Array(document.frmPermisospersonal.schecodigon),document.frmPermisospersonal.authusernams);
</script>

{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Permisospersonal}
</html>
