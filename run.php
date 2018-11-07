<?php

require __DIR__ . '/' . 'Loader.php';

 $action_responses = ['Attack', 'Run'];

$hero = new Hero;
$villain = new NPC;

$name = getUserInput("What is your name? \n");
$hero->stats->setStat(Stats::NAME, $name);
$race = getUserInput("Choose your race: [Dwarf], [Elf], [Human]? \n", HERO::RACES);
$class_name = getUserInput("Choose your class: [Warrior], [Wizard], or [Ranger] \n", HERO::CLASSES);
$hero->stats->setStat(Stats::RACE, $race);
$hero->stats->setClassStats('Hero', $class_name);
$hero->characterInfo();
$villain->characterInfo();


echo "You have encountered {$villain->stats->getStat(Stats::NAME)}! \n";
$action = getUserInput("What would you like to do? [Attack] or [Run]? \n", $action_responses);
if ($action === 'Attack') {
	$hero->actions->meleeAttack($villain);
} else {
	echo "Why are you running like a wimp? \n";
}
$villain->characterInfo();



/** Sets a new value of a stat.
	* 
	* @param string $stat_string - use the constants above
	*
	* @param mixed $updated_stat - the new value you want to set the stat to
	*
	* @return mixed - will update the given stat with the new value 
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


/** Sets a new value of a stat.
	* 
	* @param string $stat_string - use the constants above
	*
	* @param mixed $updated_stat - the new value you want to set the stat to
	*
	* @return mixed - will update the given stat with the new value 
	*/
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

