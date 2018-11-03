<?php

require __DIR__ . '/' . 'Loader.php';

$hero = new Hero;

$name = userInput("What is your name? \n");
$hero->actions->setStat(Stats::NAME, $name);
$race = userInput("Choose your race: [Dwarf], [Elf], [Gnome], [Half-Elf], [Half-Orc], [Halfling], [Human]? \n", HERO::RACES);
$class_name = userInput("Choose your class: [Warrior], [Wizard], or [Ranger] \n");
$hero->actions->setStat(Stats::RACE, $race);
setClassStats($class_name, $hero);
$hero->characterInfo();

function userInput(string $prompt, $validators = NULL) {
	echo "{$prompt}";
	$input = fopen("php://stdin","r");
	$input_line = trim(fgets($input));

	if ($validators === NULL) {
		return $input_line;
	} else {
		$result = inputValidator($input_line, $validators);
			if ($result === true) {
				return $input_line;
			}
		echo "{$input_line} is not a valid response. Please try again. \n";
		userInput($prompt, $validators);
	}
}

function inputValidator($input, $truth) {
	if (in_array($input, $truth)) {
		return true;
	} 
	return false;
}

function setClassStats(string $type, $target) {
	if ($type === 'Warrior') {
		$class = Hero::WARRIOR['class'];
		$hp = Hero::WARRIOR['hp'];
		$hp_max = Hero::WARRIOR['hp_max'];
		$ac = Hero::WARRIOR['ac'];
		$str = Hero::WARRIOR['str'];
		$dex = Hero::WARRIOR['dex'];
		$int = Hero::WARRIOR['int'];
	} else if ($type === 'Wizard') {
		$class = Hero::WIZARD['class'];
		$hp = Hero::WIZARD['hp'];
		$hp_max = Hero::WIZARD['hp_max'];
		$ac = Hero::WIZARD['ac'];
		$str = Hero::WIZARD['str'];
		$dex = Hero::WIZARD['dex'];
		$int = Hero::WIZARD['int'];
	} else if ($type === 'Ranger') {
		$class = Hero::RANGER['class'];
		$hp = Hero::RANGER['hp'];
		$hp_max = Hero::RANGER['hp_max'];
		$ac = Hero::RANGER['ac'];
		$str = Hero::RANGER['str'];
		$dex = Hero::RANGER['dex'];
		$int = Hero::RANGER['int'];
	} else {
		echo "That is not a valid class name. Please choose from the following: [Warrior], [Wizard], or [Ranger]";
	}
	
	$target->actions->setStat(Stats::CLASS_NAME, $class);
	$target->actions->setStat(Stats::HP, $hp);
	$target->actions->setStat(Stats::HP_MAX, $hp_max);
	$target->actions->setStat(Stats::AC, $ac);
	$target->actions->setStat(Stats::STR, $str);
	$target->actions->setStat(Stats::DEX, $dex);
	$target->actions->setStat(Stats::INT, $int);
}


/*
$hero = new Hero;
$villain = new NPC;
$hero->characterInfo();
$hero->printInventoryList();
$villain->characterInfo();
$melee_attack = $hero->actions->meleeAttack($villain);
echo $melee_attack;
$ranged_attack = $hero->actions->rangedAttack($villain);
echo $ranged_attack;
echo "Potions left: " . $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->actions->usePotion(Stats::POTION_HEAL);
$hero->actions->defend();
$villain->actions->usePotion(Stats::POTION_HEAL);
$hero->characterInfo();
$villain->characterInfo();
$hero->actions->getItemInfo('Melee');
echo "Potions left: " .  $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->characterInfo();
$hero->actions->castSpell('fireball', $villain);
$hero->actions->usePotion(Stats::POTION_DEX);
$hero->characterInfo();
$hero->printInventoryList();
$hero->actions->equip('equipped_melee', 'Short Sword');
var_dump($hero->stats->equipped);
var_dump($hero->stats->backpack);
$hero->printInventoryList();
*/
