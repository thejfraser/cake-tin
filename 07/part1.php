<?php

$input = fopen('input.txt', 'r');

$regex = '/([a-z])(?!\1)([a-z])\2\1/';

$count = 0;
while (($ln = fgets($input)) !== FALSE) {
	$ln = trim($ln);
	$supers = [];
	$subs = '';

	preg_match_all( '/\[([a-z]*)\]/', $ln, $supers);
	$supers = implode("|", $supers[1]);
	$subs = preg_replace( '/(\[[a-z]*\])/',"|", $ln);

	if(preg_match($regex, $subs) && !preg_match($regex, $supers)) {
		$count++;
	}
}
echo $count;