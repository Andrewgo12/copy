<html>
{head}
       <title> Menu Principal</title>
{putstyle style=""}
{putjsfiles files[]=sniffer.js&files[]=TreeMenu.js&files[]=fncLoadCmd.js}      

{/head}
<body onkeydown="return doKeyDown(event)">
{form name="frmMenu" method="get"}
<table align="left" width="20%" border="1">
{printmenu user="" group=""}
</table>
  {hidden name="action" value=""}
{/form}

</body>
</html>
