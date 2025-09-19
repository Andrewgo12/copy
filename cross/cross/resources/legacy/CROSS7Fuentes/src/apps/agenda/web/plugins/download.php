<?php
	extract($_REQUEST);
	$path = "../../".$path;
	if(strstr($path,".doc"))
	{
		$filename = $path;
		header("Content-Length: " . filesize($filename));
		header('Content-Type: application/msword');
		header("Content-Type: application/force-download");
		header('Content-Disposition: attachment; filename='.$filename);
		readfile($filename);
	}
	else
		echo "<script>location='".$path."';</script>";
	
	
	
?>