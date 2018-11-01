<?php

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
		switch ($stat_string) {
			case Stats::NAME:
				return $this->stats_ref->name;
			
			case Stats::RACE:
				return $this->stats_ref->race;

			case Stats::CLASS_NAME:
				return $this->stats_ref->class;

			case Stats::HP:
				return $this->stats_ref->hp;

			case Stats::HP_MAX:
				return $this->stats_ref->hp_max;

			case Stats::AC:
				return $this->stats_ref->ac;

			case Stats::AC_BONUS_ITEMS:
				return $this->stats_ref->ac_bonus_items;

			case Stats::AC_BONUS_EFFECTS:
				return $this->stats_ref->ac_bonus_effects;

			case Stats::STR:
				return $this->stats_ref->str;

			case Stats::STR_BONUS_ITEMS:
				return $this->stats_ref->str_bonus_items;

			case Stats::STR_BONUS_EFFECTS:
				return $this->stats_ref->str_bonus_effects;

			case Stats::DEX:
				return $this->stats_ref->dex;

			case Stats::DEX_BONUS_ITEMS:
				return $this->stats_ref->dex_bonus_items;

			case Stats::DEX_BONUS_EFFECTS:
				return $this->stats_ref->dex_bonus_effects;

			case Stats::INT:
				return $this->stats_ref->int;

			case Stats::INT_BONUS_ITEMS:
				return $this->stats_ref->int_bonus_items;

			case Stats::INT_BONUS_EFFECTS:
				return $this->stats_ref->int_bonus_effects;

			case Stats::EQUIPPED_MELEE:
				return $this->stats_ref->equipped['Melee Weapon'];

			case Stats::EQUIPPED_RANGED:
				return $this->stats_ref->equipped['Ranged Weapon'];

			case Stats::EQUIPPED_ARMOR:
				return $this->stats_ref->equipped['Armor'];

			case Stats::BACKPACK:
				return $this->stats_ref->backpack;

			case Stats::BACKPACK_MELEE:
				return $this->stats_ref->backpack['Melee Weapon'];

			case Stats::BACKPACK_RANGED:
				return $this->stats_ref->backpack['Ranged Weapon'];

			case Stats::BACKPACK_ARMOR:
				return $this->stats_ref->backpack['Armor'];

			case Stats::BACKPACK_ARROWS:
				return $this->stats_ref->backpack['Arrows'];

			case Stats::POTION_HEAL:
				return $this->stats_ref->potion_bag['Potions']['health']['quantity'];

			case Stats::POTION_ATK:
				return $this->stats_ref->potion_bag['Potions']['attack']['quantity'];

			case Stats::POTION_DEF:
				return $this->stats_ref->potion_bag['Potions']['defense']['quantity'];

			case Stats::POTION_INT:
				return $this->stats_ref->potion_bag['Potions']['intelligence']['quantity'];

			case Stats::POTION_DEX:
				return $this->stats_ref->potion_bag['Potions']['dexterity']['quantity'];

			case Stats::CLASS_DESCRIPTION:
				return $this->stats_ref->class_description;
			default:
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
		$armor_ac = Items::getArmor($type);
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


/* Island of misfit code
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
		} else if ($stat_string === Stats::CLASS_DESCRIPTION) {
			return $this->stats_ref->class_description;
		} else {
			echo "Error: '{$stat_string}' is not a valid entry for getStat. Check your spelling!" . "\n";
		}
*/