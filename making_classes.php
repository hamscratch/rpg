<?php


class Character {
	
	public $name;
	public $race;
	public $class;
	public $hp;
	public $ac;
	public $str;
	public $inventory;

	public function __construct() {
		$this->actions = new Actions();
	}

}

class Hero extends Character {

	public function __construct() {
		parent::__construct();
		$this->name = 'Talonic';
		$this->race = 'Half-Elf';
		$this->class = 'Ranger';
		$this->hp = 20;
		$this->ac = 15;
		$this->str = 8;
		$this->inventory = [
			'Melee Weapon' => 'Bastard Sword',
			'Ranged Weapon' => 'Short Bow',
			'First Aid' => 'Bandages',
			'Ammo' => 'Arrows',
			];
	}

	public function printInventoryList () {
		$inventory = $this->inventory;
		$contents = [];

		foreach ($inventory as $key => $value) {
			$contents[] = "$key - $value \n";
		}

		$backpack = implode($contents);

		$message = "{$this->name}'s Inventory: \n" . $backpack . "\n";

		echo $message . "\n";
	}

	public function characterInfo() {
		echo "Name: {$this->name} \n" . 
				   "Race: {$this->race} \n" . 
				   "Class: {$this->class} \n" .
				   "Hit Points: {$this->hp} \n" . 
				   "Defense: {$this->ac} \n" .
				   "Strength: {$this->str} \n" . "\n";
	}
}

class NPC extends Character {
	
	const NAMES = ['Bilgebottom', 'Gorbash', 'Mordok', 'Terrorfin'];
	const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
	const CLASSES = ['Grunt', 'Warrior', 'Sorcerer'];


	public function __construct() {
		parent::__construct();
		$this->name = $this->thingPicker(self::NAMES);
		$this->race = $this->thingPicker(self::RACES);
		$this->class = $this->thingPicker(self::CLASSES);
		$this->hp = $this->numberPicker(8, 15);
		$this->ac = $this->numberPicker(8, 12);
		$this->str = $this->numberPicker(4, 8);

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
		echo "Name: {$this->name} \n" . 
				   "Race: {$this->race} \n" . 
				   "Class: {$this->class} \n" .
				   "Hit Points: {$this->hp} \n" . 
				   "Defense: {$this->ac} \n" .
				   "Strength: {$this->str} \n" . "\n";
	}
}

class Actions {

	const ATTACK_RESPONSES = [
	'hit' => "You swing and hit %s for %s damage.",
	'crit_hit' => 'You crush your enemy for a lot of damage.',
	'miss' => 'You missed your target.',
	'crit_miss' => 'You miss so bad your weapon laughs at you',
	];

	const DEFENSE_RESPONSES = [
	'hit' => "%s was hit for %s damage and now has %s hit points left.",
	'miss' => "%s has %s hit points left.",
	'dead' => "%s has been slain by %s.",
	];

	public function attack($attacker, $defender) {
		$attack_roll = rand(1, 6);
		$ac_check = $attacker->str + $attack_roll;
		$defense_ac = $defender->ac;
		$hp_result = $defender->hp - $ac_check;
		$attack_name = "{$attacker->name} the {$attacker->class}";
		$defender_name = "{$defender->name} the {$defender->class}";
		$defender_hp = $defender->hp;

		if ($ac_check > $defense_ac) {
			$result = self::ATTACK_RESPONSES['hit'];
		} else {
			$result = self::ATTACK_RESPONSES['miss'];
		}

		$attack_message = sprintf($result, $defender_name, $ac_check);

		if ($result == self::ATTACK_RESPONSES['hit'] ) {
			$defender_text = self::DEFENSE_RESPONSES['hit'];
		} else {
			$defender_text = self::DEFENSE_RESPONSES['miss'];
		}
		
		if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $ac_check, $hp_result);
				if ($d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $ac_check, $hp_result) and ($ac_check > $defender_hp)) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attack_name);
				}
		}

		if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
		}
		
		return $attack_message . "\n" . $d_text . "\n";
	}

	public function defend($defender) {
		$defend_roll = rand(1, 6);
		$new_ac = $defender->ac + $defend_roll;

		$message = "Your defense has been boosted by {$defend_roll} and is now {$new_ac}";
	}

	public function firstAid($character) {
		$type = $character[$this->inventory]['firstAid'];
	}
}

$hero = new Hero;
$villain = new NPC;

//var_dump($hero);
$hero->characterInfo();
$hero->printInventoryList();

$villain->characterInfo();

$attack = $hero->actions->attack($hero, $villain);
echo $attack;





