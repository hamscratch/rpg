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

	public function getStat($stat_string) {
		return $this->$stat_string;
	}

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

	public function setHeroClassStats(string $class_name, $target) {
		$target->stats->setStat(Stats::CLASS_NAME, Hero::CLASSES[$class_name][Stats::CLASS_NAME]);
		$target->stats->setStat(Stats::HP_BASE, Hero::CLASSES[$class_name][Stats::HP_BASE]);
		$target->stats->setStat(Stats::HP_TEMP, Hero::CLASSES[$class_name][Stats::HP_TEMP]);
		$target->stats->setStat(Stats::HP_TOTAL, Hero::CLASSES[$class_name][Stats::HP_TOTAL]);
		$target->stats->setStat(Stats::HP_MAX, Hero::CLASSES[$class_name][Stats::HP_MAX]);
		$target->stats->setStat(Stats::AC_BASE, Hero::CLASSES[$class_name][Stats::AC_BASE]);
		$target->stats->setStat(Stats::AC_TEMP, Hero::CLASSES[$class_name][Stats::AC_TEMP]);
		$target->stats->setStat(Stats::AC_TOTAL, Hero::CLASSES[$class_name][Stats::AC_TOTAL]);
		$target->stats->setStat(Stats::AC_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::AC_BONUS_ITEMS]);
		$target->stats->setStat(Stats::AC_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::AC_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::STR_BASE, Hero::CLASSES[$class_name][Stats::STR_BASE]);
		$target->stats->setStat(Stats::STR_TEMP, Hero::CLASSES[$class_name][Stats::STR_TEMP]);
		$target->stats->setStat(Stats::STR_TOTAL, Hero::CLASSES[$class_name][Stats::STR_TOTAL]);
		$target->stats->setStat(Stats::STR_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::STR_BONUS_ITEMS]);
		$target->stats->setStat(Stats::STR_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::STR_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::DEX_BASE, Hero::CLASSES[$class_name][Stats::DEX_BASE]);
		$target->stats->setStat(Stats::DEX_TEMP, Hero::CLASSES[$class_name][Stats::DEX_TEMP]);
		$target->stats->setStat(Stats::DEX_TOTAL, Hero::CLASSES[$class_name][Stats::DEX_TOTAL]);
		$target->stats->setStat(Stats::DEX_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::DEX_BONUS_ITEMS]);
		$target->stats->setStat(Stats::DEX_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::DEX_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::INT_BASE, Hero::CLASSES[$class_name][Stats::INT_BASE]);
		$target->stats->setStat(Stats::INT_TEMP, Hero::CLASSES[$class_name][Stats::INT_TEMP]);
		$target->stats->setStat(Stats::INT_TOTAL, Hero::CLASSES[$class_name][Stats::INT_TOTAL]);
		$target->stats->setStat(Stats::INT_BONUS_ITEMS, Hero::CLASSES[$class_name][Stats::INT_BONUS_ITEMS]);
		$target->stats->setStat(Stats::INT_BONUS_EFFECTS, Hero::CLASSES[$class_name][Stats::INT_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::EQUIPPED, Hero::CLASSES[$class_name][Stats::EQUIPPED]);
		$target->stats->setStat(Stats::BACKPACK, Hero::CLASSES[$class_name][Stats::BACKPACK]);
		$target->stats->setStat(Stats::POTION_BAG, Hero::CLASSES[$class_name][Stats::POTION_BAG]);
		$target->stats->setStat(Stats::CLASS_DESCRIPTION, Hero::CLASSES[$class_name][Stats::CLASS_DESCRIPTION]);

		$target->stats->updateTotalStats();
	}

	public function setNPCClassStats(string $class_name, $target) {
		$target->stats->setStat(Stats::CLASS_NAME, NPC::CLASSES[$class_name][Stats::CLASS_NAME]);
		$target->stats->setStat(Stats::HP_BASE, NPC::CLASSES[$class_name][Stats::HP_BASE]);
		$target->stats->setStat(Stats::HP_TEMP, NPC::CLASSES[$class_name][Stats::HP_TEMP]);
		$target->stats->setStat(Stats::HP_TOTAL, NPC::CLASSES[$class_name][Stats::HP_TOTAL]);
		$target->stats->setStat(Stats::HP_MAX, NPC::CLASSES[$class_name][Stats::HP_MAX]);
		$target->stats->setStat(Stats::AC_BASE, NPC::CLASSES[$class_name][Stats::AC_BASE]);
		$target->stats->setStat(Stats::AC_TEMP, NPC::CLASSES[$class_name][Stats::AC_TEMP]);
		$target->stats->setStat(Stats::AC_TOTAL, NPC::CLASSES[$class_name][Stats::AC_TOTAL]);
		$target->stats->setStat(Stats::AC_BONUS_ITEMS, NPC::CLASSES[$class_name][Stats::AC_BONUS_ITEMS]);
		$target->stats->setStat(Stats::AC_BONUS_EFFECTS, NPC::CLASSES[$class_name][Stats::AC_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::STR_BASE, NPC::CLASSES[$class_name][Stats::STR_BASE]);
		$target->stats->setStat(Stats::STR_TEMP, NPC::CLASSES[$class_name][Stats::STR_TEMP]);
		$target->stats->setStat(Stats::STR_TOTAL, NPC::CLASSES[$class_name][Stats::STR_TOTAL]);
		$target->stats->setStat(Stats::STR_BONUS_ITEMS, NPC::CLASSES[$class_name][Stats::STR_BONUS_ITEMS]);
		$target->stats->setStat(Stats::STR_BONUS_EFFECTS, NPC::CLASSES[$class_name][Stats::STR_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::DEX_BASE, NPC::CLASSES[$class_name][Stats::DEX_BASE]);
		$target->stats->setStat(Stats::DEX_TEMP, NPC::CLASSES[$class_name][Stats::DEX_TEMP]);
		$target->stats->setStat(Stats::DEX_TOTAL, NPC::CLASSES[$class_name][Stats::DEX_TOTAL]);
		$target->stats->setStat(Stats::DEX_BONUS_ITEMS, NPC::CLASSES[$class_name][Stats::DEX_BONUS_ITEMS]);
		$target->stats->setStat(Stats::DEX_BONUS_EFFECTS, NPC::CLASSES[$class_name][Stats::DEX_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::INT_BASE, NPC::CLASSES[$class_name][Stats::INT_BASE]);
		$target->stats->setStat(Stats::INT_TEMP, NPC::CLASSES[$class_name][Stats::INT_TEMP]);
		$target->stats->setStat(Stats::INT_TOTAL, NPC::CLASSES[$class_name][Stats::INT_TOTAL]);
		$target->stats->setStat(Stats::INT_BONUS_ITEMS, NPC::CLASSES[$class_name][Stats::INT_BONUS_ITEMS]);
		$target->stats->setStat(Stats::INT_BONUS_EFFECTS, NPC::CLASSES[$class_name][Stats::INT_BONUS_EFFECTS]);
		$target->stats->setStat(Stats::EQUIPPED, NPC::CLASSES[$class_name][Stats::EQUIPPED]);
		$target->stats->setStat(Stats::BACKPACK, NPC::CLASSES[$class_name][Stats::BACKPACK]);
		$target->stats->setStat(Stats::POTION_BAG, NPC::CLASSES[$class_name][Stats::POTION_BAG]);
		$target->stats->setStat(Stats::CLASS_DESCRIPTION, NPC::CLASSES[$class_name][Stats::CLASS_DESCRIPTION]);

		$target->stats->updateTotalStats();
	}
}
