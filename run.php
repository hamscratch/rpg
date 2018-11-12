<?php

require __DIR__ . '/' . 'Loader.php';

$action_responses = ['Attack', 'Defend', 'Potion', 'Run'];

$hero = new Hero;
$villain = new NPC;

$name = getUserInput("What is your name? \n");
$hero->stats->setStat(Stats::NAME, $name);
$race = getUserInput("<<< Choose your race >>>\n" . "[Dwarf] [Elf] [Human]\n", HERO::RACES);
$class_name = getUserInput("<<< Choose your class >>>\n" . "[Warrior] [Wizard] [Ranger]\n", HERO::CLASSES);
$hero->stats->setStat(Stats::RACE, $race);
$hero->stats->setClassStats('Hero', $class_name);
$hero->characterInfo();
$villain->characterInfo();


echo "You have encountered {$villain->stats->getStat(Stats::NAME)}!" . "\n";
while ($villain->stats->getStat(Stats::HP_TOTAL) >= 1) {
	$action = getUserInput("<<< What would you like to do >>>\n" . "[Attack] [Defend] [Potion] [Run] \n", $action_responses);

	switch ($action) {
		case 'Attack':
			$hero->actions->meleeAttack($villain);
			break;
		case 'Defend':
			$hero->actions->defend();
			$hero->stats->updateTotalStats();
			break;
		case 'Potion':
			$hero->actions->usePotion(Stats::POTION_HEAL);
			break;
		case 'Run':
			echo "Why are you running like a wimp? \n";
			break;
		default:
			echo "Don't be a chud. \n";
		}

	$villain_life_status = isDead($villain);

	if ($villain_life_status === false) {
		$villain->npcTurn($hero);
		$hero_life_status = isDead($hero);

		if ($hero_life_status === true) {
			echo "<<< YOU LOSE! >>>\n";
			exit;
		}
	} else {
		echo "<<< YOU WON! >>>\n";
		$villain->characterInfo();
		exit;
	}

	$hero->stats->resetTempStats();
	$villain->stats->resetTempStats();
}

function isDead($target) {
	$is_dead = false;
	$hp = $target->stats->getStat(Stats::HP_TOTAL);
	if ($hp <= 0) {
		$is_dead = true;
	} 
	return $is_dead;
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
	$corrected_input = ucfirst($input_line);

	if ($valid_options === NULL) {
		return $corrected_input;
	} else {
		$is_valid_choice = validateChoice($corrected_input, $valid_options);
			if ($is_valid_choice === true) {
				return $corrected_input;
			}
		echo "{$corrected_input} is not a valid response. Please try again. \n";
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
