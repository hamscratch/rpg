<?php

class Hero extends Character {
	// this is just placeholder for now, but id like to have the user choose their class and have them populate 
	// the stats. might need a function to do this. not sure yet. should also update to the consts stat names.
	// (10/30)
	const RACES = [
		'Dwarf',
		'Gnome',
		'Elf',
		'Half-Elf',
		'Half-Orc',
		'Halfling',
		'Human',
	];
	const CLASSES = [
			'Warrior' => [
				'class' => 'Warrior',
				'hp' => 30,
				'hp_max' => 100,
				'ac' => 15,
				'str' => 10,
				'dex' => 8,
				'int' => 5,
				'equipped' => [],
				'backpack' => [],
				'potion_bag' => [],
				'description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
			],
			'Wizard' => [
				'class' => 'Wizard',
				'hp' => 20,
				'hp_max' => 80,
				'ac' => 10,
				'str' => 5,
				'dex' => 8,
				'int' => 10,
				'equipped' => [],
				'backpack' => [],
				'potion_bag' => [],
				'description' => "Hailing from the gilded halls for Qeynos, the wizard blasts its enemies with magic spells."
			],
			'Ranger' => [
				'class' => 'Ranger',
				'hp' => 25,
				'hp_max' => 90,
				'ac' => 15,
				'str' => 8,
				'dex' => 10,
				'int' => 5,
				'equipped' => [],
				'backpack' => [],
				'potion_bag' => [],
				'description' => "Hailing from the sprawling forests of Misty Vale, the ranger beats its enemies with ranged weapons."
			],
	];	
	public function __construct() {
		parent::__construct();
		$this->stats->name = $this->actions->getStat(Stats::NAME);
		$this->stats->race = $this->actions->getStat(Stats::RACE);
		$this->stats->class = $this->actions->getStat(Stats::CLASS_NAME);
		$this->stats->hp = $this->actions->getStat(Stats::HP);
		$this->stats->hp_max = $this->actions->getStat(Stats::HP_MAX);
		$this->stats->ac = $this->actions->getStat(Stats::AC);
		$this->stats->ac_bonus_items = 0;
		$this->stats->ac_bonus_effects = 0;
		$this->stats->str = $this->actions->getStat(Stats::STR);
		$this->stats->str_bonus_items = 0;
		$this->stats->str_bonus_effects = 0;
		$this->stats->dex = $this->actions->getStat(Stats::DEX);
		$this->stats->dex_bonus_items = 0;
		$this->stats->dex_bonus_effects = 0;
		$this->stats->int = $this->actions->getStat(Stats::INT);
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
			'Armor' => 'Leather',
			'Arrows' => 2,
		];
		$this->stats->potion_bag = [
			'Potions' => [
				'health' => ['name' => 'Health Potion', 'quantity' => 1],
				'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
				'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
				'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
				'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
			]
		];
		$this->stats->class_description = '';
	}
	// not sure how useful this is. definitely needs some overhaul. will wait until i add more itmes maybe (10/30)
	public function printInventoryList () {
		$backpack = $this->stats->backpack;
		$potion_bag = $this->stats->potion_bag['Potions'];
		$backpack_contents = [];
		$potion_bag_contents = [];
		foreach ($backpack as $key => $value) {
			$backpack_contents[] = "$key - $value \n";
		}
		foreach ($potion_bag as $potion => $type) {
			$potion_name = $type['name'];
			$potion_quantity = $type['quantity'];
			$potion_string = "{$potion_name}: {$potion_quantity} \n";
			$potion_bag_contents[] = $potion_string;
		}
		$potion_bag_result = implode($potion_bag_contents);
		$backpack_result = implode($backpack_contents);
		
		$message = "<<< {$this->stats->name}'s Inventory >>> \n" . $backpack_result . "\n" . "<<< Potion Bag >>> \n" .              $potion_bag_result . "\n";
		echo $message . "\n";
	}
	public function characterInfo() {
		echo "<<< Character Stats >>>" . "\n" . 	
				   "Name: {$this->stats->name} \n" . 
				   "Race: {$this->stats->race} \n" . 
				   "Class: {$this->stats->class} \n" .
				   "Hit Points: {$this->actions->getStat(Stats::HP)} \n" . 
				   "Defense: {$this->actions->getStat(Stats::AC)} \n" .
				   "Strength: {$this->actions->getStat(Stats::STR)} \n" .
				   "Dexterity: {$this->actions->getStat(Stats::DEX)} \n" .
				   "Intelligence: {$this->actions->getStat(Stats::INT)} \n" . "\n"; 
	}
}
