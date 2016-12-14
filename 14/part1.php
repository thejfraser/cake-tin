<?php
$founds = 0;
$index = 1;
$hash = 'zpqevtbw';
while ( $founds < 64 ) {
	$thisHash = strtolower( md5( $hash . $index ) );
	$theMatch = [];
	if ( preg_match( '/([0-9a-z])\1\1/', $thisHash, $theMatch ) ) {
		$_x = $index + 1;
		$match = str_repeat( $theMatch[ 1 ], 5 );
		$regex = '/' . $match . '/';
		for ( $_x = $index + 1; $_x < $index + 1001; $_x ++ ) {

			$thatHash = md5( $hash . $_x );

			if ( preg_match( $regex, $thatHash ) ) {
				$founds ++;
				echo $founds . ' => ' . $index . PHP_EOL;
				break;
			}
		}
	}

	if ( $founds < 64 ) {
		$index ++;
	}
}
echo $index . PHP_EOL;