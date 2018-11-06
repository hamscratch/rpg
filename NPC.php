<?php

class NPC extends Character {
	
	const NAMES = ['Rique Jhames', 'Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar', 'Fipphy'];
	const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
	const CLASS_NAMES = ['Grunt', 'Sorcerer', 'Hunter'];

	const CLASSES = [
			'Grunt' => [
				'class' => 'Grunt',
				'hp_base' => 30,
				'hp_temp' => 0,
				'hp_total' => 0,
				'hp_max' => 100,
				'ac_base' => 15,
				'ac_temp' => 0,
				'ac_total' => 0,
				'ac_bonus_items' => 0,
				'ac_bonus_effects' => 0,
				'str_base' => 0,
				'str_temp' => 10,
				'str_total' => 0,
				'str_bonus_items' => 0,
				'str_bonus_effects' => 0,
				'dex_base' => 8,
				'dex_temp' => 0,
				'dex_total' => 0,
				'dex_bonus_items' => 0,
				'dex_bonus_effects' => 0,
				'int_base' => 5,
				'int_temp' => 0,
				'int_total' => 0,
				'equipped' => [
					'Melee Weapon' => '',
					'Ranged Weapon' => '',
					'Armor' => '',
				],
				'backpack' => [
					'Melee Weapon' => 'Short Sword',
					'Ranged Weapon' => 'Long Bow',
					'Armor' => 'Leather',
					'Arrows' => 5,
				],
				'potion_bag' => [
					'Potions' => [
						'health' => ['name' => 'Health Potion', 'quantity' => 1],
						'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
						'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
						'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
						'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
					]
				],
				'class_description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
			],
			'Sorcerer' => [
				'class' => 'Sorcerer',
				'hp_base' => 20,
				'hp_temp' => 0,
				'hp_total' => 0,
				'hp_max' => 80,
				'ac_base' => 12,
				'ac_temp' => 0,
				'ac_total' => 0,
				'ac_bonus_items' => 0,
				'ac_bonus_effects' => 0,
				'str_base' => 6,
				'str_temp' => 0,
				'str_total' => 0,
				'str_bonus_items' => 0,
				'str_bonus_effects' => 0,
				'dex_base' => 6,
				'dex_temp' => 0,
				'dex_total' => 0,
				'dex_bonus_items' => 0,
				'dex_bonus_effects' => 0,
				'int_base' => 15,
				'int_temp' => 0,
				'int_total' => 0,
				'equipped' => [
					'Melee Weapon' => '',
					'Ranged Weapon' => '',
					'Armor' => '',
				],
				'backpack' => [
					'Melee Weapon' => 'Short Sword',
					'Ranged Weapon' => 'Long Bow',
					'Armor' => 'Leather',
					'Arrows' => 0,
				],
				'potion_bag' => [
					'Potions' => [
						'health' => ['name' => 'Health Potion', 'quantity' => 1],
						'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
						'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
						'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
						'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
					]
				],
				'class_description' => "Hailing from the gilded halls for Qeynos, the wizard blasts its enemies with magic spells."
			],
			'Hunter' => [
				'class' => 'Hunter',
				'hp_base' => 25,
				'hp_temp' => 0,
				'hp_total' => 0,
				'hp_max' => 90,
				'ac_base' => 15,
				'ac_temp' => 0,
				'ac_total' => 0,
				'ac_bonus_items' => 0,
				'ac_bonus_effects' => 0,
				'str_base' => 10,
				'str_temp' => 0,
				'str_total' => 0,
				'str_bonus_items' => 0,
				'str_bonus_effects' => 0,
				'dex_base' => 15,
				'dex_temp' => 0,
				'dex_total' => 0,
				'dex_bonus_items' => 0,
				'dex_bonus_effects' => 0,
				'int_base' => 8,
				'int_temp' => 0,
				'int_total' => 0,
				'equipped' => [
					'Melee Weapon' => '',
					'Ranged Weapon' => '',
					'Armor' => '',
				],
				'backpack' => [
					'Melee Weapon' => 'Short Sword',
					'Ranged Weapon' => 'Long Bow',
					'Armor' => 'Leather',
					'Arrows' => 10,
				],
				'potion_bag' => [
					'Potions' => [
						'health' => ['name' => 'Health Potion', 'quantity' => 1],
						'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
						'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
						'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
						'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
					]
				],
				'class_description' => "Hailing from the sprawling forests of Misty Vale, the ranger beats its enemies with ranged weapons."
			],
	];

	public function __construct() {
		parent::__construct();
		$name = $this->thingPicker(self::NAMES);
		$class = $this->thingPicker(self::CLASSES);
		$class_name = $class['class'];
		$race = $this->thingPicker(self::RACES);

		$this->stats->setStat(Stats::NAME, $name);
		$this->stats->setStat(Stats::CLASS_NAME, $class_name);
		$this->stats->setStat(Stats::RACE, $race);
		$this->stats->setNPCClassStats($class_name, $this);
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
				   "Name: {$this->stats->getStat(Stats::NAME)} \n" . 
				   "Race: {$this->stats->getStat(Stats::RACE)} \n" . 
				   "Class: {$this->stats->getStat(Stats::CLASS_NAME)} \n" .
				   "Hit Points: {$this->stats->getStat(Stats::HP_TOTAL)} \n" . 
				   "Defense: {$this->stats->getStat(Stats::AC_TOTAL)} \n" .
				   "Strength: {$this->stats->getStat(Stats::STR_TOTAL)} \n" .
				   "Dexterity: {$this->stats->getStat(Stats::DEX_TOTAL)} \n" .
				   "Intelligence: {$this->stats->getStat(Stats::INT_TOTAL)} \n" . "\n"; 
	}
}
