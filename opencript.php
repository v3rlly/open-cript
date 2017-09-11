<?php
#This is a simple tool for discovering passwords stored in application databases that use OpenCart.
#Enjoy and be creative.


$pwd = $argv[1];
$salt = $argv[2];
$wl = $argv[3];
$lin = file($wl, FILE_IGNORE_NEW_LINES);
$in = microtime(true);

foreach($lin as $str)
{
   $hash=SHA1($salt.SHA1($salt.SHA1($str)));
   
   if($hash==$pwd) { out($str,$pwd,1,$in,$salt); break; } else{}
   if(!next($lin)) { out($str,$pwd,0,$in,$salt); break; } else{}
}

function out($str,$hash,$found,$in,$salt){
$t = microtime(true) - $in;
	
	if($found==1) {
		echo "\nHASH:".$hash."\nSALT:".$salt."\nPASSWORD:".$str."\nTIME:".$t."\n";
	}
	else {
		echo "not foud\nTIME: ".$t."\n";
	}
}?>
