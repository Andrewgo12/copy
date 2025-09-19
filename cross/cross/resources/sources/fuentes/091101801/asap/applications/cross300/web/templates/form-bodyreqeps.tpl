<html>
{loadlabels table_name=Reqeps&controls[]}
<head>
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles}
</head>
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
{form name="frmReqeps" method="post"}
  <table border="0" align="center" width="100%">
        <tr>
    	<!-- El Nombre de la empresa-->
    	<td class="piedefoto">{infocompany}</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
        <tr><th><div align="center">{printtitle}</div></th></tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
	    <tr>
	    	<td class="piedefoto"><div align="center">
	    		{reqeps}
	    	</div></td>
	    </tr>
  </table>
{/form}
{/body}
{droptmpfile table_name=FichaOrd}
</html>