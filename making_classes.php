<?php
class Character {
	
	public function __construct() {
		$this->actions = new Actions();
		$this->stats = new Stats();
		$this->actions->initStatsRef($this->stats);
	}
}

class Stats {

	const NAME = 'name';
	const RACE = 'race';
	const CLASS_NAME = 'class';
	const HP = 'hp';
	const HP_MAX = 'hp_max';

	const AC = 'ac';
	const AC_BONUS_ITEMS = 'ac_bonus_items';
	const AC_BONUS_EFFECTS = 'ac_bonus_effects';

	const STR = 'str';
	const STR_BONUS_ITEMS = 'str_bonus_items';
	const STR_BONUS_EFFECTS = 'str_bonus_effects';

	const DEX = 'dex';
	const DEX_BONUS_ITEMS = 'dex_bonus_items';
	const DEX_BONUS_EFFECTS = 'dex_bonus_effects';

	const INT = 'int';
	const INT_BONUS_ITEMS = 'int_bonus_items';
	const INT_BONUS_EFFECTS = 'int_bonus_effects';


	const EQUIPPED = 'equipped';
	const EQUIPPED_MELEE = 'equipped_melee';
	const EQUIPPED_RANGED = 'equipped_ranged';
	const EQUIPPED_ARMOR = 'equipped_armor';

	const BACKPACK = 'backpack';
	const BACKPACK_MELEE = 'backpack_melee';
	const BACKPACK_RANGED = 'backpack_ranged';
	const BACKPACK_ARMOR = 'backpack_armor';
	const BACKPACK_ARROWS = 'backpack_arrows';

	const POTION_BAG = 'potion_bag';
	const POTION_HEAL = 'potion_heal';
	const POTION_ATK = 'potion_atk';
	const POTION_DEF = 'potion_def';
	const POTION_INT = 'potion_int';
	const POTION_DEX = 'potion_dex';

	const CLASS_DESCRIPTION = 'class_description';

	public $name;
	public $race;
	public $class;


	public $hp;
	public $hp_max;

	public $ac;
	public $ac_bonus_items;
	public $ac_bonus_effects;


	public $str;
	public $str_bonus_items;
	public $str_bonus_effects;

	public $dex;
	public $dex_bonus_items;
	public $dex_bonus_effects;

	public $int;
	public $int_bonus_items;
	public $int_bonus_effects;

	public $equipped;
	public $backpack;
	public $potion_bag;
	public $class_description;
}
class Hero extends Character {
	// this is just placeholder for now, but id like to have the user choose their class and have them populate 
	// the stats. might need a function to do this. not sure yet. should also update to the consts stat names.
	// (10/30)
	const RACES = [
		'Elf',
		'Half - Elf',
		'Human',
		'Halfling', 
		'Half-Orc',
		'Dwarf',
		'Gnome',
	];

	const WARRIOR = [
		'class' => 'Warrior',
		'hp' => 30,
		'ac' => 15,
		'str' => 10,
		'dex' => 8,
		'int' => 5,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
	];

	const WIZARD = [
		'class' => 'Wizard',
		'hp' => 20,
		'ac' => 10,
		'str' => 5,
		'dex' => 8,
		'int' => 10,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the gilded halls for Qeynos, the wizard blasts its enemies with magic spells."
	];

	const RANGER = [
		'class' => 'Ranger',
		'hp' => 25,
		'ac' => 15,
		'str' => 8,
		'dex' => 10,
		'int' => 5,
		'equipped' => [],
		'backpack' => [],
		'potion_bag' => [],
		'description' => "Hailing from the sprawling forests of Misty Vale, the ranger beats its enemies with ranged weapons."
	];

	public function __construct() {
		parent::__construct();
		$this->stats->name = 'Talonic';
		$this->stats->race = 'Half-Elf';
		$this->stats->class = 'Ranger';
		$this->stats->hp = 20;
		$this->stats->hp_max = 20;

		$this->stats->ac = 15;
		$this->stats->ac_bonus_items = 0;
		$this->stats->ac_bonus_effects = 0;

		$this->stats->str = 8;
		$this->stats->str_bonus_items = 0;
		$this->stats->str_bonus_items = 0;

		$this->stats->dex = 8;
		$this->stats->dex_bonus_items = 0;
		$this->stats->dex_bonus_items = 0;

		$this->stats->int = 8;
		$this->stats->int_bonus_items = 0;
		$this->stats->int_bonus_items = 0;

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
				   "Hit Points: {$this->actions->getStat('hp')} \n" . 
				   "Defense: {$this->actions->getStat('ac')} \n" .
				   "Strength: {$this->actions->getStat('str')} \n" .
				   "Dexterity: {$this->actions->getStat('dex')} \n" .
				   "Intelligence: {$this->actions->getStat('int')} \n" . "\n"; 
	}
}

