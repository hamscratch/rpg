<?php
class Character {
	
	public function __construct() {
		$this->actions = new Actions();
		$this->stats = new Stats();
		$this->actions->initStatsRef($this->stats);
	}
}

class Stats {

	public $name;
	public $race;
	public $class;
	public $hp;
	public $ac;
	public $str;
	public $inventory;
}
class Hero extends Character {
	
	public function __construct() {
		parent::__construct();
		$this->stats->name = 'Talonic';
		$this->stats->race = 'Half-Elf';
		$this->stats->class = 'Ranger';
		$this->stats->hp = 20;
		$this->stats->ac = 15;
		$this->stats->str = 8;
		$this->stats->inventory = [
			'Melee Weapon' => 'Short Sword',
			'Ranged Weapon' => 'Long Bow',
			'First Aid' => 'Bandages',
			'Ammo' => 'Arrows',
			];
	}

	public function printInventoryList () {
		$inventory = $this->stats->inventory;
		$contents = [];
		foreach ($inventory as $key => $value) {
			$contents[] = "$key - $value \n";
		}
		$backpack = implode($contents);
		$message = "{$this->stats->name}'s Inventory: \n" . $backpack . "\n";
		echo $message . "\n";
	}

	public function characterInfo() {
		echo "Name: {$this->stats->name} \n" . 
				   "Race: {$this->stats->race} \n" . 
				   "Class: {$this->stats->class} \n" .
				   "Hit Points: {$this->stats->hp} \n" . 
				   "Defense: {$this->stats->ac} \n" .
				   "Strength: {$this->stats->str} \n" . "\n";
	}
}
class NPC extends Character {
	
	const NAMES = ['Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar'];
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

class Items {

	const WEAPONS = [
		'Short Sword' => 8,
		'Long Bow' => 10,
		'Arrows' => 0,
	];

	const ARMOR = [
		'Cloth Armor' => 2,
		'Leather Armor' => 4,
		'Chainmail Armon' => 6,
	];

	const POTIONS = [
		'Health' => 6,
		'Attack' => 6,
		'Defense' => 6,
	];

	static function getWeapon($type) {
		if ($type === 'Melee') {
			$weapon = self::WEAPONS['Short Sword'];
		} else if ($type === 'Ranged') {
			$weapon = self::WEAPONS['Long Bow'];
		} else {
			echo "Error: Not a valid entry. Check your spelling!";
		}
		return $weapon;
	}

	static function getPotion($type) {
		if ($type === 'Health') {
			$potion = self::POTIONS['Health'];
		} else if ($type === 'Attack') {
			$potion = self::POTIONS['Attack'];
		} else if ($type === 'Defense') {
			$potion = self::POTIONS['Defense'];
		} else {
			echo "Error: Not a valid entry. Check your spelling!";
		}
		return $potion;
	}
}

class Actions {

	const ATTACK_RESPONSES = [
	'hit' => "You swing and hit %s for %s damage.",
	'crit_hit' => 'You crush your enemy for a lot of damage.',
	'miss' => 'You missed your target.',
	'crit_miss' => 'You miss so bad your weapon laughs at you.',
	];

	const DEFENSE_RESPONSES = [
	'hit' => "%s was hit for %s damage and now has %s hit points left.",
	'miss' => "%s has %s hit points left.",
	'dead' => "%s has been slain by %s.",
	];

	public function initStatsRef(&$stats_ref) {
		$this->stats_ref = $stats_ref;
	}

	public function getStat($stat_string) {
		if ($stat_string === "name") {
			return $this->stats_ref->name;
		} else if ($stat_string === "race") {
			return $this->stats_ref->race;
		} else if ($stat_string === "class") {
			return $this->stats_ref->class;
		} else if ($stat_string === "hp") {
			return $this->stats_ref->hp;
		} else if ($stat_string === "ac") {
			return $this->stats_ref->ac;
		} else if ($stat_string === "str") {
			return $this->stats_ref->str;
		} else if ($stat_string === 'inventory') {
			return $this->stats_ref->inventory;
		} else {
			echo "Error: Not a valid entry. Check your spelling!";
		}
	}

	public function attack($defender) {
		$weapon_damage = rand(1, Items::getWeapon('Melee'));
		$ac_check = $this->getStat("str") + rand(1, 6);
		$defense_ac = $defender->ac;
		$hp_result = $defender->hp - $weapon_damage;
		$attacker_name = "{$this->getStat("name")} the {$this->getStat("class")}";
		$defender_name = "{$defender->name} the {$defender->class}";
		$defender_hp = $defender->hp;

		if ($ac_check > $defense_ac) {
			$result = self::ATTACK_RESPONSES['hit'];
		} else {
			$result = self::ATTACK_RESPONSES['miss'];
		}

		$attack_message = sprintf($result, $defender_name, $weapon_damage);

		if ($result == self::ATTACK_RESPONSES['hit'] ) {
			$defender_text = self::DEFENSE_RESPONSES['hit'];
		} else {
			$defender_text = self::DEFENSE_RESPONSES['miss'];
		}
		
		if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $weapon_damage, $hp_result);
				if ($weapon_damage > $defender_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
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
$attack = $hero->actions->attack($villain);
echo $attack;
