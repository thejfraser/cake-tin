<?php
/**
 *  ADVENT OF CODE #4
 */

$input = fopen( 'input.txt', 'r' );
$sum = 0;

while ( ( $ln = fgets( $input ) ) !== FALSE ) {
	$parts = [];
	preg_match( '/^([a-z\-]+)([0-9]+)\[([a-z]{5})\]$/i', trim( $ln ), $parts );
	$characters = str_split( $parts[ 1 ] );
	$movement = $parts[ 2 ] % 26;
	foreach ( $characters as &$char ) {
		if ( $char == '-' ) {
			$char = " ";
			continue;
		}
		$char = ord( $char );
		$char += $movement;
		if ( $char > ord( 'z' ) ) {
			$char -= 26;
		}
		$char = chr( $char );
	}
	$characters = implode( '', $characters );

	if ( strpos( $characters, 'northpole object storage' ) !== FALSE ) {
		echo $parts[ 2 ] . PHP_EOL;
	}
}
