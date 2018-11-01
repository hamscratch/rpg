<?php

require __DIR__ . '/' . 'Loader.php';

$hero = new Hero;

echo "What is your name? \n";
$name_input = fopen("php://stdin","r");
$name_line = trim(fgets($name_input)); 
$hero->actions->setStat(Stats::NAME, $name_line);
echo "Your name is: " . $name_line . "\n";
echo "Choose your class: [Warrior], [Wizard], or [Ranger] \n";
$class_input = fopen("php://stdin","r");
$class_line = trim(fgets($class_input));
echo "Your class is: " . $class_line . "\n";

if ($class_line = 'Warrior') {
	$hero->actions->setStat(Stats::CLASS_NAME, $class_line);
	$hero->actions->setStat(Stats::HP, Hero::WARRIOR['hp']);
	$hero->actions->setStat(Stats::AC, Hero::WARRIOR['ac']);
	$hero->actions->setStat(Stats::STR, Hero::WARRIOR['str']);
	$hero->actions->setStat(Stats::DEX, Hero::WARRIOR['dex']);
	$hero->actions->setStat(Stats::INT, Hero::WARRIOR['int']);
} else if ($class_line = 'Wizard') {
	$hero->actions->setStat(Stats::CLASS_NAME, $class_line);
} else if ($class_line = 'Ranger') {
	$hero->actions->setStat(Stats::CLASS_NAME, $class_line);
} else {
	echo "That is not a valid class name. Please choose from the following: [Warrior], [Wizard], or [Ranger]";
}

$hero->characterInfo();



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
