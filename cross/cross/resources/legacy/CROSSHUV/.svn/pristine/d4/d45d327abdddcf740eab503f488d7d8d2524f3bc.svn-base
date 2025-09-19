<html>
{loadlabels table_name=Comunicacioncreate&controls[]=CmdAdd&controls[]=CmdClean}
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
{putjsfiles files[]=../../../../lib/dojo/dojo.js&files[]=jsAccionesCT.js&files[]=encode.js}

<script language="JavaScript" type="text/javascript">
	dojo.require("dojo.event.*");
	dojo.require("dojo.widget.Editor2");
    dojo.require("dojo.io.*");
	dojo.hostenv.writeIncludes();
</script>
<script language="JavaScript" type="text/javascript">
	dojo.addOnLoad(setEditorContentValue);
</script>
{putstyle style=""}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
{form name="frmComunicacionCreate" enctype="multipart/form-data" method="post" dojoType="Form" id="frmComunicacionCreate"}
<table border="0" align="center" width="60%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td>{printlabel name=ordenumeros}</td>
      <td>{textfield id="ordenumeros" name="comunicacion__ordenumerosh" size="30" maxlength="60" readonly="true"}</td>
  	<td class="piedefoto">{printcoment name=ordenumeros}</td>
   </tr>
   <tr>
      <td>{printlabel name=comuasuntos&blBold=true}</td>
      <td>{textfield id="comuasuntos" name="comunicacion__comuasuntos" size="60" maxlength="60"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=comuasuntos}</td>
   <!--</tr>
      <td>{printlabel name=comutextos}</td>
      <td>{textarea id="comutextos" name="comunicacion__comutextos" cols="80" rows="17"  }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=comutextos}</td>
   </tr>-->
   <tr>
      <td colspan="2">{printlabel name=comutextos&blBold=true}<B>*</B></td>
  	  <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2" class="editor">
		<div class="editor">
		<table>
			<tr>
			<td>
			<div>
				{text_editor border="true" id="comutextos" name="comunicacion__comutextos" widgetId="editdiv" toolbarTemplatePath="../../applications/general/web/templates/Form_EditorToolbarCross.tpl"}
			</div>
			</td>
			</tr>
		</table>	
		</div>
      </td>
  	  <td class="piedefoto">{printcoment name=comutextos}</td>
   </tr>
   <tr>
		<td colspan="2">
			<div align="center">
				{btn_dojo type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddComunicacion" connect="actionCommunication" signal="onclick"}
				{btn_dojo type="button" value="Limpiar" id="CmdClean" name="FeGeCmdCentroComunicacionCreate" connect="jsclearCommunicationForm" signal="onclick"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="comunicacion__ordenumeros" }
{hidden name="comunicacion__focacodigos" }
{max_length}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Comunicacioncreate}
</html>