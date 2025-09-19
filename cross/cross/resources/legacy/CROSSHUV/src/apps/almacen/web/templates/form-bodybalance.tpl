<html>
{loadlabels table_name=Balance&controls[]}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}
{form name="frmReporecuseribode" method="post"}
  <table border="0" align="center" width="100%">
	    <tr>
	    	<td class="piedefoto"><div align="center">
	    		{repo_balance}
	    	</div></td>
	    </tr>
  </table>
{/form}
{/body}
{droptmpfile table_name=Balance}
</html>