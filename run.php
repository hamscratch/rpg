<?php

require __DIR__ . '/' . 'Loader.php';

$hero = new Hero;

$name = getUserInput("What is your name? \n");
$hero->actions->setStat(Stats::NAME, $name);
$race = getUserInput("Choose your race: [Dwarf], [Elf], [Human]? \n", HERO::RACES);
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

function setClassStats(string $class_name, $target) {
	$target->actions->setStat(Stats::CLASS_NAME, Hero::CLASSES[$class_name][Stats::CLASS_NAME]);
	$target->actions->setStat(Stats::HP_BASE, Hero::CLASSES[$class_name][Stats::HP_BASE]);
	$target->actions->setStat(Stats::HP_TEMP, Hero::CLASSES[$class_name][Stats::HP_TEMP]);
	$target->actions->setStat(Stats::HP_TOTAL, Hero::CLASSES[$class_name][Stats::HP_TOTAL]);
	$target->actions->setStat(Stats::HP_MAX, Hero::CLASSES[$class_name][Stats::HP_MAX]);
	$target->actions->setStat(Stats::AC_BASE, Hero::CLASSES[$class_name][Stats::AC_BASE]);
	$target->actions->setStat(Stats::AC_TEMP, Hero::CLASSES[$class_name][Stats::AC_TEMP]);
	$target->actions->setStat(Stats::AC_TOTAL, Hero::CLASSES[$class_name][Stats::AC_TOTAL]);
	$target->actions->setStat(Stats::AC_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::AC_BONUS_ITEMS]);
	$target->actions->setStat(Stats::AC_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::AC_BONUS_EFFECTS]);
	$target->actions->setStat(Stats::STR_BASE, Hero::CLASSES[$class_name][Stats::STR_BASE]);
	$target->actions->setStat(Stats::STR_TEMP, Hero::CLASSES[$class_name][Stats::STR_TEMP]);
	$target->actions->setStat(Stats::STR_TOTAL, Hero::CLASSES[$class_name][Stats::STR_TOTAL]);
	$target->actions->setStat(Stats::STR_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::STR_BONUS_ITEMS]);
	$target->actions->setStat(Stats::STR_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::STR_BONUS_EFFECTS]);
	$target->actions->setStat(Stats::DEX_BASE, Hero::CLASSES[$class_name][Stats::DEX_BASE]);
	$target->actions->setStat(Stats::DEX_TEMP, Hero::CLASSES[$class_name][Stats::DEX_TEMP]);
	$target->actions->setStat(Stats::DEX_TOTAL, Hero::CLASSES[$class_name][Stats::DEX_TOTAL]);
	$target->actions->setStat(Stats::DEX_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::DEX_BONUS_ITEMS]);
	$target->actions->setStat(Stats::DEX_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::DEX_BONUS_EFFECTS]);
	$target->actions->setStat(Stats::INT_BASE, Hero::CLASSES[$class_name][Stats::INT_BASE]);
	$target->actions->setStat(Stats::INT_TEMP, Hero::CLASSES[$class_name][Stats::INT_TEMP]);
	$target->actions->setStat(Stats::INT_TOTAL, Hero::CLASSES[$class_name][Stats::INT_TOTAL]);
	$target->actions->setStat(Stats::INT_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::INT_BONUS_ITEMS]);
	$target->actions->setStat(Stats::INT_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::INT_BONUS_EFFECTS]);
	$target->actions->setStat(Stats::EQUIPPED, Hero::CLASSES[$class_name][Stats::EQUIPPED]);
	$target->actions->setStat(Stats::BACKPACK, Hero::CLASSES[$class_name][Stats::BACKPACK]);
	$target->actions->setStat(Stats::POTION_BAG, Hero::CLASSES[$class_name][Stats::POTION_BAG]);
	$target->actions->setStat(Stats::CLASS_DESCRIPTION, Hero::CLASSES[$class_name][Stats::CLASS_DESCRIPTION]);
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
