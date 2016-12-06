<?php
/**
 *  ADVENT OF CODE #5
 */

$input = trim( file_get_contents( 'input.txt' ) );
$index = 0;
$hash = md5( $input . $index );
$password = '';

while ( ! isset( $password[ 7 ] ) ) {
	while ( substr( $hash, 0, 5 ) !== '00000' ) {
		$index ++;
		$hash = md5( $input . $index );
	}
	$password .= $hash[ 5 ];
	echo str_pad( $password, 8, '_', STR_PAD_RIGHT ) . PHP_EOL;
	$hash = '';
}
