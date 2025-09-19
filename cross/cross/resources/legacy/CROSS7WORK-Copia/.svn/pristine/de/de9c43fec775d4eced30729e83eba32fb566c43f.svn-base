<script language="JavaScript" type="text/javascript">
	function jsrs_getParentWindow() {
		return document.layers?parentLayer:window.parent;
	}
	
	function jsrs_showResponse(context, response) {
		p = jsrs_getParentWindow();
		if (p && window != p) {
			document.write (
      			"<html><head></head><body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" 
    			+ context 
    			+ "');\">jsrsPayload:<br>" 
				+ "<form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\" id=\"jsrs_Payload\">"
				+ response
				+ "</textarea></form></body></html>"
				);
		} else {
			document.write ("sin padre");
		}
	}
	
	function jsrs_showError(context, response, message) {
		p = jsrs_getParentWindow();
		if (p && window != p) {
			document.write (
	  			"<html><head></head><body " 
				+ "onload=\"p=document.layers?parentLayer:window.parent;p.jsrsError('" 
				+ context
				+ "','" + response + "');\">"
				+ message + "</body></html>" 
			);
		} else {
			document.write ("sin padre");
		}
	}
	
</script>
<?php

class JsrsServer {

	function dispatch($validFuncs) {
		 $func = JsrsServer::_buildFunc($validFuncs);
  
  		if ($func != ""){
    		$retval;
    
    		eval("\$retval =  " . $func . ";");
    
    		if (is_array($retval)){
    			JsrsServer::sendResponse(JsrsServer::encodeArray($retval));
    		} else if (strlen($retval)>0){
      			JsrsServer::sendResponse($retval."");
	    	} else {
      			JsrsServer::sendResponse("");
    		} 
  		} else {
    		JsrsServer::sendErrorResponse("function builds as empty string");
  		}
	}

	function sendResponse($payload) {
		global $C;
	
		if(!isset($C)) 
			$C = (isset($_REQUEST['C']) ? $_REQUEST['C'] : "");

		print (
			"<script>jsrs_showResponse('"
			. $C . "','" . addcslashes($payload,"\0..\37!@\@\177..\377") . "');"
			. "</script>"
			);

  		/* print (
      		"<html><head></head><body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" 
    		. $C . "');\">jsrsPayload:<br>" 
			. "<form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\" id=\"jsrs_Payload\">"
			. JsrsServer::escapeString($payload) . "</textarea></form></body></html>");
		*/ 
    	exit();
	}		
	
	function sendErrorResponse($str){
		global $C;
		if(!isset($C)) 
			$C = (isset($_REQUEST['C']) ? $_REQUEST['C'] : "");
  
  		// escape quotes
  		$cleanStr = preg_replace("#\'#","\\'",$str);
  
  		// !!!! --- Warning -- !!!
  		$cleanStr = "jsrsError: " . preg_replace("#\"#", "\\\"", $cleanStr); 

		print (
			"<script>jsrs_showError('"
			. $C . "','" . urlencode($str) . "','" . $cleanStr . "');"
			. "</script>"
			);


/*
  		print (
  			"<html><head></head><body " 
			. "onload=\"p=document.layers?parentLayer:window.parent;p.jsrsError('" . $C . "','" . urlencode($str) . "');\">"
			. $cleanStr . "</body></html>" );
*/
  		exit();
	}
		
	function escapeString($str){
		// escape ampersands so special chars aren't interpreted
  		$tmp = preg_replace( "#&#", "&amp;", $str );
  		// escape slashes  with whacks so end tags don't interfere with return html
  		return preg_replace( "#\/#" , "\\/",$tmp); 
	}
	
	function encodeArray($a, $delim = "~" ){
  	
  		// user function to flatten 1-dim array to string for return to client
		return implode($a,$d);		  
	}
	
	
	
	function evalEscape($thing) {
 		$tmp = preg_replace('#'.$thing.'#',"\r\n","\n");
		return $tmp;
	}

	function _buildFunc ($validFuncs) {
	
		echo "<hr>Request :";
		var_dump($_REQUEST);
	
		echo "<hr>Valid Functions :";
		var_dump($validFuncs);
	
	 	global $F;
 		//if(!isset($F)) 
 			$F = (isset($_REQUEST['F']) ? $_REQUEST['F'] : "");
 		
 		$func = ""; 
		if ($F != "") {
			$func = $F;

			echo "<hr>Current Function :";
			var_dump($func);
  
	  		// make sure it's in the dispatch list
  			if (strpos(strtoupper($validFuncs),strtoupper($func))===false)
     			JsrsServer::sendErrorResponse($func . " is not a valid function" );
   
   			$func .= "(";
   			$i = 0;
    
   			//--- To optimize ! --- 
   			eval("global \$P$i;");
   			eval("if(!isset(\$P$i)) \$P$i = (isset(\$_REQUEST['P$i']) ? \$_REQUEST['P$i']:'');");
   			$Ptmp = "P". $i;
     
   			while ($$Ptmp!="") {
    			$parm = $$Ptmp;
    			$parm = substr($parm,1,strlen($parm)-2);
    			$func .= "\"" . $parm . "\",";
    			$i++;
    			eval("global \$P$i;");
    			eval("if(!isset(\$P$i)) \$P$i = (isset(\$_REQUEST['P$i']) ? \$_REQUEST['P$i']:'');");
    			$Ptmp = "P". $i;
   			}
   
   			if (substr($func,strlen($func)-1,1)==",")  
    			$func = substr($func,0,strlen($func)-1);
		
			$func .= ")";
  		} 

		echo "<hr>Ejecute String : ";
		var_dump($func);
		echo "<hr>";
 
 		return $func;
	}

}

?>
