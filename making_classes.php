<?php


class Character {
	
	public $name;
	public $race;
	public $class;
	public $hp;
	public $ac;
	public $str;
	public $inventory[];
}

class Hero extends Character {

	public function __construct() {
		$this->name = 'Talonic';
		$this->race = 'Half-Elf';
		$this->class = 'Ranger';
		$this->hp = 20;
		$this->ac = 15;
		$this->strength = 8;
		$this->inventory = [
			'Melee Weapon' => 'Bastard Sword',
			'Ranged Weapon' => 'Short Bow',
			'First Aid' => 'Bandages',
			'Ammo' => 'Arrows',
			];
	}
}

class NPC extends Character {
	
	const NAMES = ['Bilgebottom', 'Gorbash', 'Mordok', 'Terrorfin'];
	const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
	const CLASSES = ['Grunt', 'Warrior', 'Sorcerer'];


	public function __construct() {
		$this->name = thingPicker(self::NAMES);
		$this->race = thingPicker(self::RACES);
		$this->class = thingPicker(self::CLASSES);
		$this->hp = numberPicker(8, 15);
		$this->ac = numberPicker(8, 12);
		$this->strength = numberPicker(4, 8);

	}

	public function numberPicker($num1, $num2) {
		$result = rand($num1, $num2);

		return $result;
	}

	public function thingPicker($type) {
		$result = array_rand($type);

		return $result;
	}
}

