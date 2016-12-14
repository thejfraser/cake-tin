<?php
$founds = 0;
$index = 0;
$hash = 'zpqevtbw';

$savedMappedHashes = [];

while ( $founds < 64 ) {
	$thisHash = strtolower( md5( $hash . $index ) );
	for ( $i = 0; $i < 2016; $i ++ ) {
		$thisHash = md5( $thisHash );
	}
	$theMatch = [];
	if ( preg_match( '/([0-9a-z])\1\1/', $thisHash, $theMatch ) ) {
		$_x = $index + 1;
		$match = str_repeat( $theMatch[ 1 ], 5 );
		$regex = '/' . $match . '/';
		for ( $_x = $index + 1; $_x < $index + 1001; $_x ++ ) {

			if ( isset( $savedMappedHashes[ $_x ] ) ) {
				$thatHash = $savedMappedHashes[ $_x ];
			} else {
				$thatHash = md5( $hash . $_x );
				for ( $i = 0; $i < 2016; $i ++ ) {
					$thatHash = md5( $thatHash );
				}
				$savedMappedHashes[ $_x ] = $thatHash;
			}

			if ( preg_match( $regex, $thatHash ) ) {
				$founds ++;
				echo $founds . ' => ' . $index . PHP_EOL;
				break;
			}
		}
	}

	unset( $savedMappedHashes[ $index ] );

	if ( $founds < 64 ) {
		$index ++;
	}
}
echo $index . PHP_EOL;