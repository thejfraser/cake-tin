<?php
//up = 1;
//left = 4;
//right = 2;
//down = 3;

$input = trim( file_get_contents( 'input.txt' ) );
$facing = 0;
$coords = explode( ',', $input );
$past = [];

$x = 0;
$y = 0;

while ( count( $coords ) > 0 ) {

	$nextCoord = trim( array_shift( $coords ) );
	$dir = substr( $nextCoord, 0, 1 );
	$steps = intval( substr( $nextCoord, 1 ) );

	if ( $facing == 0 ) {
		$facing = $dir == 'R' ? 2 : 4;
	} else {
		switch ( $dir ) {
			case 'L':

				$facing -= 1;
				if ( $facing < 1 ) {
					$facing = 4;
				}
				break;
			case 'R':
				$facing += 1;
				if ( $facing > 4 ) {
					$facing = 1;
				}
		}
	}

	switch ( $facing ) {
		case 1:
			$y += $steps;
			break;
		case 2:
			$x += $steps;
			break;
		case 3:
			$y -= $steps;
			break;
		case 4:
			$x -= $steps;
			break;
	}
}

echo ( max( $x, - $x ) ) + ( max( $y, - $y ) );