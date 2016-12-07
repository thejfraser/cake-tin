<?php
$input = fopen('input.txt', 'r');

$regex = '/[a-z|]*?([a-z])(?!\1)([a-z])(\1)[a-z|]*?#[a-z|]*?(\2)(\1)(\2)/';

$count = 0;
while (($ln = fgets($input)) !== FALSE) {
	$ln = trim($ln);
	$supers = [];
	$subs = '';

	preg_match_all( '/\[([a-z]*)\]/', $ln, $supers);
	$supers = implode("|", $supers[1]);
	$subs = preg_replace( '/(\[[a-z]*\])/',"|", $ln);

	if (preg_match( $regex, $subs . '#' . $supers) || preg_match( $regex, $supers . '#' . $subs)) {
		$count++;
	}
}
echo $count;