<!--
<html>
{head}
<title>CROSS</title>
<meta http-equiv="Content-Type" content="text/html;" content="text/html; charset=ISO-8859-1">
{putstyle style=""}
{/head}
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onkeydown="return doKeyDown(event);" onunload="windowclose();">
{form name="frmHead" method="post"}
<p>&nbsp;</p>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <th><div align="right">
      		<img src="web/images/salir.gif" width="40" height="40" border="0" align="middle" onclick="document.frmHead.action.value='FePrCmdExit';frmHead.submit();"></div></th>
    <tr>
      <th><div align="left">Profiles Manager</div>
      </th>
  </tr>
</table>
{hidden name="action" value=""}
{/form}
</body>
</html>
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
{head}
<title></title>


{putstyle style="head.css"}
{putjsfiles files[]=cmdExit.js&files[]=headControl.js}

{/head}
<body onLoad="MM_preloadImages('web/images/contacto.gif','web/images/ayuda.gif','web/images/salir.gif')">
{form name="frmHead" method="post"}
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  width="186"><img src="web/images/i_cabe01.gif" width="186" height="95"></td>
    <td  width="487" background="web/images/i_expam1.gif"><img src="web/images/i_cabe02.gif" width="487" height="95"></td>
    <td class="single1" background="web/images/i_cabexpan.jpg">&nbsp;</td>
    <td  width="239"><img src="web/images/i_cabelogo.jpg" width="239" height="94"></td>
  </tr>
</table>
<table width="100%" height="40"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="single" background="web/images/i_downexpan.jpg">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  >&nbsp;</td>
            <td  width="45"><a href="mailto:soporte_fullengine@hotmail.com" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','web/images/contacto.gif',1)"><img src="web/images/contacto.gif" name="Image13" width="40" height="40" border="0" title="Contacto"></a></td>
            <td  width="45"><a href="#" onClick="{geturlhelp}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','web/images/ayuda.gif',1)"><img src="web/images/ayuda.gif" name="Image14" width="40" height="40" border="0" title="Ayuda"></a></td>
            <td  width="45"><a href="javascript:cmdExit()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','web/images/salir.gif',1)"><img src="web/images/salir.gif" name="Image15" width="40" height="40" border="0" title="Salir"></a></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
{hidden name="action" value="FePrCmdDefaultHead"}
{/form}
</body>
</html>