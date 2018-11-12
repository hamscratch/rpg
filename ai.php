<?php


function npcTurn() {
	$hp = $this->stats->hp_total;

	if ($hp <= 11) {
		$this->actions->meleeAttack($target);
	} else if ($hp <= 10) {
		$this->actions->usePotion('heal');
	}
}



function combat($hero, $villain) {
	while ($villain->stats->getStat(Stats::HP_TOTAL) >= 1) {
		$action = getUserInput("<<< What would you like to do >>>\n" . "[Attack] [Defend] [Potion] [Info] [Run] \n", $action_responses);

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
			case 'Info':
				$hero->characterInfo();
				$action = getUserInput("<<< What would you like to do >>>\n" . "[Attack] [Defend] [Potion] [Info] [Run] \n", $action_responses);
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
}