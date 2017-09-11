<?php
#This is a simple tool for discovering passwords stored in application databases that use OpenCart.
#Enjoy and be creative.

ini_set('memory_limit', '1024M'); #configurable value

$presentation = "
\n||||||||||||||   -   OPENCART PASSWORD DECRYPTOR BASED ON WORD LIST   -   ||||||||||||||\n
USAGE:
	php opencript.php <HASH> <SALT> <WORDLIST>


EXEMPLE:
	php opencript.php f2e9efd4a366507c5b1cba7749659d93d61ae335 oInuc412L wordlist_demo.txt\n


Author: Pablo Verlly
Contact: pablov3rlly@gmail.com
Git: github.com/pabloverlly
";

if( empty($argv[1]) OR  empty($argv[2]) OR empty($argv[3]) ){	echo $presentation;	}

else {
$size = 0;
$pwd = $argv[1];
$salt = $argv[2];
$wl = $argv[3];
$lin = file($wl, FILE_IGNORE_NEW_LINES);
$in = microtime(true);

echo "\nPASSWORD: ".$pwd."\nSALT: ".$pwd."\n";


function out($str,$found,$in,$size){
$t = microtime(true) - $in;
	
	if($found==1) {
		echo "\n\n Found: ".$str."\n TIME:".$t."\n"."\n NUMBER OF STRINGS TESTED:".$size."\n";
	}
	else {
		echo "\n\n Not Foud\n TIME: ".$t."\n"."\n NUMBER OF STRINGS TESTED:".$size."\n";
	}
}

foreach($lin as $str)
{
   $hash=SHA1($salt.SHA1($salt.SHA1($str)));
   $size+=1;
   if($hash==$pwd) { out($str,1,$in,$size); break; } else{}
   if(!next($lin)) { out($str,0,$in,$size); break; } else{}
}


}?>
