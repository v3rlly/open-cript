<?php
$password = $argv[1];
$salt = $argv[2];
$wordlist = $argv[3];

$lines = file($wordlist, FILE_IGNORE_NEW_LINES);


$start = microtime(true);

foreach($lines as $string)
{
   $hashed=SHA1($salt.SHA1($salt.SHA1($string)));
   if($hashed==$password){tempo($string,$password,'1',$start,$salt); break;}else{}
   
   if(!next($lines) ) { tempo($string,$password,'0',$start,$salt); break;} else{}
}

function tempo($string,$hashed,$found,$start,$salt){
$time = microtime(true) - $start;

if($found=='1') {
	echo "\nHASH:".$hashed."\nSALT:".$salt."\nPASSWORD:".$string."\nTIME:".$time."\n";
}
else {
	echo "not foud";
}

}
# Need me? [pablov3rlly gmail . com]
?>
