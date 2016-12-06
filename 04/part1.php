<?php
/**
 *  ADVENT OF CODE #4
 */

$input = fopen( 'input.txt', 'r' );
$sum = 0;

while ( ( $ln = fgets( $input ) ) !== FALSE ) {
	$parts = [];
	preg_match( '/^([a-z\-]+)([0-9]+)\[([a-z]{5})\]$/i', trim( $ln ), $parts );


	$characters = str_split( str_replace( '-', '', $parts[ 1 ] ) );

	$characters = array_count_values( $characters );
	arsort( $characters );

	$matchString = '';
	$_c = [];
	$lastLCount = 0;
	$letterCount = 0;
	foreach ( $characters as $letter => $lCount ) {
		if ( $letterCount >= 5 && $lCount != $lastLCount ) {
			break;
		}
		$lastLCount = $lCount;
		$letterCount ++;
		$_c[ $lCount ][] = $letter;
	}

	foreach ( $_c as $group ) {
		asort( $group );
		$matchString .= substr( implode( "", $group ), 0, min( 5, 5 - strlen( $matchString ) ) );
	}

	if ( $matchString === $parts[ 3 ] ) {
		$sum += $parts[ 2 ];
	}
}

echo $sum . PHP_EOL;