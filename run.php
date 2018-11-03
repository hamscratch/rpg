<?php

require __DIR__ . '/' . 'Loader.php';

$hero = new Hero;

$name = userInput("What is your name? \n");
$hero->actions->setStat(Stats::NAME, $name);
$race = userInput("Choose your race: [Dwarf], [Elf], [Gnome], [Half-Elf], [Half-Orc], [Halfling], [Human]? \n", HERO::RACES);
$class_name = userInput("Choose your class: [Warrior], [Wizard], or [Ranger] \n", HERO::CLASSES['class']);
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
		return userInput($prompt, $validators);
		
	}
}

function inputValidator($input, $truth) {
	var_dump($truth);
	if (in_array($input, $truth)) {
		return true;
	} 
	return false;
}

function setClassStats(string $type, $target) {
	$class = Hero::CLASSES[$type]['class'];
	$hp = Hero::CLASSES[$type]['hp'];
	$hp_max = Hero::CLASSES[$type]['hp_max'];
	$ac = Hero::CLASSES[$type]['ac'];
	$str = Hero::CLASSES[$type]['str'];
	$dex = Hero::CLASSES[$type]['dex'];
	$int = Hero::CLASSES[$type]['int'];

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
