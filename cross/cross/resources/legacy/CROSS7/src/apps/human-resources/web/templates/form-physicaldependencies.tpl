<html>
{loadlabels table_name=Physicaldependencies&controls[]=CmdAdd}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=select_list.js&files[]=fncWindowOpen.js}

{/head}
{body 
onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}

<br>
{form name="frmPhysicaldependencies" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
   	  <td>{printlabel name=orgacodigos&blBold=true}</td>
  	<td> 
      	{textfield id="orgacodigos" name="orgacodigos" onBlur="if(this.value=='')document.frmPhysicaldependencies.organombres.value=''; else jsGetDescription('index.php','FeHrCmdGetValues','frmPhysicaldependencies','orgacodigos','organombres','&sbSqlId=organizacion&sbFunction=autoReference&rcParams[orgacodigos]='+this.value,'selTipoCampos','&sbFunction=selectedValues&rcParams[orgacodigos]='+this.value)"}
	    {href 
	      		label="<img src='web/images/menu.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeHrCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmPhysicaldependencies.orgacodigos.value+'&orgacodigos_desc='+document.frmPhysicaldependencies.organombres.value);"
	    }
        {textfield name="organombres" id="organombres"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	<td colspan="2" class='piedefoto'>{dependencies_list}</td>
	<td class="piedefoto"></td>
	</tr>   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddPhysicaldependencies" form_name="frmPhysicaldependencies" onClick="extractselect(this.form.selTipoCampos,this.form.selected_opt,this.form,this.form.action,'FeHrCmdAddPhysicaldependencies');"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="selected_opt" value=""}
{hidden name="action"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Physicaldependencies}
</html>