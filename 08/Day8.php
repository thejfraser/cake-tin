<?php

class Day8
{
	protected $x;
	protected $y;

	protected $file;
	protected $display;

	function __construct( $file = 'input.txt', $x = 50, $y = 6 )
	{
		$this->file = fopen( $file, 'r' );
		if ( ! $file ) {
			throw new Exception ( 'file read error' );
		}

		$this->x = $x;
		$this->y = $y;
		$this->fill_display();
	}

	function fill_display()
	{
		$row = array_fill( 0, $this->x, 0 );
		$this->display = array_fill( 0, $this->y, $row );
	}

	function parse_command()
	{
		$command = trim( fgets( $this->file ) );
		if ( $command === FALSE ) {
			return FALSE;
		}

		$command = explode( ' ', $command );
		if (count($command) < 2) {
			return FALSE;
		}

		if ( $command [ 0 ] == 'rect' ) {
			$this->command_rect( $command );
		} else {
			if ( $command[ 1 ] == 'row' ) {
				$this->command_shift_x( $command );
			} else {
				$this->command_shift_y( $command );
			}
		}

		return TRUE;
	}

	function command_rect( $commandSet )
	{
		$coords = explode( 'x', $commandSet[ 1 ] );

		for ( $y = 0; $y < $coords[ 1 ]; $y ++ ) {
			for ( $x = 0; $x < $coords[ 0 ]; $x ++ ) {
				$this->display[ $y ][ $x ] = 1;
			}
		}
	}

	function command_shift_x( $commandSet )
	{
		$point = substr($commandSet[2], 2);

		$row = &$this->display[ $point ];
		$distance = $commandSet[ 4 ];

		$array = [];
		foreach ( $row as $position => $value ) {
			$array[ $position + $distance ] = $value;
		}

		foreach ( $array as $position => $value ) {
			if ( $position < $this->x ) {
				continue;
			}
			$newPosition = $position % $this->x;
			unset( $array[ $position ] );
			$array[ $newPosition ] = $value;
		}

		$row = $array;
	}

	function command_shift_y( $commandSet )
	{
		$row = substr($commandSet[2], 2);
		$distance = $commandSet[ 4 ];


		$tempRow = [];
		for ( $i = 0; $i < $this->y; $i ++ ) {
			$tempRow[ $i ] = $this->display[ $i ][ $row ];
		}

		$array = [];
		foreach ( $tempRow as $position => $value ) {
			$array[ $position + $distance ] = $value;
		}

		foreach ( $array as $position => $value ) {
			if ( $position < $this->y ) {
				continue;
			}
			$newPosition = $position % $this->y;
			unset( $array[ $position ] );
			$array[ $newPosition ] = $value;
		}

		for ( $i = 0; $i < $this->y; $i ++ ) {

			$this->display[ $i ][ $row ] = $array[ $i ];
		}
	}

	function output_board()
	{
		for($y = 0;$y < $this->y; $y++) {
			for ($x = 0; $x < $this->x; $x++) {
				echo $this->display[$y][$x] == 1 ? '#' : ' ';
			}
			echo PHP_EOL;
		}
		echo PHP_EOL;
	}

	function count_ons()
	{
		$on = 0;
		for ($y = 0; $y < $this->y; $y++) {
			$on += array_sum($this->display[$y]);
		}
		return $on;
	}
}