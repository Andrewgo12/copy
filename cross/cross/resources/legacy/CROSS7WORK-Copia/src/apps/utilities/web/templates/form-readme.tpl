<html>
{head}
       <title>README</title>
       
{putstyle}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)"}
{form name="frmReadme" method="post"}
<table align="center" width="100%" border="0">
<tr><td class="piedefoto">{print_readme}</td></tr>
</table>
  {hidden name="action" value=""}
{/form}
{/body}
</html>