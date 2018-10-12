<?php

$hero = [
'name' => 'Talonic',
'race' => 'Half-Elf',
'class' => 'Ranger',
'hp' => 20,
'ac' => 15,
'strength' => 8,
'inventory' => [
	'Melee Weapon' => 'Bastard Sword',
	'Ranged Weapon' => 'Short Bow',
	'First Aid' => 'Bandages',
	'Ammo' => 'Arrows',
	]
];

$npc = [
'name' => 'Dagoth',
'race' => 'orc',
'class' => 'Warrior',
'hp' => 15,
'ac' => 12,
'strength' => 8,
'inventory' => [
	'Melee Weapon' => 'Long Sword',
	'First Aid' => 'Berries',
	],
];

$responses = [
'hit' => 'You hit your target',
'miss' => 'You missed your target',
];

function attack($attacker, $defender, $text) {
	$attack_roll = rand(1, 6);
	$ac_check = $attacker['strength'] + $attack_roll;

	if ($ac_check > $defender['ac']) {
		$result = $text['hit'];
	} else {
		$result = $text['miss'];
	}

	return $result;
}

function printInventoryList ($person) {
	$inventory = $person['inventory'];
	$contents = [];

	foreach ($inventory as $key => $value) {
		$contents[] = "$key - $value \n";
	}

	$backpack = implode($contents);

	$message = "{$person['name']}'s Inventory: \n" . $backpack . "\n";

	echo $message;
}

$run = attack($hero, $npc, $responses);
printInventoryList($hero);
printInventoryList($npc);

echo $run . "\n";



