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
	public $dex;
	public $int;
	public $equipped;
	public $backpack;
	public $potion_bag;
}
class Hero extends Character {
	
	const WARRIOR = [
		'class' => 'Warrior',
		'hp' => 30,
		'ac' => 15,
		'str' => 8,
		'dex' => 8,
		'int' => 8,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
	];

	const WIZARD = [
		'class' => 'Wizard',
		'hp' => 30,
		'ac' => 15,
		'str' => 8,
		'dex' => 8,
		'int' => 8,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
	];

	const RANGER = [
		'class' => 'Ranger',
		'hp' => 30,
		'ac' => 15,
		'str' => 8,
		'dex' => 8,
		'int' => 8,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
	];

	public function __construct() {
		parent::__construct();
		$this->stats->name = 'Talonic';
		$this->stats->race = 'Half-Elf';
		$this->stats->class = 'Ranger';
		$this->stats->hp = 20;
		$this->stats->ac = 15;
		$this->stats->str = 8;
		$this->stats->dex = 8;
		$this->stats->int = 8;
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
		$this->stats->potion_bag = [
			'Potions' => [
				'health' => ['name' => 'Health Potion', 'quantity' => 1],
				'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
				'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
				'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1]
			]
		];
	}

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
		echo "<<<Character Stats>>>" . "\n" . 	
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
				'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 0]
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

class RoomMaker {

}

class Items {

