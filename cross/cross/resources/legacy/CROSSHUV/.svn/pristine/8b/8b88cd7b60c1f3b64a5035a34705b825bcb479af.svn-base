<html>
{loadlabels table_name=Databases&controls[]=CmdBackup&controls[]=CmdMaintenance}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmDatabases" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=backup}</td>
      <td colspan='2'>
        <a href="#" onclick="fncopenwindows('FeGeCmdBackup','');" title='{printcoment name=backup}'><image src='web/images/database_002.gif' align='middle' border='0'/></a>
       </td> 
   </tr>
   <tr>
      <td>{printlabel name=vacuum}</td>
      <td colspan='2'>
        <a href="index.php?action=FeGeCmdMaintenance" title='{printcoment name=vacuum}'><image src='web/images/configuracion.gif' align='middle' border='0'/></a>
       </td> 
   </tr>
</table>
{literal}
<script language="javascript">
    function activeButton(){
        document.frmDatabases.FeGeCmdBackup.disabled=false;
        document.frmDatabases.FeGeCmdMaintenance.disabled=false;
    }
</script>
{/literal}
{hidden name="action" value=""}
{hidden name="flag" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Databases}
</html> 