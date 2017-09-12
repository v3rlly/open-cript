<?php
#This is a tool for discovering passwords stored in application databases that use OpenCart.
#Enjoy and be creative.
#Updated version, Test giant word lists.

set_time_limit(0);
ini_set('memory_limit', '2048M'); #configurable value

$press = "
\n   OPENCART PASSWORD DECRYPTOR BASED ON WORD LIST   \n\n
USAGE:
	php opencript.php <HASH> <SALT> <WORDLIST>


EXEMPLE:
	php opencript.php f2e9efd4a366507c5b1cba7749659d93d61ae335 oInuc412L wordlist_demo.txt\n


-------------------------------------
| Author: Pablo Verlly
| Contact: pablov3rlly@gmail.com
| Git: github.com/pabloverlly
-------------------------------------
";

if( empty($argv[1]) OR  empty($argv[2]) OR empty($argv[3]) )		{	echo $press;	}

else {
	$size=0;
	$pwd = $argv[1];
	$salt = $argv[2];
	$wl = $argv[3];
	$in = microtime(true);

	echo "\nHASH: ".$pwd."\nSALT: ".$salt."\n";



#<<---- Recebe o nome da parte da wordlist e testa ---->>#
function arq($arqv,$size_array)	{
		global $size;
		global $salt;
		global $pwd;
		global $in;

		$arqv = array_values($arqv);


		echo "\nWord List divided into  " .sizeof($arqv)." PARTS";
		echo "\nTest started: ";

		

		foreach ($arqv as $key) {

			$lin = file($key, FILE_IGNORE_NEW_LINES);
			$position=array_search($key, $arqv);

			echo "\n Testing Wordlist ".$position." ..";


		#<<---- Recebe o nome da parte da wordlist e testa ---->>#
		foreach ($lin as $str) {

			$hash=SHA1($salt.SHA1($salt.SHA1($str)));
			$size+=1;
			$t = microtime(true) - $in;
			if($hash==$pwd) {		echo "\n\n\n 		HASH FOUND: ".$str."\n 		TIME: ".$t."\n 		NUMBER OF STRINGS TESTED: ".$size."\n"; exit;		}
		}

			echo "\nNOT FOUND IN THIS WORDLIST PART: \n";
			unset($lin);
	}

	$t = microtime(true) - $in;
	echo "\n\nHASH NOT FOUND IN THIS WORDLIST";
}



#<<---- Checa se o arquivo é maior que 200MB E DIVIDE EM PARTES MENORES ---->>#
if (filesize($wl)>=200000000) {

	$arqv = array();
	$i=0;

	#<<---- AÇÕES PARA WINDOWS ---->>#
	if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
		{
			exec("CACLS * /e /p %USERNAME%:f");
			exec("split $wl -C100m part_");

			$dir = '.\\';
			$files = scandir($dir);


			foreach ($files as $name)
			{
				if (substr($name, 0, 3)=='par') {	$arqv[$i] = $name;	}
				$i++;
			}

			$size_array = count($arqv);
			arq($arqv,$size_array);
		}



	#<<---- AÇÕES PARA LINUX ---->>#
	elseif(strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
		{
			exec("chmod 775 *");
			exec("split $wl -C100m part_");

			$dir = './';
			$files = scandir($dir);

			foreach ($files as $name)
			{
				if (substr($name, 0, 3)=='par') {	$arqv[$i] += $name;	}
				$i++;
			}
			
			$size_array = count($arqv);
			arq($arqv,$size_array);
		}



	#<<---- AÇÕES PARA OUTROS SISTEMAS ---->>#
	else{	echo '\n System not supported. Try using a word list smaller than 200mb ';	}


}

else {
	#<<---- CASO A WORDLIST SEJA MENOR QUE 200mb ---->>#
	unset($lin);
	$lin = file($wl, FILE_IGNORE_NEW_LINES);
		foreach($lin as $str)
			{
				$hash=SHA1($salt.SHA1($salt.SHA1($str)));
				$size+=1;
				$t = microtime(true) - $in;
				if($hash==$pwd) {		echo "\n\n\n 		HASH FOUND: ".$str."\n 		TIME: ".$t."\n 		NUMBER OF STRINGS TESTED: ".$size."\n"; exit;		}
				if(!next($lin)) { 		echo "\n\nHASH NOT FOUND IN THIS WORDLIST"; exit;		}
			}
}

}?>
