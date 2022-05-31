<?php
spl_autoload_register(function($class) {
	$file=str_replace('\\','/',$class);
	$file.=".php";
	$ns_file=dirname($file);
	$frags=explode("/",$ns_file);	
	if (count($frags)>0) {
		$ns_file.="/".$frags[count($frags)-1].".php";
	}
	//print "pidiendo archivo $class=>'$file' , ns_file:'$ns_file'\n";
	if (file_exists($file)) {
		require_once($file);	
	} else if (file_exists($ns_file)) {
		require_once($ns_file);	
	} else {
		$cwd=getcwd();
		print "error: cannot load class $class with class file $file nor namespace file: $ns_file cwd:$cwd\n";
	}
	
});
?>
