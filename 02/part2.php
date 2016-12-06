<?php
$row = 3;
$col = 1;

$input = fopen( 'input.txt', 'r' );

$code = '';

while ( ( $coord = fgets( $input ) ) !== FALSE ) {
	for ( $i = 0; $i < strlen( $coord ); $i ++ ) {

		$newCol = $col;
		$newRow = $row;
		switch ( $coord[ $i ] ) {
			case 'L':
				$newCol --;
				break;
			case 'R':
				$newCol ++;
				break;
			case 'U':
				$newRow --;
				break;
			case 'D':
				$newRow ++;
				break;
		}

		$newCol = max( 1, min( $newCol, 5 ) );
		$newRow = max( 1, min( $newRow, 5 ) );

		$point = $newRow . $newCol;

		if ( in_array( $point, [ 11, 12, 14, 15, 21, 25, 41, 45, 51, 52, 54, 55 ] ) ) {
			continue;
		}

		$col = $newCol;
		$row = $newRow;
	}

	//Not proud of this bit tbh
	if ( $row == 1 ) {
		$fig = 1;
	} elseif ( $row == 2 ) {
		$fig = $col;
	} elseif ( $row == 3 ) {
		$fig = $col + 4;
	} elseif ( $row == 4 ) {
		$fig = $col + 8;
	} else {
		$fig = 13;
	}

	$fig = base_convert( $fig, 10, 16 );
	$code .= $fig;
}
echo $code . PHP_EOL;
