<?php

require __DIR__ . '/' . 'Loader.php';

$action_responses = ['Attack', 'Defend',  'Run'];

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
while ($villain->stats->getStat(Stats::HP_TOTAL) >= 1) {
	$action = getUserInput("What would you like to do? [Attack], [Defend], or [Run]? \n", $action_responses);

	switch ($action) {
		case 'Attack':
			$hero->actions->meleeAttack($villain);
		case 'Defend':
			$hero->actions->defend();
			$hero->stats->updateTotalStats();
		case 'Run':
			echo "Why are you running like a wimp? \n";
		default:
			echo "Don't be a chud. \n";
		}


	$villain->npcTurn($hero);
}
$villain->characterInfo();


function flipCoin() {
	$coin = rand(0, 1);
	return $coin;
}

function newGame() {
	$turn = 0;
	echo '';
}

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

// https://github.com/ksullivan2/simple_games/blob/master/tictactoe.py example of how a user/computer take turns until a winner is set.
