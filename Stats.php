<?php

class Stats {
	const NAME = 'name';
	const RACE = 'race';
	const CLASS_NAME = 'class';
	const HP_BASE = 'hp_base';
	const HP_TEMP = 'hp_temp';
	const HP_TOTAL = 'hp_total';	
	const HP_MAX = 'hp_max';
	const AC_BASE = 'ac_base';
	const AC_TEMP = 'ac_temp';
	const AC_TOTAL = 'ac_total';
	const AC_BONUS_ITEMS = 'ac_bonus_items';
	const AC_BONUS_EFFECTS = 'ac_bonus_effects';
	const STR_BASE = 'str_base';
	const STR_TEMP = 'str_temp';
	const STR_TOTAL = 'str_total';
	const STR_BONUS_ITEMS = 'str_bonus_items';
	const STR_BONUS_EFFECTS = 'str_bonus_effects';
	const DEX_BASE = 'dex_base';
	const DEX_TEMP = 'dex_temp';
	const DEX_TOTAL = 'dex_total';
	const DEX_BONUS_ITEMS = 'dex_bonus_items';
	const DEX_BONUS_EFFECTS = 'dex_bonus_effects';
	const INT_BASE = 'int_base';
	const INT_TEMP = 'int_temp';
	const INT_TOTAL = 'int_total';
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
	public $hp_base;
	public $hp_temp;
	public $hp_total;
	public $hp_max;
	public $ac_base;
	public $ac_temp;
	public $ac_total;
	public $ac_bonus_items;
	public $ac_bonus_effects;
	public $str_base;
	public $str_temp;
	public $str_total;
	public $str_bonus_items;
	public $str_bonus_effects;
	public $dex_base;
	public $dex_temp;
	public $dex_total;
	public $dex_bonus_items;
	public $dex_bonus_effects;
	public $int_base;
	public $int_temp;
	public $int_total;
	public $int_bonus_items;
	public $int_bonus_effects;
	public $equipped;
	public $backpack;
	public $potion_bag;
	public $class_description;

	/** Gets the stat from the given argument.
	* 
	* @param string $stat_string - use the constants above
	*
	* @return mixed - will return whatever stat you give it 
	*/
	public function getStat($stat_string) {
		return $this->$stat_string;
	}

	/** Sets a new value of a stat.
	* 
	* @param string $stat_string - use the constants above
	*
	* @param mixed $updated_stat - the new value you want to set the stat to
	*
	* @return mixed - will update the given stat with the new value 
	*/
	public function setStat($stat_string, $updated_stat) {
		$this->$stat_string = $updated_stat;
	}

	public function updateTotalStats() {
		$hp = $this->hp_base + $this->hp_temp;
		$ac = $this->ac_base + $this->ac_temp + $this->ac_bonus_items + $this->ac_bonus_effects;
		$str = $this->str_base + $this->str_temp + $this->str_bonus_items + $this->str_bonus_effects;
		$dex = $this->dex_base + $this->dex_temp + $this->dex_bonus_items + $this->dex_bonus_effects;
		$int = $this->int_base + $this->int_temp + $this->int_bonus_items + $this->int_bonus_effects;

		$this->setStat(self::HP_TOTAL, $hp);
		$this->setStat(self::AC_TOTAL, $ac);
		$this->setStat(self::STR_TOTAL, $str);
		$this->setStat(self::DEX_TOTAL, $dex);
		$this->setStat(self::INT_TOTAL, $int);
	}

	/** Sets all initial stats
	* 
	* @param string $character - Right now, it's either 'Hero' or 'NPC'. will eventually assign some constants
	* @param string $class_name - This string will be used to index into the specific class listed in the $character's array of classes.
	* @return mixed - Set all the stats of the given class as well as update all the bonus stats values to the total values.
	*/
	public function setClassStats(string $character, string $class_name) {
		$this->setStat(self::CLASS_NAME, $character::CLASSES[$class_name][Stats::CLASS_NAME]);
		$this->setStat(self::HP_BASE, $character::CLASSES[$class_name][Stats::HP_BASE]);
		$this->setStat(self::HP_TEMP, $character::CLASSES[$class_name][Stats::HP_TEMP]);
		$this->setStat(self::HP_TOTAL, $character::CLASSES[$class_name][Stats::HP_TOTAL]);
		$this->setStat(self::HP_MAX, $character::CLASSES[$class_name][Stats::HP_MAX]);
		$this->setStat(self::AC_BASE, $character::CLASSES[$class_name][Stats::AC_BASE]);
		$this->setStat(self::AC_TEMP, $character::CLASSES[$class_name][Stats::AC_TEMP]);
		$this->setStat(self::AC_TOTAL, $character::CLASSES[$class_name][Stats::AC_TOTAL]);
		$this->setStat(self::AC_BONUS_ITEMS, $character::CLASSES[$class_name][Stats::AC_BONUS_ITEMS]);
		$this->setStat(self::AC_BONUS_EFFECTS, $character::CLASSES[$class_name][Stats::AC_BONUS_EFFECTS]);
		$this->setStat(self::STR_BASE, $character::CLASSES[$class_name][Stats::STR_BASE]);
		$this->setStat(self::STR_TEMP, $character::CLASSES[$class_name][Stats::STR_TEMP]);
		$this->setStat(self::STR_TOTAL, $character::CLASSES[$class_name][Stats::STR_TOTAL]);
		$this->setStat(self::STR_BONUS_ITEMS, $character::CLASSES[$class_name][Stats::STR_BONUS_ITEMS]);
		$this->setStat(self::STR_BONUS_EFFECTS, $character::CLASSES[$class_name][Stats::STR_BONUS_EFFECTS]);
		$this->setStat(self::DEX_BASE, $character::CLASSES[$class_name][Stats::DEX_BASE]);
		$this->setStat(self::DEX_TEMP, $character::CLASSES[$class_name][Stats::DEX_TEMP]);
		$this->setStat(self::DEX_TOTAL, $character::CLASSES[$class_name][Stats::DEX_TOTAL]);
		$this->setStat(self::DEX_BONUS_ITEMS, $character::CLASSES[$class_name][Stats::DEX_BONUS_ITEMS]);
		$this->setStat(self::DEX_BONUS_EFFECTS, $character::CLASSES[$class_name][Stats::DEX_BONUS_EFFECTS]);
		$this->setStat(self::INT_BASE, $character::CLASSES[$class_name][Stats::INT_BASE]);
		$this->setStat(self::INT_TEMP, $character::CLASSES[$class_name][Stats::INT_TEMP]);
		$this->setStat(self::INT_TOTAL, $character::CLASSES[$class_name][Stats::INT_TOTAL]);
		$this->setStat(self::INT_BONUS_ITEMS, $character::CLASSES[$class_name][Stats::INT_BONUS_ITEMS]);
		$this->setStat(self::INT_BONUS_EFFECTS, $character::CLASSES[$class_name][Stats::INT_BONUS_EFFECTS]);
		$this->setStat(self::EQUIPPED, $character::CLASSES[$class_name][Stats::EQUIPPED]);
		$this->setStat(self::BACKPACK, $character::CLASSES[$class_name][Stats::BACKPACK]);
		$this->setStat(self::POTION_BAG, $character::CLASSES[$class_name][Stats::POTION_BAG]);
		$this->setStat(self::CLASS_DESCRIPTION, $character::CLASSES[$class_name][Stats::CLASS_DESCRIPTION]);

		$this->updateTotalStats();
	}

}
