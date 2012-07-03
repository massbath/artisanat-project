<?php
session_start();

$word_1 = '';
$word_2 = '';

for ($i = 0; $i < 4; $i++) {
	$word_1 .= chr(rand(97, 122));
}
for ($i = 0; $i < 4; $i++) {
	$word_2 .= chr(rand(97, 122));
}

$_SESSION['captcha'] = $word_1.' '.$word_2;

header("Content-Type: text/plain");

echo $_SESSION['captcha'];
?>