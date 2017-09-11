<?php
$password = $argv[1];
$salt = $argv[2];

$step1 = SHA1($password);
$step2 = SHA1($salt.$step1);
$result = SHA1($salt.$step2);

echo "RESULT: ".$result;

# Need me? [pablov3rlly gmail . com]
?>
