<?php

class Character {
	
	public function __construct() {
		$this->actions = new Actions();
		$this->stats = new Stats();
		$this->actions->initStatsRef($this->stats);
	}
}
