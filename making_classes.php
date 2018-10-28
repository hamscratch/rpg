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
	public $int;
	public $equipped;
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
		$this->stats->int = 8;
		$this->stats->equipped = [
			'Melee Weapon' => '',
			'Ranged Weapon' => '',
			'Armor' => '',
		]; 
		$this->stats->inventory = [
			'Melee Weapon' => 'Short Sword',
			'Ranged Weapon' => 'Long Bow',
			'Ammo' => 0,
			'Potions' => [
				'health' => ['name' => 'Health Potion', 'quantity' => 1],
				'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
				'defense' => ['name' => 'Defense Potion', 'quantity' => 1]
			]
		];
	}

	public function printInventoryList () {
		$inventory = $this->stats->inventory;
		$contents = [];
		foreach ($inventory as $key => $value) {
			$contents[] = "$key - $value \n";
		}
		$backpack = implode($contents);
		$message = "{$this->stats->name}'s Inventory: \n" . $backpack;
		echo $message . "\n";
	}

	public function characterInfo() {
		echo "Name: {$this->stats->name} \n" . 
				   "Race: {$this->stats->race} \n" . 
				   "Class: {$this->stats->class} \n" .
				   "Hit Points: {$this->actions->getStat('hp')} \n" . 
				   "Defense: {$this->stats->ac} \n" .
				   "Strength: {$this->stats->str} \n" .
				   "Intelligence: {$this->stats->int} \n" . "\n"; 
	}
}
class NPC extends Character {
	
	const NAMES = ['Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar'];
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
		$this->stats->inventory = [
			'Melee Weapon' => 'Short Sword',
			'Ranged Weapon' => 'Long Bow',
			'Ammo' => 0,
			'Potions' => [
				'health' => ['name' => 'Health Potion', 'quantity' => 0],
				'attack' => ['name' => 'Attack Potion', 'quantity' => 0],
				'defense' => ['name' => 'Defense Potion', 'quantity' => 0]
			]
		];
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
		echo "Name: {$this->stats->name} \n" . 
				   "Race: {$this->stats->race} \n" . 
				   "Class: {$this->stats->class} \n" .
				   "Hit Points: {$this->stats->hp} \n" . 
				   "Defense: {$this->stats->ac} \n" .
				   "Strength: {$this->stats->str} \n" . "\n";
	}
}

class Items {

	const WEAPONS = [
		'short_sword' => [
			'name' => 'Short Sword',
			'damage' => 8,
			'description' => "This is a short sword."
		], 
		'long_bow' => [
			'name' => 'Long Bow',
			'damage' => 10,
			'description' => "This is a Long Bow."
		],
		'arrows' => [
			'name' => 'Iron Arrow(s)',
			'quantity' => 0,
			'description' => "This is an iron arrowhead on a wooden shaft with feather fins."
		],
	];

	const ARMOR = [
		'cloth' => [
			'name' => 'Cloth Armor',
			'armor' => 2,
			'description' => "This is cloth armor. Offers light protection. You also look poor in it"
		],
		'leather' => [
			'name' => 'Leather Armor',
			'armor' => 4,
			'description' => "This is leather armor. Offers medium protection."
		], 
		'chainmail' => [
			'name' => "Chainmail Armor",
			'armor' => 6,
			'description' => "This is chainmail armor. Offers heavy protection."
		],
	];

	const POTIONS = [
		'health' => [
			'name' => "Health Potion",
			'amount' => 10,
			'description' => "A vial of red liquid that will restore 10 hitpoints."
		],
		'attack' => [
			'name' => "Attack Potion",
			'amount' => 5,
			'description' => "A vial of yellow liquid that will boost strength by 5 for a turn."
		],
		'defense' => [
			'name' => "Defense Potion",
			'amount' => 5,
			'description' => "A vial of green liquid that will boost your armor by 5 for a turn."
		],
	];

	const SPELLS = [
		'fireball' => [
			'name' => "Fireball",
			'amount' => 6,
			'description' => "A ball of fire. Duh."
		],
		'heal_wounds' => [
			'name' => "Heal Wounds",
			'amount' => 10,
			'description' => "Weaving light to restore some health."
		],
		'magic_armor' => [
			'name' => "Magic Armor",
			'amount' => 5,
			'description' => "Mystical runes surround the caster and boost their armor."
		],
	];

