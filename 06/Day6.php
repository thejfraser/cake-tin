<?php

class Day6
{
	const FREQ_HIGH = 1;
	const FREQ_LOW = 0;
	protected $srcFile;

	function __construct( $filePath = 'input.txt' )
	{
		$this->srcFile = fopen( $filePath, 'r' );
		if ( ! $this->srcFile ) {
			throw new Exception( 'unable to find input' );
		}
	}

	protected function read_and_pivot()
	{
		$pivot = [];

		while ( ( $line = fgets( $this->srcFile ) ) !== FALSE ) {
			foreach ( str_split( trim( $line ) ) as $k => $v ) {
				if ( ! isset( $pivot[ $k ] ) ) {
					$pivot[ $k ] = [];
				}
				$pivot[ $k ][] = $v;
			}
		}

		return $pivot;
	}

	protected function count_and_sort( array &$pivot, $frequency = self::FREQ_HIGH )
	{
		foreach ( $pivot as $key => $array ) {
			$values = array_count_values( $array );
			$frequency == self::FREQ_HIGH ? arsort( $values ) : asort( $values );
			$pivot[ $key ] = array_shift( array_keys( $values ) );
		}
	}

	function get_solution( $frequency = self::FREQ_HIGH )
	{
		$pivot = $this->read_and_pivot();
		$this->count_and_sort( $pivot, $frequency );

		return implode( "", $pivot );
	}
}