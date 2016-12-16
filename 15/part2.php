<?php
$file = fopen( 'input.txt', 'r' );
global $disks, $time;

$disks = [];
$time = 0;

while ( ( $line = fgets( $file ) ) !== FALSE ) {
	//Disc #1 has 17 positions; at time=0, it is at position 5.
	$matches = [];
	if ( preg_match( '/^.*#([0-9]+).*?([0-9]+).*?position ([0-9]+)/', $line, $matches ) ) {
		$diskIndex = $matches[ 1 ];
		$trackCount = $matches[ 2 ];
		$initialPosition = $matches[ 3 ];
		$idealPosition = $trackCount - $diskIndex;
		while ( $idealPosition < 0 ) {
			$idealPosition += $trackCount;
		}
		$disks[ $diskIndex ] = [
			'position'      => $initialPosition,
			'idealPosition' => $idealPosition,
			'maxPosition'   => $trackCount,
		];
	}
}

//new disk
$diskIndex = count( $disks ) + 1;
$trackCount = 11;
$initialPosition = 0;
$idealPosition = $trackCount - $diskIndex;
while ( $idealPosition < 0 ) {
	$idealPosition += $trackCount;
}
$disks[ $diskIndex ] = [
	'position'      => $initialPosition,
	'idealPosition' => $idealPosition,
	'maxPosition'   => $trackCount,
];

//find how many seconds it is until the first disk is in the right position
$firstDisk = &$disks[ 1 ];
$initialSeek = ( $firstDisk[ 'idealPosition' ] ) - $firstDisk[ 'position' ];

echo 'Initial Positions: ' . PHP_EOL;
get_positions();
seek( $initialSeek );
echo 'First Seek:' . PHP_EOL;
get_positions();

while ( all_disks_in_ideal() === FALSE ) {
	seek( $firstDisk[ 'maxPosition' ] );
}

echo 'All in position at time: ' . $time . PHP_EOL;
get_positions();
exit;

function seek( $seconds )
{
	global $disks, $time;
	$time += $seconds;
	foreach ( $disks as &$disk ) {
		$disk[ 'position' ] = $disk[ 'position' ] + $seconds;
		if ( $disk[ 'position' ] > $disk[ 'maxPosition' ] ) {
			$disk[ 'position' ] = $disk[ 'position' ] % $disk[ 'maxPosition' ];
		}
	}
}

function get_positions()
{
	global $disks;

	foreach ( $disks as $id => $disk ) {
		printf( 'Disk #%s at position %s / %s' . PHP_EOL, $id, $disk[ 'position' ], $disk[ 'idealPosition' ] );
	}
	echo PHP_EOL;
}

function all_disks_in_ideal()
{
	global $disks;
	foreach ( $disks as $disk ) {
		if ( $disk[ 'position' ] != $disk[ 'idealPosition' ] ) {
			return FALSE;
		}
	}

	return TRUE;
}