// might want to borrow from the class picker. either way this section also needs TLC. i think i want most nps
// to be general named stuff like "a dirty orc" instead of names. Save those for BOSS FIGHTS!!! also think it
// might be good to add a 'loot' statd to npcs that way when you kill them you get something. (10/30)
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

// thinking of a nice fat array of room coordinates with unviersal stuff for each room. examples: 'description',
// 'npcs', 'loot', etc (10/30)
class RoomMaker {

}

// MORE ITEMZZZZ. seriously i want to add a bunch more but i know that can be done later. need to focus on a 
// better inventory system. need to think about this (10/30)
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
			'description' => "This is cloth armor. Offers light protection. You also look poor in it",
			'magic' => false,
		],
		'leather' => [
			'name' => 'Leather Armor',
			'armor' => 4,
			'description' => "This is leather armor. Offers medium protection.",
			'magic' => false,
		], 
		'chainmail' => [
			'name' => "Chainmail Armor",
			'armor' => 6,
			'description' => "This is chainmail armor. Offers heavy protection.",
			'magic' => false,
		],
		'elven' => [
			'name' => "Elven Armor",
			'armor' => 8,
			'description' => "Runes shimmer along this gilded armor. Magic energy courses through this armor. Offers heavy protection as well as protection from magic attacks.",
			'magic' => true,
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
		'dexterity' => [
			'name' => "Dexterity Potion",
			'amount' => 5,
			'description' => "A vial of violet swirling liquid that will boost your dexterity for a turn."
		],
	];

	const SPELLS = [
		'fireball' => [
			'name' => "Fireball",
			'amount' => 8,
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
		'quicken' => [
			'name' => "Quicken",
			'amount' => 5,
			'description' => "Magic courses through your veins as your feel yourself get quicker."
		],
		'enrage' => [
			'name' => "Enrage",
			'amount' => 5,
			'description' => "Magic courses through your veins as your feel yourself get stronger."
		],
	];

	static function getWeapon($type) {
		if ($type === 'Melee') {
			$weapon = self::WEAPONS['short_sword'];
		} else if ($type === 'Ranged') {
			$weapon = self::WEAPONS['long_bow'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getWeapon. Check your spelling!" . "\n";
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
			echo "Error: '{$type}' is not a valid entry for getArmor. Check your spelling!" . "\n";
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
		} else if ($type === 'Intelligence') {
			$potion = self::POTIONS['intelligence']; 
		} else if ($type === 'Dexterity') {
			$potion = self::POTIONS['dexterity'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getPotion. Check your spelling!" . "\n";
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
		} else if ($type ==='quicken') {
			$spell = self::SPELLS['quicken'];
		} else if ($type === 'enrage') {
			$spell = self::SPELLS['enrage'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getSpell. Check your spelling!" . "\n";
		}
		return $spell;
	}
}

// lot of work for this whole thing. (10/30)
class Actions {

	// all of these responses need to be cleaned up. they're a fucking mess (10/30)
	const MELEE_ATTACK_RESPONSES = [
	'hit' => "You swing and hit %s for %s damage."  . "\n",
	'crit_hit' => 'You crush your enemy for a lot of damage.'  . "\n",
	'miss' => 'You missed your target.',
	'crit_miss' => 'You miss so bad your weapon laughs at you.'  . "\n",
	];

	const RANGED_ATTACK_RESPONSES = [
	'hit' => "You swing and hit %s for %s damage."  . "\n",
	'crit_hit' => 'You crush your enemy for a lot of damage.'  . "\n",
	'miss' => 'You missed your target.',
	'crit_miss' => 'You miss so bad your weapon laughs at you.'  . "\n",
	];

	const SPELL_ATTACK_RESPONSES = [
	'fireball' => "%s was blasted with a fireball by %s for %s damage" . "\n",
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

	public function initStatsRef(&$stats_ref) {
		$this->stats_ref = $stats_ref;
	}

	public function getStat($stat_string) {
		if ($stat_string === Stats::NAME) {
			return $this->stats_ref->name;
		} else if ($stat_string === Stats::RACE) {
			return $this->stats_ref->race;
		} else if ($stat_string === Stats::CLASS_NAME) {
			return $this->stats_ref->class;
		} else if ($stat_string === Stats::HP) {
			return $this->stats_ref->hp;
		} else if ($stat_string === Stats::HP_MAX) {
			return $this->stats_ref->hp_max;
		} else if ($stat_string === Stats::AC) {
			return $this->stats_ref->ac;
		} else if ($stat_string === Stats::AC_BONUS_ITEMS) {
			return $this->stats_ref->ac_bonus_items;
		} else if ($stat_string === Stats::AC_BONUS_EFFECTS) {
			return $this->stats_ref->ac_bonus_effects;
		} else if ($stat_string === Stats::STR) {
			return $this->stats_ref->str;
		} else if ($stat_string === Stats::STR_BONUS_ITEMS) {
			return $this->stats_ref->str_bonus_items;
		} else if ($stat_string === Stats::STR_BONUS_EFFECTS) {
			return $this->stats_ref->str_bonus_effects;
		} else if ($stat_string === Stats::DEX) {
			return $this->stats_ref->dex;
		} else if ($stat_string === Stats::DEX_BONUS_ITEMS) {
			return $this->stats_ref->dex_bonus_items;
		} else if ($stat_string === Stats::DEX_BONUS_EFFECTS) {
			return $this->stats_ref->dex_bonus_effects;
		} else if ($stat_string === Stats::INT) {
			return $this->stats_ref->int;
		} else if ($stat_string === Stats::INT_BONUS_ITEMS) {
			return $this->stats_ref->int_bonus_items;
		} else if ($stat_string === Stats::INT_BONUS_EFFECTS) {
			return $this->stats_ref->int_bonus_effects;
		} else if ($stat_string === Stats::EQUIPPED_MELEE) {
			return $this->stats_ref->equipped['Melee Weapon'];
		} else if ($stat_string === Stats::EQUIPPED_RANGED) {
			return $this->stats_ref->equipped['Ranged Weapon'];
		} else if ($stat_string === Stats::EQUIPPED_ARMOR) {
			return $this->stats_ref->equipped['Armor'];
		} else if ($stat_string === Stats::BACKPACK) {
			return $this->stats_ref->backpack;
		} else if ($stat_string === Stats::BACKPACK_MELEE) {
			return $this->stats_ref->backpack['Melee Weapon'];
		} else if ($stat_string === Stats::BACKPACK_RANGED) {
			return $this->stats_ref->backpack['Ranged Weapon'];
		} else if ($stat_string === Stats::BACKPACK_ARMOR) {
			return $this->stats_ref->backpack['Armor'];
		} else if ($stat_string === Stats::BACKPACK_ARROWS) {
			return $this->stats_ref->backpack['Arrows'];
		} else if ($stat_string === Stats::POTION_HEAL) {
			return $this->stats_ref->potion_bag['Potions']['health']['quantity'];
		} else if ($stat_string === Stats::POTION_ATK) {
			return $this->stats_ref->potion_bag['Potions']['attack']['quantity'];
		} else if ($stat_string === Stats::POTION_DEF) {
			return $this->stats_ref->potion_bag['Potions']['defense']['quantity'];
		} else if ($stat_string === Stats::POTION_INT) {
			return $this->stats_ref->potion_bag['Potions']['intelligence']['quantity'];
		} else if ($stat_string === Stats::POTION_DEX) {
			return $this->stats_ref->potion_bag['Potions']['dexterity']['quantity'];
		} else if ($stat_string === CLASS_DESCRIPTION) {
			return $this->stats_ref->class_description;
		} else {
			echo "Error: '{$stat_string}' is not a valid entry for getStat. Check your spelling!" . "\n";
		}
	}

	public function setStat($stat_string, $updated_stat) {
		if ($stat_string === Stats::NAME) {
			$this->stats_ref->name = $updated_stat;
		} else if ($stat_string === Stats::RACE) {
			$this->stats_ref->race = $updated_stat;
		} else if ($stat_string === Stats::CLASS_NAME) {
			$this->stats_ref->class = $updated_stat;
		} else if ($stat_string === Stats::HP) {
			$this->stats_ref->hp = $updated_stat;
		} else if ($stat_string === Stats::HP_MAX) {
			$this->stats_ref->hp_max = $updated_stat;
		}	else if ($stat_string === Stats::AC) {
			$this->stats_ref->ac = $updated_stat;
		} else if ($stat_string === Stats::AC_BONUS_ITEMS) {
			$this->stats_ref->ac_bonus_items = $updated_stat;
		} else if ($stat_string === Stats::AC_BONUS_EFFECTS) {
			$this->stats_ref->ac_bonus_effects = $updated_stat;
		} else if ($stat_string === Stats::STR) {
			$this->stats_ref->str = $updated_stat;
		} else if ($stat_string === Stats::STR_BONUS_ITEMS) {
			$this->stats_ref->str_bonus_items = $updated_stat;
		} else if ($stat_string === Stats::STR_BONUS_EFFECTS) {
			$this->stats_ref->str_bonus_effects = $updated_stat;
		} else if ($stat_string === Stats::DEX) {
			$this->stats_ref->dex = $updated_stat;
		} else if ($stat_string === Stats::DEX_BONUS_ITEMS) {
			$this->stats_ref->dex_bonus_items = $updated_stat;
		} else if ($stat_string === Stats::DEX_BONUS_EFFECTS) {
			$this->stats_ref->dex_bonus_effects = $updated_stat;
		} else if ($stat_string === Stats::INT) {
			$this->stats_ref->int = $updated_stat;
		} else if ($stat_string === Stats::INT_BONUS_ITEMS) {
			$this->stats_ref->int_bonus_items = $updated_stat;
		} else if ($stat_string === Stats::INT_BONUS_EFFECTS) {
			$this->stats_ref->int_bonus_effects = $updated_stat;
		} else if ($stat_string === Stats::EQUIPPED_MELEE) {
			$this->stats_ref->equipped['Melee Weapon'] = $updated_stat;
		} else if ($stat_string === Stats::EQUIPPED_RANGED) {
			$this->stats_ref->equipped['Ranged Weapon'] = $updated_stat;
		} else if ($stat_string === Stats::EQUIPPED_ARMOR) {
			$this->stats_ref->equipped['Armor'] = $updated_stat;
		} else if ($stat_string === Stats::BACKPACK_MELEE) {
			$this->stats_ref->backpack['Melee Weapon'] = $updated_stat;
		} else if ($stat_string === Stats::BACKPACK_RANGED) {
			$this->stats_ref->backpack['Ranged Weapon'] = $updated_stat;
		} else if ($stat_string === Stats::BACKPACK_ARMOR) {
			$this->stats_ref->backpack['Armor'] = $updated_stat;
		} else if ($stat_string === Stats::BACKPACK_ARROWS) {
			$this->stats_ref->backpack['Arrows'] = $updated_stat;
		} else if ($stat_string === Stats::POTION_HEAL) {
			$this->stats_ref->potion_bag['Potions']['health']['quantity'] = $updated_stat;
		} else if ($stat_string === Stats::POTION_ATK) {
			$this->stats_ref->potion_bag['Potions']['attack']['quantity'] = $updated_stat;
		} else if ($stat_string === Stats::POTION_DEF) {
			$this->stats_ref->potion_bag['Potions']['defense']['quantity'] = $updated_stat;
		} else if ($stat_string === Stats::POTION_INT) {
			$this->stats_ref->potion_bag['Potions']['intelligence']['quantity'] = $updated_stat; 
		} else if ($stat_string === Stats::POTION_DEX) {
			$this->stats_ref->potion_bag['Potions']['dexterity']['quantity'] = $updated_stat; 
		} else {
			echo "Error: '{$stat_string}' is not a valid entry for setStat. Check your spelling!" . "\n";
		}
	}

	public function isDead($target) {
		$is_dead = false;
		$hp = $target->actions->getStat(Stats::HP);

		if ($hp <= 0) {
			$is_dead = true;
		} else {
			echo "Error: '{$target}' is not a valid entry for isDead. Check your spelling!" . "\n";
		}

		return $is_dead;
	}

	// mow that i have temp stats, figure out a way to add to those stats when equipping an item (10/30)
	public function equip($type, $item_name) {
		
		$backpack = $this->getStat(Stats::BACKPACK);
		$armor_ac = Itmes::getArmor($type);

		if ($type === Stats::EQUIPPED_MELEE) {
			if ($item_name === $backpack['Melee Weapon']) {
				$this->setStat($type, $item_name);
				$this->setStat(Stats::BACKPACK_MELEE, '');
			} else {
				echo "You do no have {$item_name} in your backpack";
			}
		} else if ($type === Stats::EQUIPPED_RANGED) {
			if ($item_name === $backpack['Ranged Weapon']) {
				$this->setStat($type, $item_name);
				$this->setStat(Stats::BACKPACK_RANGED, '');
			} else {
				echo "You do no have {$item_name} in your backpack";
			}
		} else if ($type === Stats::EQUIPPED_ARMOR) {
			if ($item_name === $backpack['Armor']) {
				$armor_ac = Itmes::getArmor($type);

				$this->setStat($type, $item_name);
				$this->setStat(Stats::AC_BONUS_ITEMS, $armor_ac['armor']);
				$this->setStat(Stats::BACKPACK_ARMOR, '');
			} else {
				echo "You do no have {$item_name} in your backpack";
			}
		} else {
			echo "Error: '{$type}' is not a valid entry for equip. Check your spelling!" . "\n";
		}
	} 

	// this one is a mess. haven't touched it in a while but will be valuable. might want to merge this in with
	// a general inspector action. maybe not (10/30)
	public function getItemInfo($type) {

		if ($type === "Melee") {
			$name = Items::getWeapon('Melee');

			echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n" . "\n";
		} else if ($type === "Ranged") {
			$name = Items::getWeapon('Ranged');

			echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n" . "\n";
		}
	}

	// need to factor in magic weapon check. prob want to add a check at the top of the function if the weapon is
	// magic or not. same thing goes for the $defender. plop an if statement above it and we're gravy (10/30)
	public function meleeAttack($defender) {
		$weapon = Items::getWeapon('Melee');
		$weapon_damage = rand(1, $weapon['damage']);
		$ac_check = $this->getStat(Stats::STR) + rand(1, 6);
		$defense_ac = $defender->actions->getStat(Stats::AC);
		$defender_hp = $defender->actions->getStat(Stats::HP);
		$hp_result = $defender_hp - $weapon_damage;
		$attacker_name = "{$this->getStat(Stats::NAME)} the {$this->getStat(Stats::CLASS_NAME)}";
		$defender_name = "{$defender->actions->getStat(Stats::NAME)} the {$defender->actions->getStat(Stats::CLASS_NAME)}";
		

		if ($ac_check > $defense_ac) {
			$result = self::MELEE_ATTACK_RESPONSES['hit'];
		} else {
			$result = self::MELEE_ATTACK_RESPONSES['miss'];
		}

		$attack_message = sprintf($result, $defender_name, $weapon_damage);

		if ($result == self::MELEE_ATTACK_RESPONSES['hit'] ) {
			$defender_text = self::DEFENSE_RESPONSES['hit'];
		} else {
			$defender_text = self::DEFENSE_RESPONSES['miss'];
		}
		
		if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $weapon_damage, $hp_result);
			$defender->actions->setStat(Stats::HP, $hp_result);
				if ($weapon_damage > $defender_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
				}
		}
		if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
		}
		
		return $attack_message . "\n" . $d_text . "\n";
	}

	// like melee, i'll need to check to see if im using magic arrows. add if statement if the $defender is magic
	// (10/30)
	public function rangedAttack($defender) {
		$weapon = Items::getWeapon('Ranged');
		$ammo = $this->getStat(Stats::BACKPACK_ARROWS);
		$weapon_damage = rand(1, $weapon['damage']);
		$dex_check = $this->getStat(Stats::DEX) + rand(1, 6);
		$defense_dex = $defender->actions->getStat(Stats::DEX);
		$defender_hp = $defender->actions->getStat(Stats::HP);
		$hp_result = $defender_hp - $weapon_damage;
		$attacker_name = "{$this->getStat(Stats::NAME)} the {$this->getStat(Stats::CLASS_NAME)}";
		$defender_name = "{$defender->actions->getStat(Stats::NAME)} the {$defender->actions->getStat(Stats::CLASS_NAME)}";
		
		if ($ammo >= 1) {

			if ($dex_check > $defense_dex) {
				$result = self::RANGED_ATTACK_RESPONSES['hit'];
			} else {
				$result = self::RANGED_ATTACK_RESPONSES['miss'];
			}

			$attack_message = sprintf($result, $defender_name, $weapon_damage);

			if ($result == self::RANGED_ATTACK_RESPONSES['hit'] ) {
				$defender_text = self::DEFENSE_RESPONSES['hit'];
				$new_ammo = ($ammo - 1);
				$this->setStat(Stats::BACKPACK_ARROWS, $new_ammo);
			} else {
				$defender_text = self::DEFENSE_RESPONSES['miss'];
			}
			
			if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $weapon_damage, $hp_result);
				$defender->actions->setStat(Stats::HP, $hp_result);
					if ($weapon_damage > $defender_hp) {
							$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
					}
			}
			if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
			}
			
			return $attack_message . "\n" . $d_text . "\n";
		} else {
			echo "You do not have any arrows left. Try something else." . "\n";
		}	
	}

	// lol. no idea if this is still something i want or not. i guess it'd be useful if you know you're going to
	// get stomped on next round. fuck, just realized i made new stats but not a "temp" stat. fuck me. (10/30)
	public function defend() {
		$defend_roll = rand(1, 6);
		$new_ac = $this->getStat(Stats::AC) + $defend_roll;
		$this->setStat(Stats::AC, $new_ac); 

		echo "{$this->getStat(Stats::NAME)} gets into a defesive stance. {$this->getStat(Stats::NAME)}'s defense has been boosted by {$defend_roll} and is now {$new_ac}\n" . "\n";
	}

	// not sure what needs work on here. pretty sure i refactored everything with new consts. will need to do a 
	// once over. (10/30)
	public function usePotion($type) {
		$quantity = $this->getStat($type);
		$hero_hp = $this->getStat(Stats::HP);
		$hero_str = $this->getStat(Stats::STR);
		$hero_ac = $this->getStat(Stats::AC);
		$hero_int = $this->getStat(Stats::INT);
		$hero_dex = $this->getStat(Stats::DEX);
		$hero_name = "{$this->getStat(Stats::NAME)} the {$this->getStat(Stats::CLASS_NAME)}";
		
		if ($type === Stats::POTION_HEAL) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Health');
				$hero_hp += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat(Stats::HP, $hero_hp);
				$this->setStat(Stats::POTION_HEAL, $new_quantity);
				echo "{$hero_name} drank a health potion.\n{$hero_name} now has {$hero_hp} hit points! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any health potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_ATK) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Attack');
				$hero_str += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat(Stats::STR, $hero_str);
				$this->setStat(Stats::POTION_ATK, $new_quantity);
				echo "{$hero_name} drank an attack potion.\n{$hero_name} now has {$hero_str} strength! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any attack potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_DEF) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Defense');
				$hero_ac += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat(Stats::AC, $hero_ac);
				$this->setStat(Stats::POTION_DEF, $new_quantity);
				echo "{$hero_name} drank a defense potion.\n{$hero_name} now has {$hero_ac} defense! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any defense potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_INT) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Intelligence');
				$hero_int += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat(Stats::INT, $hero_int);
				$this->setStat(Stats::POTION_INT, $new_quantity);
				echo "{$hero_name} drank an intelligence potion.\n{$hero_name} now has {$hero_int} intelligence! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any intelligence potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_DEX) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Dexterity');
				$hero_dex += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->setStat(Stats::DEX, $hero_dex);
				$this->setStat(Stats::POTION_DEX, $new_quantity);
				echo "{$hero_name} drank a dexterity potion.\n{$hero_name} now has {$hero_dex} dexterity! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any dexterity potions in their inventory." . "\n";
			}
		} else {
			echo "Error: '{$type}' is not a valid entry for usePotion. Check your spelling!" . "\n";
		}
	}

	// this needs general TLC and logic checks. always resistsing adding new spells. (10/30)
	public function castSpell($type, $target) {
		$spell = Items::getSpell($type);
		$hero_name = "{$this->getStat(Stats::NAME)} the {$this->getStat(Stats::CLASS_NAME)}"; 
		$hero_hp = $this->getStat(Stats::HP);
		$hero_ac = $this->getStat(Stats::AC);
		$hero_int = $this->getStat(Stats::INT);
		$hero_str = $this->getStat(Stats::STR);
		$hero_dex = $this->getStat(Stats::DEX);
		$target_name = "{$target->actions->getStat(Stats::NAME)} the {$target->actions->getStat(Stats::CLASS_NAME)}";
		$target_hp = $target->actions->getStat(Stats::HP);
		$target_int = $target->actions->getStat(Stats::INT);

		$int_check = $this->getStat(Stats::INT) + rand(1, 6);

		if ($spell['name'] === "Fireball") {
			$damage = rand(3, $spell['amount']);
			$hp_result = $target->actions->getStat(Stats::HP) - $damage;

			if ($int_check > $target_int) {
				$result = self::SPELL_ATTACK_RESPONSES['fireball'];
				$attack_message = sprintf(self::SPELL_ATTACK_RESPONSES['fireball'], $target_name, $hero_name, $damage);
			} else {
				$result = self::SPELL_ATTACK_RESPONSES['miss'];
				$attack_message = sprintf(self::SPELL_ATTACK_RESPONSES['miss'], $target_name);
			}

			if ($result == self::SPELL_ATTACK_RESPONSES['fireball'] ) {
				$defender_text = self::DEFENSE_RESPONSES['hit'];
			} else {
				$defender_text = self::DEFENSE_RESPONSES['miss'];
			}
				
			if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $target_name, $damage, $hp_result);
				$target->actions->setStat(Stats::HP, $hp_result);
					if ($damage > $target_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $target_name, $hero_name);
					}
			}
			if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $target_name, $target_hp);
			}

			echo $attack_message . "\n" . $d_text . "\n";

		} else if ($spell['name'] === "Heal Wounds") {
			$boost = $spell['amount'];
			$hero_hp += $boost;
			$this->setStat(Stats::HP, $hero_hp);
			echo "{$hero_name} weaves bright light together and heals {$boost} hit points. \n{$hero_name} now has {$hero_hp} hit points!";
		} else if ($spell['name'] === "Magic Armor") {
			$boost = $spell['amount'];
			$hero_ac += $boost;
			$this->setStat(Stats::AC, $hero_ac);
			echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_ac} defense!";
		} else if ($spell['name'] === "Quicken") {
			$boost = $spell['amount'];
			$hero_dex += $boost;
			$this->setStat(Stats::DEX, $hero_dex);
			echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_dex} dexterity!";
		} else if ($spell['name'] === "Enrage") {
			$boost = $spell['amount'];
			$hero_str += $boost;
			$this->setStat(Stats::STR, $hero_str);
			echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_str} strength!";
		} else {
			echo "Error: '{$type}' is not a valid entry for castSpell. Check your spelling!" . "\n";
		}
	}	

}

$hero = new Hero;
$villain = new NPC;
$hero->characterInfo();
$hero->printInventoryList();
$villain->characterInfo();
$melee_attack = $hero->actions->meleeAttack($villain);
echo $melee_attack;
$ranged_attack = $hero->actions->rangedAttack($villain);
echo $ranged_attack;
echo "Potions left: " . $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->actions->usePotion(Stats::POTION_HEAL);
$hero->actions->defend();
$villain->actions->usePotion(Stats::POTION_HEAL);
$hero->characterInfo();
$villain->characterInfo();
$hero->actions->getItemInfo('Melee');
echo "Potions left: " .  $hero->stats->potion_bag['Potions']['health']['quantity'] . "\n";
$hero->characterInfo();
$hero->actions->castSpell('fireball', $villain);
$hero->actions->usePotion(Stats::POTION_DEX);
$hero->characterInfo();
$hero->printInventoryList();
$hero->actions->equip('equipped_melee', 'Short Sword');
var_dump($hero->stats->equipped);
var_dump($hero->stats->backpack);
$hero->printInventoryList();
