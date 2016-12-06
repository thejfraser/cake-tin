<?php
/**
 *  ADVENT OF CODE #5
 */

$input = trim( file_get_contents( 'input.txt' ) );
$index = 0;
$hash = md5( $input . $index );
$password = [ '_', '_', '_', '_', '_', '_', '_', '_', ];
$found = 0;
while ( $found < 8 ) {
	while ( substr( $hash, 0, 5 ) !== '00000' ) {
		$index ++;
		$hash = md5( $input . $index );
	}

	$position = $hash[ 5 ];
	$char = $hash[ 6 ];
	$hash = '';

	if (
		! is_numeric( $position )
		|| $position > 7
		|| $position < 0
		|| $password[ $position ] != '_'
	) {
		continue;
	}

	$password[ $position ] = $char;
	$found ++;

	echo implode( "", $password ) . PHP_EOL;
}