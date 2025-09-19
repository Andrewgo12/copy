<html>
{loadlabels table_name=Tblhelp&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=Lst_Help.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTblHelp" method="post"}
{hidden name="action" value=""}
{consult_lsthelp
	form="frmTblHelp"
	submit="FeStCmdLstHelp"
	cache="false"
}
{/form}
{putjsacceskey}
<br>
{/body}
{droptmpfile table_name=tblhelp}
</html>