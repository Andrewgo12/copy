
<?php 
/*** @Copyright 2004
*
*/
function smarty_function_Commit($params, & $smarty)
{
	extract($params);
	extract($_REQUEST);
	$rcUser = Application :: getUserParam();
	if(!is_array($rcUser))
	   return;
    if(!isset($name))
        return;
    if(!$$name)
        return;
        
    if(!$file_name)
        $file_name = "tipopropiedad";
        
        
	include ($rcUser["lang"]."/".$rcUser["lang"].".".$file_name.".php");
	if($commit)
	{
	    if(substr_count($commit,$rclabels[$$name]["label"]) == 0)
	       $commit .=' > '.$rclabels[$$name]["label"];
	}
	else 
	   $commit = $rclabels[$$name]["label"];
	
	$_REQUEST["commit"] = $commit;
	
	$sbHtml = $commit;
	return $sbHtml;
	
}
?>

