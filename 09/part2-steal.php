<?php
/**
 * This solution was taken from someone else, and it runs _a lot_ faster than mine for part 2
 */
$file = trim(file_get_contents( 'input.txt' ));

$inputlength = strlen($file);

$letters = array_pad( [], $inputlength, 1);

$pointer = 0;
$total = 0;

while ($pointer < $inputlength) {
	$thisCharacter = $file[$pointer];


	if ($thisCharacter == '(' ) {

		$closingBracket = stripos( $file, ')', $pointer );

		$instruction = explode( "x", substr( $file, $pointer+1, $closingBracket-$pointer-1));

		for( $i = 0; $i < $instruction[0]; $i++) {
			$letters[$closingBracket+1+$i] = $instruction[1] * $letters[$pointer];
		}

		$pointer = $closingBracket;
	} else {
		$total += $letters[$pointer];
	}
	$pointer++;
}

echo $total;