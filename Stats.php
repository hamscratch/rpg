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

	private $name;
	private $race;
	private $class;
	private $hp_base;
	private $hp_temp;
	private $hp_total;
	private $hp_max;
	private $ac_base;
	private $ac_temp;
	private $ac_total;
	private $ac_bonus_items;
	private $ac_bonus_effects;
	private $str_base;
	private $str_temp;
	private $str_total;
	private $str_bonus_items;
	private $str_bonus_effects;
	private $dex_base;
	private $dex_temp;
	private $dex_total;
	private $dex_bonus_items;
	private $dex_bonus_effects;
	private $int_base;
	private $int_temp;
	private $int_total;
	private $int_bonus_items;
	private $int_bonus_effects;
	private $equipped;
	private $backpack;
	private $potion_bag;
	private $class_description;

	public function getStat($stat_string) {
		return $this->$stat_string;
	}

	public function setStat($stat_string, $updated_stat) {
		$this->$stat_string = $updated_stat;
	}

	public function updateTotalStats() {
		$hp = $this->hp_base + $this->hp_temp;
		$ac = $this->ac_base + $this->ac_temp;
		$str = $this->str_base + $this->str_temp;
		$dex = $this->dex_base + $this->dex_temp;
		$int = $this->int_base + $this->int_temp;

		$this->setStat(self::HP_TOTAL, $hp);
		$this->setStat(self::AC_TOTAL, $ac);
		$this->setStat(self::STR_TOTAL, $str);
		$this->setStat(self::DEX_TOTAL, $dex);
		$this->setStat(self::INT_TOTAL, $int);
	}
}
