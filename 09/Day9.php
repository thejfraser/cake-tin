<?php

class Day9
{
	const PASS_SINGLE = 1;
	const PASS_DOUBLE = 2;
	protected $passType = 0;
	protected $file;
	protected $expandedLength = 0;
	protected $inputString = '';
	protected $pointer = 0;

	function __construct( $file = 'input.txt', $passType = self::PASS_SINGLE )
	{
		$this->load_file();
		$this->passType = $passType;
	}

	function load_file( $file = 'input.txt' )
	{
		$this->inputString = file_get_contents( $file );
	}

	function next_boundry_position()
	{
		return strpos( $this->inputString, '(' );
	}

	function next_boundry_end_position()
	{
		return strpos( $this->inputString, ')' );
	}

	private function _read_to_end()
	{
		$this->expandedLength += strlen( $this->inputString );
		$this->inputString = '';
	}

	private function _read_to_point( $point )
	{

		$this->inputString = substr( $this->inputString, $point );

		$this->expandedLength += $point;
	}

	function read_until_boundry()
	{
		$boundry = $this->next_boundry_position();

		if ( $boundry === FALSE ) {
			$this->_read_to_end();

			return FALSE;
		}

		$this->_read_to_point( $boundry );

		return TRUE;
	}

	function remove_string_to_point( $point )
	{
		$this->inputString = substr( $this->inputString, $point );
	}

	function handle_boundry()
	{
		$endPosition = $this->next_boundry_end_position();

		if ( $endPosition === FALSE ) {
			$this->_read_to_end();

			return FALSE;
		}

		$instruction = substr( $this->inputString, 1, $endPosition - 1 );
		$instruction = explode( 'x', $instruction );

		$charactersToRepeat = substr( $this->inputString, $endPosition + 1, $instruction[ 0 ] );
		$charactersToRepeat = str_repeat( $charactersToRepeat, $instruction[ 1 ] );

		$this->remove_string_to_point( $endPosition + $instruction[ 0 ] + 1 );

		if ( $this->passType == self::PASS_SINGLE ) {
			$this->expandedLength += strlen( $charactersToRepeat );
		} elseif ( $this->passType == self::PASS_DOUBLE ) {
			$this->inputString = $charactersToRepeat . $this->inputString;
		}
	}

	function get_expanded_length()
	{
		return $this->expandedLength;
	}
	function get_string_remaining()
	{
		return strlen( $this->inputString );
	}
}