<html>
{head}
      <title>Error</title>

{putstyle style=""}
{putjsfiles files[]=jsError.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="window.close();" onunload=""}
<br>
{form name="frmError" method="post"}
<table border="0" align="center" width="60%">
</table>
{hidden name="action" value=""}
{/form}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
</html>