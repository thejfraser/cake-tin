<?php
include "Day9.php";
$day = new Day9( 'input.txt', Day9::PASS_DOUBLE);

while( $day->read_until_boundry() ) {
	$day->handle_boundry();
	echo 'Expanded Length: ' . $day->get_expanded_length() .' / ' . $day->get_string_remaining();
	echo PHP_EOL;
}

echo 'Expanded Length: ' . $day->get_expanded_length() .' / ' . $day->get_string_remaining();
echo PHP_EOL;
