<?php
$row = 2;
$col = 2;

$input = fopen( 'input.txt', 'r' );

$code = '';
while ( ( $coord = fgets( $input ) ) !== FALSE ) {
	for ( $i = 0; $i < strlen( $coord ); $i ++ ) {

		switch ( $coord[ $i ] ) {
			case 'L':
				$col --;
				break;
			case 'R':
				$col ++;
				break;
			case 'U':
				$row --;
				break;
			case 'D':
				$row ++;
				break;
		}

		$col = max( 1, min( $col, 3 ) );
		$row = max( 1, min( $row, 3 ) );
	}
	$code .= ( $row * $col );
}
echo $code . PHP_EOL;
