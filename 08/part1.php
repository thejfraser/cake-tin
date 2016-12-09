<?php
include 'Day8.php';

$d8 = new Day8();

while( $d8->parse_command() ){}

echo 'lights on: ' . $d8->count_ons() . PHP_EOL;
$d8->output_board();