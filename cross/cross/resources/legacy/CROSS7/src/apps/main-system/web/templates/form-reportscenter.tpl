<html>
{loadlabels table_name=Reportscenter&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=select_list.js&files[]=jsreportscenter.js&files[]=fncWindowOpen.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmReportscenter" method="post"}
   {hidden name="hidden_14"}
   <!--  {hidden name="hidden_15"} -->
   <!--  {hidden name="hidden_16"}-->
   {hidden name="hidden_17"}
   {hidden name="hidden_18"}
   <!--{hidden name="hidden_19"}-->
   {hidden name="hidden_20"}
   {hidden name="hidden_21"}
   {hidden name="action" value=""}
{/form}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_14}</b></td>
      <td width='10%' align="center">
      	{href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_14', 'FeCrCmdShowHtmlFrequencyParams', '14', '14', 'hidden_14');"
	    }
       </td>
   </tr>
   <tr>
   <td colspan='3'class='piedefoto'>
   {div id="div_14" align="justify"}{/div}
   </td>
   </tr>  
	</table>
	</td>
	</tr>
	
	<!--  <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_15}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_15', 'FeCrCmdShowHtmlMunicipioParams', '15', '15', 'hidden_15');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_15" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr> -->
	
   <!--  <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
   <tr>
      <td colspan='2'><b>{printlabel name=text_16}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_16', 'FeCrCmdShowHtmlParams', '16', '16', 'hidden_16');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_16" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr> -->
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_17}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_17', 'FeCrCmdShowHtmlActiviTareaParams', '17', '17', 'hidden_17');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_17" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_18}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_18', 'FeCrCmdShowHtmlParams', '18', '18', 'hidden_18');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_18" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
	<!-- <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_19}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_19', 'FeCrCmdShowHtmlParams', '19', '19', 'hidden_19');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_19" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr>-->


	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_20}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_20', 'FeCrCmdShowLogHtmlParams', '20', '20', 'hidden_20');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_20" align="justify"}{/div}
   </td>
   </tr>
   <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b>{printlabel name=text_21}</b></td>
      <td width='10%' align="center">
        {href 
	      		label="<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>"
	      		href="javascript:jsShowHtml('index.php', 'div_21', 'FeCrCmdShowHtmlLlaveParams', '21', '21', 'hidden_21');"
	    }
       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   {div id="div_21" align="justify"}{/div}
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
</table>
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Reportscenter}
</html> 