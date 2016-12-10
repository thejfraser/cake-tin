<?php
$input = fopen( 'input.txt', 'r' );
$instructions = [];
$bots = [];
$boxes = [];
$outputs = [];

while ( ( $line = fgets( $input ) ) !== FALSE ) {
	if ( $line[ 0 ] == 'v' ) {
		$instr = [];
		preg_match( '/value ([0-9]+) goes to bot ([0-9]+)/', $line, $instr );

		if ( ! isset( $bots[ $instr[ 2 ] ] ) ) {
			$bots[ $instr[ 2 ] ] = [];
		}

		$bots[ $instr[ 2 ] ][] = $instr[ 1 ];
		continue;
	}

	$instructions[] = trim( $line );
}

while ( count( $instructions ) > 0 ) {
	$line = array_shift( $instructions );

	if ( $line[ 0 ] == 'b' ) {
		$instr = [];
		preg_match( '/bot ([0-9]+) gives low to (bot|output) ([0-9]+) and high to (bot|output) ([0-9]+)/', $line, $instr );

		if ( ! isset( $bots[ $instr[ 1 ] ] ) ) {
			$bots[ $instr[ 1 ] ] = [];
		}

		echo 'Bot ' . $instr[ 1 ] . ' has ' . count( $bots[ $instr[ 1 ] ] ) . ' items' . PHP_EOL;
		if ( count( $bots[ $instr[ 1 ] ] ) != 2 ) {
			$instructions[] = $line;
			continue;
		}

		$botHands = &$bots[ $instr[ 1 ] ];
		usort( $botHands, 'customSort' );
		echo 'bot ' . $instr[ 1 ] . ' HANDS: [ ' . implode( ' : ', $botHands ) . ' ] ' . PHP_EOL;
		if ( $botHands[ 0 ] == '17' && $botHands[ 1 ] == '61' ) {
			echo 'This bot is the answer: ' . $instr[ 1 ] . PHP_EOL;
		}

		$lowOutputNumber = $instr[ 3 ];
		if ( $instr[ 2 ] == 'output' ) {
			$outputs[ $lowOutputNumber ] = $botHands[ 0 ];
		} else {
			if ( ! isset( $bots[ $lowOutputNumber ] ) ) {
				$bots[ $lowOutputNumber ] = [];
			}

			$bots[ $lowOutputNumber ][] = $botHands[ 0 ];
		}

		$highOutputNumber = $instr[ 5 ];
		if ( $instr[ 4 ] == 'output' ) {
			$outputs[ $highOutputNumber ] = $botHands[ 1 ];
		} else {
			if ( ! isset( $bots[ $highOutputNumber ] ) ) {
				$bots[ $highOutputNumber ] = [];
			}

			$bots[ $highOutputNumber ][] = $botHands[ 1 ];
		}

		unset( $botHands[ 0 ] );
		unset( $botHands[ 1 ] );
	}
}

function customSort( $a, $b )
{
	if ( $a == 'H' ) return 1;
	if ( $a == 'L' ) return - 1;

	return $a > $b ? 1 : - 1;
}
ksort($outputs);
echo $outputs[0] * $outputs[1] * $outputs[2];