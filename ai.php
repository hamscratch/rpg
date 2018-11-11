<?php


function npcTurn() {
	$hp = $this->stats->hp_total;

	if ($hp <= 11) {
		$this->actions->meleeAttack($target);
	} else if ($hp <= 10) {
		$this->actions->usePotion('heal');
	}
}


