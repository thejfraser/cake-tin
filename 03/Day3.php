<?php

class Day3
{
	protected $fileHandle;
	protected $okayCount;

	function __construct( $file, &$times = [] )
	{
		$this->fileHandle = fopen( $file, 'r' );
		if ( ! $this->fileHandle ) {
			trigger_error( 'Unable to open file', E_USER_ERROR );
		}
		$this->timings = &$times;
	}

	function read_line()
	{
		return fgets( $this->fileHandle );
	}

	function line2array( $line )
	{
		$array = [];
		preg_match( '/.*?([0-9]+).*?([0-9]+).*?([0-9]+)/', $line, $array );
		unset( $array[ 0 ] );

		return $array;
	}

	function transmute_arrays( array $a1, array $a2, array $a3 )
	{
		return [
			[ $a1[ 1 ], $a2[ 1 ], $a3[ 1 ] ],
			[ $a1[ 2 ], $a2[ 2 ], $a3[ 2 ] ],
			[ $a1[ 3 ], $a2[ 3 ], $a3[ 3 ] ],
		];
	}

	function order_array( array &$a )
	{
		sort( $a );
	}

	function test_match( array $line )
	{
		return $line[ 0 ] + $line[ 1 ] > $line[ 2 ];
	}

	function full_part_one()
	{
		$startTime = microtime( TRUE );
		while ( ( $line = $this->read_line() ) !== FALSE ) {
			$data = $this->line2array( $line );
			$this->order_array( $data );
			if ( $this->test_match( $data ) ) {
				$this->okayCount ++;
			}
		}
		$this->timings[] = ( microtime( TRUE ) - $startTime );

		return $this->okayCount;
	}

	function full_part_two()
	{
		$startTime = microtime( TRUE );
		while ( ( $line = $this->read_line() ) !== FALSE ) {
			$lines = [ $this->line2array( $line ) ];
			$lines[] = $this->line2array( $this->read_line() );
			$lines[] = $this->line2array( $this->read_line() );

			$lines = $this->transmute_arrays( $lines[ 0 ], $lines[ 1 ], $lines[ 2 ] );

			foreach ( $lines as $line ) {
				$this->order_array( $line );
				if ( $this->test_match( $line ) ) {
					$this->okayCount ++;
				}
			}
		}

		$this->timings[] = ( microtime( TRUE ) - $startTime );

		return $this->okayCount;
	}
}