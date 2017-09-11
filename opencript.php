<?php
$pwd = $argv[1];
$salt = $argv[2];
$wl = $argv[3];

$lin = file($wl, FILE_IGNORE_NEW_LINES);
$in = microtime(true);

foreach($lin as $string)
{
   $hashed=SHA1($salt.SHA1($salt.SHA1($string)));
   if($hashed==$pwd){out($string,$pwd,'1',$in,$salt); break;}else{}
   if(!next($lin) ) { out($string,$pwd,'0',$in,$salt); break;} else{}
}
function out($string,$hashed,$found,$in,$salt){
$t = microtime(true) - $in;
	if($found=='1') {
		echo "\nHASH:".$hashed."\nSALT:".$salt."\nPASSWORD:".$string."\nTIME:".$t."\n";
	}
	else {
		echo "not foud\nTIME: ".$t."\n";
	}
}
?>
