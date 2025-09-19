<html>
{loadlabels table_name=Formatocarta&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{literal}
<script type="text/javascript">
		var djConfig = {
			isDebug: true,
			dojoRichTextFrameUrl: "../../../src/widget/templates/richtextframe.html" //for xdomain
		};
	</script>
{/literal}
{putjsfiles files[]=jsAccionesNCC.js&files[]=../../../../lib/dojo/dojo.js&files[]=encode.js}

<script language="JavaScript" type="text/javascript">
	dojo.require("dojo.event.*");
	dojo.require("dojo.widget.Editor2");
    dojo.require("dojo.io.*");
	dojo.hostenv.writeIncludes();
</script>

{putstyle style=""}

{/head}
{body onkeydown="return doKeyDown(event)" onLoad="setEditorContent();" }
<br>
{form name="frmFormatocarta" method="post" dojoType="Form" id="frmFormatocarta"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=focacodigos&blBold=true}</td>
      <td>{textfield id="focacodigos" name="formatocarta__focacodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=focacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=focanombres&blBold=true}</td>
      <td>{textfield id="focanombres" name="formatocarta__focanombres" maxlength="100" size="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=focanombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=focaestados}</td>
      <td>{select_estado id="focaestados" name="formatocarta__focaestados" table="formatocarta"}</td>
  	<td class="piedefoto">{printcoment name=focaestados}</td>
   </tr>
   <tr>
      <td colspan="2">{printlabel name=focaplantils&blBold=true}<B>*</B></td>
  	  <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2" class="editor">
		<div class="editor">
		<table>
			<tr>
			<td>
			<div> 
				{select_tags id="tags" name="formatocartaf__tags" onchange="jsPutTagCT()" option="4" is_null="true" id_tag=COMMUNICATION_TAGS widgetId="editdiv" dojoObject="true"}      
			</div>
			</td>
			</tr>
			<tr>
			<td>
			<div>
				{text_editor border="true" id="focaplantils" name="formatocarta__focaplantils" widgetId="editdiv" toolbarTemplatePath="../../applications/general/web/templates/Form_EditorToolbarCross.tpl"}
			</div>
			</td>
			</tr>
		</table>	
		</div>
      </td>
  	  <td class="piedefoto">{printcoment name=focaplantils}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_dojo type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddFormatocarta" connect="actionFormatoCarta" signal="onclick"}
				{btn_dojo type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateFormatocarta" connect="actionFormatoCarta" signal="onclick" confirm="46"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeGeCmdDeleteFormatocarta" form_name="frmFormatocarta" confirm="47"}
				{btn_command type="button" value="Consultar" id="CmdShow" onClick="this.form.focaplantils.value=dojo.widget.manager.getWidgetById('editdiv');" name="FeGeCmdShowListFormatocarta" form_name="frmFormatocarta"}
				{btn_dojo type="button" value="Limpiar" id="CmdClean" name="FeGeCmdDefaultFormatocarta" connect="jsclearForm" signal="onclick"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="focaplantils" value=""}
{max_length}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Formatocarta}
</html>