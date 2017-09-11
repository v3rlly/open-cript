<?php
/* OPENCART CUSTOMER PASSWORD HASH GENERATOR

- USAGE
		php opencript.php password salt

- DEMO

C:\Users\demo\opencript> php opencript.php admin oInuc412L
RESULT: d69ab6a7b73bf52fe58adf3ba6b9c84ee27a0ad0

*/


$password = $argv[1];
$salt = $argv[2];

$step1 = SHA1($password);
$step2 = SHA1($salt.$step1);
$result = SHA1($salt.$step2);

echo "RESULT: ".$result;

# Need me? [pablov3rlly gmail . com]
?>