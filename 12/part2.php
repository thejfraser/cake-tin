<?php
$file = fopen('input.txt', 'r');
$commands = [];
$register = ['c' => 1];
$halt = false;
$line = 0;
while(($ln = fgets($file)) !== FALSE) {
	$commands[] = trim($ln);
}

while(!$halt) {
	$command = isset($commands[$line]) ? $commands[$line] : FALSE;
	if (!$command) {
		break;
	}
	echo 'On line: ' . $line . PHP_EOL;

	$commandParts = explode(' ', $command);

	$action = $commandParts[0];

	switch ($action) {
		case 'cpy':
			$v = is_numeric($commandParts[1])
				? $commandParts[1]
				: (
				isset($register[$commandParts[1]]) ? $register[$commandParts[1]] : 0
				);
			$register[$commandParts[2]] = $v;
			$line++;
			break;
		case 'inc':
			$register[$commandParts[1]] ++;
			$line++;
			break;
		case 'dec':
			$register[$commandParts[1]] --;
			$line++;
			break;
		case 'jnz':
			$v = is_numeric($commandParts[1])
				? $commandParts[1]
				: (
					isset($register[$commandParts[1]]) ? $register[$commandParts[1]] : 0
				);

			if ( $v != 0) {
				$line += $commandParts[2];
			} else {
				$line++;
			}
			break;
	}
}

print_r($register);exit;