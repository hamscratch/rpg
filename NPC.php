<?php

class NPC extends Character {
	
	const NAMES = ['Rique Jhames', 'Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar', 'Fipphy'];
	const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
	const CLASSES = ['Grunt', 'Warrior', 'Sorcerer'];
	public function __construct() {
		parent::__construct();
		$this->stats->name = $this->thingPicker(self::NAMES);
		$this->stats->race = $this->thingPicker(self::RACES);
		$this->stats->class = $this->thingPicker(self::CLASSES);
		$this->stats->hp_base = $this->numberPicker(8, 20);
		$this->stats->hp_temp = $this->numberPicker(8, 20);
		$this->stats->hp_total = $this->numberPicker(8, 20);
		$this->stats->hp_max = $this->numberPicker(8, 20);
		$this->stats->ac_base = $this->numberPicker(8, 20);
		$this->stats->ac_temp = $this->numberPicker(8, 20);
		$this->stats->ac_total = $this->numberPicker(8, 20);
		$this->stats->ac_bonus_items = 0;
		$this->stats->ac_bonus_effects = 0;
		$this->stats->str_base = $this->numberPicker(8, 20);
		$this->stats->str_temp = $this->numberPicker(8, 20);
		$this->stats->str_total = $this->numberPicker(8, 20);
		$this->stats->str_bonus_items = 0;
		$this->stats->str_bonus_effects = 0;
		$this->stats->dex_base = $this->numberPicker(8, 20);
		$this->stats->dex_temp = $this->numberPicker(8, 20);
		$this->stats->dex_total = $this->actions->getStat(Stats::DEX_TOTAL);
		$this->stats->dex_bonus_items = 0;
		$this->stats->dex_bonus_effects = 0;
		$this->stats->int_base = $this->numberPicker(8, 20);
		$this->stats->int_temp = $this->numberPicker(8, 20);
		$this->stats->int_temp_total = $this->numberPicker(8, 20);
		$this->stats->int_bonus_items = 0;
		$this->stats->int_bonus_effects = 0;
		$this->stats->equipped = [
			'Melee Weapon' => '',
			'Ranged Weapon' => '',
			'Armor' => '',
		];
		$this->stats->backpack = [
			'Melee Weapon' => 'Short Sword',
			'Ranged Weapon' => 'Long Bow',
			'Arrows' => 0,
		];
		$this->stats->potion_bag =[
			'Potions' => [	
				'health' => ['name' => 'Health Potion', 'quantity' => 0],
				'attack' => ['name' => 'Attack Potion', 'quantity' => 0],
				'defense' => ['name' => 'Defense Potion', 'quantity' => 0],
				'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 0],
				'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 0],
			]
		];
		$this->stats->class_description = '';
	}
	public function numberPicker($num1, $num2) {
		$result = rand($num1, $num2);
		return $result;
	}
	public function thingPicker($type) {
		$index = array_rand($type);
		$result = $type[$index];
		return $result;
	}
	public function characterInfo() {
		echo "<<< NPC Stats >>>" . "\n" . 	
				   "Name: {$this->stats->name} \n" . 
				   "Race: {$this->stats->race} \n" . 
				   "Class: {$this->stats->class} \n" .
				   "Hit Points: {$this->actions->getStat('hp')} \n" . 
				   "Defense: {$this->actions->getStat('ac')} \n" .
				   "Strength: {$this->actions->getStat('str')} \n" .
				   "Dexterity: {$this->actions->getStat('dex')} \n" .
				   "Intelligence: {$this->actions->getStat('int')} \n" . "\n"; 
	}
}
