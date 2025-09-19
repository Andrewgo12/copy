<HTML>
<HEAD>
	<title>CROSS</title>
</HEAD>
<BODY>
<FORM name="form1">
 <script LANGUAGE="JavaScript">
 <!--
    function clickIE4(){
        if (event.button==2){
            alert(message);
            return false;
        }
    }
    
    function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
            }
        }
    }
    
    if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
    }
    else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
    }
    document.oncontextmenu=new Function("return false");
    
	var opciones="top=100,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=800,height=600";
	var url = "ASAP/applications/profiles/index.php";
	win = window.open(url,"CROSS",opciones);
    window.opener=null;
    window.close();
 //-->
 </script>
</FORM>
</BODY>
</HTML>