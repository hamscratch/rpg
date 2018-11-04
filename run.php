<?php

require __DIR__ . '/' . 'Loader.php';

$hero = new Hero;

$name = getUserInput("What is your name? \n");
$hero->actions->setStat(Stats::NAME, $name);
$race = getUserInput("Choose your race: [Dwarf], [Elf], [Gnome], [Half-Elf], [Half-Orc], [Halfling], [Human]? \n", HERO::RACES);
$class_name = getUserInput("Choose your class: [Warrior], [Wizard], or [Ranger] \n", HERO::CLASSES);
$hero->actions->setStat(Stats::RACE, $race);
setClassStats($class_name, $hero);
$hero->characterInfo();

/*
userInput():
  get user input
  while user input is not valid:
    ask for user input again
    if user input is valid:
      return the valid input
*/

function getUserInput(string $prompt, $valid_options = NULL) {
	echo "{$prompt}";
	$input = fopen("php://stdin","r");
	$input_line = trim(fgets($input));

	if ($valid_options === NULL) {
		return $input_line;
	} else {
		$is_valid_choice = validateChoice($input_line, $valid_options);
			if ($is_valid_choice === true) {
				return $input_line;
			}
		echo "{$input_line} is not a valid response. Please try again. \n";
		return getUserInput($prompt, $valid_options);
		
	}
}

function validateChoice($input, $valid_options) {
	if (!in_array($input, $valid_options)) {
		if (array_key_exists($input, $valid_options)) {
			return true;
		} else {
			return false;
		}
	} else if (in_array($input, $valid_options)) {
		return true;
	}
}

function setClassStats(string $type, $target) {
	$class = Hero::CLASSES[$type]['class'];
	$hp_base = Hero::CLASSES[$type]['hp_base'];
	$hp_max = Hero::CLASSES[$type]['hp_max'];
	$ac_base = Hero::CLASSES[$type]['ac_base'];
	$str_base = Hero::CLASSES[$type]['str_base'];
	$dex_base = Hero::CLASSES[$type]['dex_base'];
	$int_base = Hero::CLASSES[$type]['int_base'];

	$target->actions->setStat(Stats::CLASS_NAME, $class);
	$target->actions->setStat(Stats::HP_BASE, $hp_base);
	$target->actions->setStat(Stats::HP_MAX, $hp_max);
	$target->actions->setStat(Stats::AC_BASE, $ac_base);
	$target->actions->setStat(Stats::STR_BASE, $str_base);
	$target->actions->setStat(Stats::DEX_BASE, $dex_base);
	$target->actions->setStat(Stats::INT_BASE, $int_base);
}

var_dump($hero);

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



	if ($type === 'Warrior') {
		$class = Hero::CLASSES['WARRIOR']['class'];
		$hp = Hero::CLASSES['WARRIOR']['hp'];
		$hp_max = Hero::CLASSES['WARRIOR']['hp_max'];
		$ac = Hero::CLASSES['WARRIOR']['ac'];
		$str = Hero::CLASSES['WARRIOR']['str'];
		$dex = Hero::CLASSES['WARRIOR']['dex'];
		$int = Hero::CLASSES['WARRIOR']['int'];
	} else if ($type === 'Wizard') {
		$class = Hero::CLASSES['WIZARD']['class'];
		$hp = Hero::CLASSES['WIZARD']['hp'];
		$hp_max = Hero::CLASSES['WIZARD']['hp_max'];
		$ac = Hero::CLASSES['WIZARD']['ac'];
		$str = Hero::CLASSES['WIZARD']['str'];
		$dex = Hero::CLASSES['WIZARD']['dex'];
		$int = Hero::CLASSES['WIZARD']['int'];
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
*/