	static function getWeapon($type) {
		if ($type === 'Melee') {
			$weapon = self::WEAPONS['short_sword'];
		} else if ($type === 'Ranged') {
			$weapon = self::WEAPONS['long_bow'];
		} else {
			echo "Error: Not a valid entry for getWeapon. Check your spelling!";
		}
		return $weapon;
	}

	static function getArmor($type) {
		if ($type === 'cloth') {
			$armor = self::ARMOR['cloth'];
		} else if ($type === 'leather') {
			$armor = self::ARMOR['leather'];
		} else if ($type === 'chainmail') {
			$armor = self::ARMOR['chainmail'];
		} else {
			echo "Error: Not a valid entry for getArmor. Check your spelling!";
		}
		return $armor;
	}

	static function getPotion($type) {
		if ($type === 'Health') {
			$potion = self::POTIONS['health'];
		} else if ($type === 'Attack') {
			$potion = self::POTIONS['attack'];
		} else if ($type === 'Defense') {
			$potion = self::POTIONS['defense'];
		} else {
			echo "Error: Not a valid entry for getPotion. Check your spelling!";
		}
		return $potion;
	}

	static function getSpell($type) {
		if ($type === 'fireball') {
			$spell = self::SPELLS['fireball'];
		} else if ($type === 'heal_wounds') {
			$spell = self::SPELLS['heal_wounds'];
		} else if ($type === 'magic_armor') {
			$spell = self::SPELLS['magic_armor'];
		} else {
			echo "Error: Not a valid entry for getSpell. Check your spelling!";
		}
		return $spell;
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
	'hit' => "%s was hit for %s damage and now has %s hit points left."  . "\n",
	'miss' => "%s has %s hit points left."  . "\n",
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
		} else if ($stat_string === "int") {
			return $this->stats_ref->int;
		} else if ($stat_string === 'inventory') {
			return $this->stats_ref->inventory;
		} else {
			echo "Error: Not a valid entry for getStat. Check your spelling!";
		}
	}

	public function setStat($stat_string, $updated_stat) {
		if ($stat_string === "name") {
			$this->stats_ref->name = $updated_stat;
		} else if ($stat_string === "race") {
			$this->stats_ref->race = $updated_stat;
		} else if ($stat_string === "class") {
			$this->stats_ref->class = $updated_stat;
		} else if ($stat_string === "hp") {
			$this->stats_ref->hp = $updated_stat;
		} else if ($stat_string === "ac") {
			$this->stats_ref->ac = $updated_stat;
		} else if ($stat_string === "str") {
			$this->stats_ref->str = $updated_stat;
		}	else if ($stat_string === "int") {
			$this->stats_ref->int = $updated_stat;
		} else if ($stat_string === "potions: health") {
			$this->stats_ref->inventory['Potions']['health']['quantity'] = $updated_stat;
		} else if ($stat_string === "potions: attack") {
			$this->stats_ref->inventory['Potions']['attack']['quantity'] = $updated_stat;
		} else if ($stat_string === "potions: defense") {
			$this->stats_ref->inventory['Potions']['defense']['quantity'] = $updated_stat;
		} else {
			echo "Error: Not a valid entry for setStat. Check your spelling!";
		}
	}

	public function getItemInfo($type) {

		if ($type === "Melee") {
			$name = Items::getWeapon('Melee');

			echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n" . "\n";
		} else if ($type === "Ranged") {
			$name = Items::getWeapon('Ranged');

			echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n" . "\n";
		}
	}

	public function attack($defender) {
		$weapon = Items::getWeapon('Melee');
		$weapon_damage = rand(1, $weapon['damage']);
		$ac_check = $this->getStat("str") + rand(1, 6);
		$defense_ac = $defender->actions->getStat('ac');
		$defender_hp = $defender->actions->getStat('hp');
		$hp_result = $defender_hp - $weapon_damage;
		$attacker_name = "{$this->getStat("name")} the {$this->getStat("class")}";
		$defender_name = "{$defender->stats->name} the {$defender->stats->class}";
		

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
			$defender->actions->setStat('hp', $hp_result);
				if ($weapon_damage > $defender_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
				}
		}
		if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
		}
		
		return $attack_message . "\n" . $d_text . "\n";
	}

	public function defend() {
		$defend_roll = rand(1, 6);
		$new_ac = $this->getStat('ac') + $defend_roll;
		$this->setStat('ac', $new_ac); 

		echo "{$this->getStat('name')} gets into a defesive stance. {$this->getStat('name')}'s defense has been boosted by {$defend_roll} and is now {$new_ac}\n" . "\n";
	}

	public function usePotion($type) {
		$potion = $this->getStat("inventory")["Potions"][$type];
		$quantity = $potion['quantity'];
		$hero_hp = $this->getStat('hp');
		$hero_str = $this->getStat('str');
		$hero_ac = $this->getStat('ac');
		$hero_name = "{$this->getStat("name")} the {$this->getStat("class")}";
		
		if ($potion['name'] === 'Health Potion') {
			if ($quantity >= 1) {
				$update = Items::getPotion('Health');
				$hero_hp += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat('hp', $hero_hp);
				$this->setStat('potions: health', $new_quantity);
				echo "{$hero_name} drank a health potion.\n{$hero_name} now has {$hero_hp} hit points! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any health potions in their inventory." . "\n";
			}
		} else if ($potion['name'] === 'Attack Potion') {
			if ($quantity >= 1) {
				$update = Items::getPotion('Attack');
				$hero_str += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat('str', $hero_str);
				$this->setStat('potions: attack', $new_quantity);
				echo "{$hero_name} drank an attack potion.\n{$hero_name} now has {$hero_str} strength! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any attack potions in their inventory." . "\n";
			}
		} else if ($potion['name'] === 'Defense Potion') {
			if ($quantity >= 1) {
				$update = Items::getPotion('Defense');
				$hero_ac += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat('ac', $hero_ac);
				$this->setStat('potions: defense', $new_quantity);
				echo "{$hero_name} drank a defense potion.\n{$hero_name} now has {$hero_ac} defense! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any defense potions in their inventory." . "\n";
			}
		} else {
			echo "Error: Not a valid entry for usePotion. Check your spelling!";
		}
	}

	public function castSpell($type, $target) {
		$spell = Items::getSpell($type);
		$hero_name = "{$this->getStat("name")} the {$this->getStat("class")}"; 
		$hero_hp = $this->getStat('hp');
		$hero_ac = $this->getStat('ac');
		$hero_int = $this->getStat('int');
		$target_name = "{$target->stats->name} the {$target->stats->class}";
		$target_hp = $target->actions->getStat('hp');
		$target_int = $target->actions->getStat('int');

		$int_check = $this->getStat("int") + rand(1, 6);



		if ($spell['name'] === "fireball") {
			$damage = rand(1, $spell['amount']);
		} else if ($spell['name'] === "heal_wounds") {
			$boost = $spell['amount'];
			$hero_hp += $boost;
			$this->setStat('hp', $hero_hp);
			echo "{$hero_name} weaves bright light together and heals {$boost} hit points. \n{$hero_name} now has {$hero_hp} hit points!";
		} else if ($spell['name'] === "magic_armor") {
			$boost = $spell['amount'];
			$hero_ac += $boost;
			$this->setStat('ac', $hero_ac);
			echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_ac} defense!";
		} else {
			echo "Error: Not a valid entry for castSpell. Check your spelling!";
		}
	}	

}

$hero = new Hero;
$villain = new NPC;
$hero->characterInfo();
$hero->printInventoryList();
$villain->characterInfo();
$attack = $hero->actions->attack($villain);
echo $attack;
echo "Potions left: " . $hero->stats->inventory['Potions']['health']['quantity'] . "\n";
$hero->actions->usePotion('health');
$hero->actions->usePotion('attack');
$hero->actions->usePotion('defense');
$hero->actions->defend();
$villain->actions->usePotion('health');
$hero->characterInfo();
$villain->characterInfo();
$hero->actions->getItemInfo('Melee');
echo "Potions left: " .  $hero->stats->inventory['Potions']['health']['quantity'] . "\n";
$hero->characterInfo();