	const WEAPONS = [
		'short_sword' => [
			'name' => 'Short Sword',
			'damage' => 8,
			'description' => "This is a short sword.",
			'magic' => false,
		], 
		'long_bow' => [
			'name' => 'Long Bow',
			'damage' => 10,
			'description' => "This is a Long Bow.",
			'magic' => false,
		],
		'arrows' => [
			'name' => 'Iron Arrow(s)',
			'quantity' => 0,
			'description' => "This is an iron arrowhead on a wooden shaft with feather fins.",
			'magic' => false,
		],
		'silver_short_sword' => [
			'name' => 'Silver Short Sword',
			'damage' => 10,
			'description' => "Runes shimmer along the blade, giving a dim glow. Magic energy courses through this weapon.",
			'magic' => true,
		],
		'magic_arrows' => [
			'name' => 'Magic Arrow(s)',
			'quantity' => 0,
			'description' => "Runes shiummer along the arrow tip, giving a dim glow. Magic energy courses through this weapon.",
			'magic' => true,
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
		'intelligence' => [
			'name' => "Intelligence Potion",
			'amount' => 5,
			'description' => "A vial of grey swirling liquid that will boost your intelligence for a turn."
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
		'dispell' => [
			'name' => "Dispell",
			'amount' => -5,
			'description' => "Removes enchancements from an opponent."
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
		} else if ($type === 'dispell') {
			$spell = self::SPELLS['dispell'];
		} else {
			echo "Error: Not a valid entry for getSpell. Check your spelling!";
		}
		return $spell;
	}
}

class Actions {

	const ATTACK_RESPONSES = [
	'hit' => "You swing and hit %s for %s damage."  . "\n",
	'crit_hit' => 'You crush your enemy for a lot of damage.'  . "\n",
	'miss' => 'You missed your target.',
	'crit_miss' => 'You miss so bad your weapon laughs at you.'  . "\n",
	];

	const DEFENSE_RESPONSES = [
	'hit' => "%s was hit for %s damage and now has %s hit points left."  . "\n",
	'miss' => "%s has %s hit points left."  . "\n",
	'dead' => "%s has been slain by %s."  . "\n",
	];

	const SPELL_RESPONSE = [
	'fireball' => "%s was blasted with a fireball by %s for %s damage" . "\n",
	'miss' => "You miss %s"  . "\n"
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
		} else if ($stat_string === "dex") {
			return $this->stats_ref->dex;
		} else if ($stat_string === "int") {
			return $this->stats_ref->int;
		} else if ($stat_string === 'backpack') {
			return $this->stats_ref->backpack;
		} else if ($stat_string === 'backpack: arrows') {
			return $this->stats_ref->backpack['Arrows'];
		} else if ($stat_string === 'potions: health') {
			return $this->stats_ref->potion_bag['Potions']['health']['quantity'];
		} else if ($stat_string === 'potions: attack') {
			return $this->stats_ref->potion_bag['Potions']['attack']['quantity'];
		} else if ($stat_string === 'potions: defense') {
			return $this->stats_ref->potion_bag['Potions']['defense']['quantity'];
		} else if ($stat_string === 'potions: intelligence') {
			return $this->stats_ref->potion_bag['Potions']['intelligence']['quantity'];
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
		} else if ($stat_string === "dex") {
			$this->stats_ref->dex = $updated_stat;
		} else if ($stat_string === "int") {
			$this->stats_ref->int = $updated_stat;
		} else if ($stat_string === 'backpack: arrows') {
			$this->stats_ref->backpack['Arrows'] = $updated_stat;
		} else if ($stat_string === "potions: health") {
			$this->stats_ref->potion_bag['Potions']['health']['quantity'] = $updated_stat;
		} else if ($stat_string === "potions: attack") {
			$this->stats_ref->potion_bag['Potions']['attack']['quantity'] = $updated_stat;
		} else if ($stat_string === "potions: defense") {
			$this->stats_ref->potion_bag['Potions']['defense']['quantity'] = $updated_stat;
		} else if ($stat_string === "potions: intelligence") {
			$this->stats_ref->potion_bag['Potions']['intelligence']['quantity'] = $updated_stat; 
		} else {
			echo "Error: Not a valid entry for setStat. Check your spelling!";
		}
	}

	public function isDead($target) {
		$is_dead = false;
		$hp = $target->actions->getStat('hp');

		if ($hp <= 0) {
			$is_dead = true;
		} else if ($hp >= 1) {
			$is_dead = false;
		} else {
			echo "Error: Not a valid entry for isDead. Check your spelling!";
		}

		return $is_dead;
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
		$potion = "potions: {$type}";
		$potion_name = $type;
		$quantity = $this->getStat($potion);
		$hero_hp = $this->getStat('hp');
		$hero_str = $this->getStat('str');
		$hero_ac = $this->getStat('ac');
		$hero_name = "{$this->getStat("name")} the {$this->getStat("class")}";
		
		if ($potion_name === 'health') {
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
		} else if ($potion_name === 'attack') {
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
		} else if ($potion_name === 'defense') {
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
		$target_name = "{$target->actions->getStat('name')} the {$target->actions->getStat('class')}";
		$target_hp = $target->actions->getStat('hp');
		$target_int = $target->actions->getStat('int');

		$int_check = $this->getStat("int") + rand(1, 6);

		if ($spell['name'] === "Fireball") {
			$damage = rand(1, $spell['amount']);
			$hp_result = $target->actions->getStat('hp') - $damage;

			if ($int_check > $target_int) {
				$result = self::SPELL_RESPONSE['fireball'];
				$attack_message = sprintf(self::SPELL_RESPONSE['fireball'], $target_name, $hero_name, $damage);
			} else {
				$result = self::SPELL_RESPONSE['miss'];
				$attack_message = sprintf(self::SPELL_RESPONSE['miss'], $target_name);
			}

			if ($result == self::SPELL_RESPONSE['fireball'] ) {
				$defender_text = self::DEFENSE_RESPONSES['hit'];
			} else {
				$defender_text = self::DEFENSE_RESPONSES['miss'];
			}
				
			if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $target_name, $damage, $hp_result);
				$target->actions->setStat('hp', $hp_result);
					if ($damage > $target_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $target_name, $hero_name);
					}
			}
			if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $target_name, $target_hp);
			}

			echo $attack_message . "\n" . $d_text . "\n";

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
echo "Potions left: " . $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->actions->usePotion('health');
$hero->actions->defend();
$villain->actions->usePotion('health');
$hero->characterInfo();
$villain->characterInfo();
$hero->actions->getItemInfo('Melee');
echo "Potions left: " .  $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->characterInfo();
$hero->actions->castSpell('fireball', $villain);
$hero->printInventoryList();

