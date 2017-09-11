<?php
$password = $argv[1];
$salt = $argv[2];
$wordlist = $argv[3];

$lines = file($wordlist, FILE_IGNORE_NEW_LINES);
$time0 = microtime(true);

foreach($lines as $string)
{
   $hashed=SHA1($salt.SHA1($salt.SHA1($string)));
   if($hashed==$password){out($string,$password,'1',$time0,$salt); break;}else{}
   if(!next($lines) ) { out($string,$password,'0',$time0,$salt); break;} else{}
}

function out($string,$hashed,$found,$start,$salt){
$time = microtime(true) - $time0;

	if($found=='1') {
		echo "\nHASH:".$hashed."\nSALT:".$salt."\nPASSWORD:".$string."\nTIME:".$time."\n";
	}
	else {
		echo "not foud\nTIME: ".$time."\n";
	}
}

?>
