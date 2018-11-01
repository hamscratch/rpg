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
setClassStats($class_line, $hero);

function setClassStats($type, $target) {
	if ($type = 'Warrior') {
		$class = Hero::WARRIOR['class'];
		$hp = Hero::WARRIOR['hp'];
		$ac = Hero::WARRIOR['ac'];
		$str = Hero::WARRIOR['str'];
		$dex = Hero::WARRIOR['dex'];
		$int = Hero::WARRIOR['int'];
	} else if ($type = 'Wizard') {
		$class = Hero::WIZARD['class'];
		$hp = Hero::WIZARD['hp'];
		$ac = Hero::WIZARD['ac'];
		$str = Hero::WIZARD['str'];
		$dex = Hero::WIZARD['dex'];
		$int = Hero::WIZARD['int'];
	} else if ($type = 'Ranger') {
		$class = Hero::RANGER['class'];
		$hp = Hero::RANGER['hp'];
		$ac = Hero::RANGER['ac'];
		$str = Hero::RANGER['str'];
		$dex = Hero::RANGER['dex'];
		$int = Hero::RANGER['int'];
	} else {
		echo "That is not a valid class name. Please choose from the following: [Warrior], [Wizard], or [Ranger]";
	}
	
	$target->actions->setStat(Stats::CLASS_NAME, $class);
	$target->actions->setStat(Stats::HP, $hp);
	$target->actions->setStat(Stats::AC, $ac);
	$target->actions->setStat(Stats::STR, $str);
	$target->actions->setStat(Stats::DEX, $dex);
	$target->actions->setStat(Stats::INT, $int);
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
