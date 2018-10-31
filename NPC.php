<?php

class NPC extends Character {
	
	const NAMES = ['Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar', 'Fipphy'];
	const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
	const CLASSES = ['Grunt', 'Warrior', 'Sorcerer'];
	public function __construct() {
		parent::__construct();
		$this->stats->name = $this->thingPicker(self::NAMES);
		$this->stats->race = $this->thingPicker(self::RACES);
		$this->stats->class = $this->thingPicker(self::CLASSES);
		$this->stats->hp = $this->numberPicker(8, 20);
		$this->stats->ac = $this->numberPicker(8, 15);
		$this->stats->str = $this->numberPicker(4, 8);
		$this->stats->dex = $this->numberPicker(4, 8);
		$this->stats->int = $this->numberPicker(4,8);
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
