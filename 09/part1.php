<?php
include "Day9.php";
$day = new Day9( 'input.txt', Day9::PASS_SINGLE);

while( $day->read_until_boundry() ) {
	$day->handle_boundry();
}
echo 'Expanded Length: ' . $day->get_expanded_length();
echo PHP_EOL;
