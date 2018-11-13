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

	const ACTIONS = [
		'Melee' => '',
		'Run' => '',
	];
	
	public function initStatsRef(&$stats_ref) {
		$this->stats_ref = $stats_ref;
	}


	// mow that i have temp stats, figure out a way to add to those stats when equipping an item (10/30)
	public function equip($type, $item_name) {
		
		$backpack = $this->stats->getStat(Stats::BACKPACK);
		$armor_ac = Items::getArmor($type);
		if ($type === Stats::EQUIPPED_MELEE) {
			if ($item_name === $backpack['Melee Weapon']) {
				$this->stats->setStat($type, $item_name);
				$this->stats->setStat(Stats::BACKPACK_MELEE, '');
			} else {
				echo "You do no have {$item_name} in your backpack";
			}
		} else if ($type === Stats::EQUIPPED_RANGED) {
			if ($item_name === $backpack['Ranged Weapon']) {
				$this->stats->setStat($type, $item_name);
				$this->stats->setStat(Stats::BACKPACK_RANGED, '');
			} else {
				echo "You do no have {$item_name} in your backpack";
			}
		} else if ($type === Stats::EQUIPPED_ARMOR) {
			if ($item_name === $backpack['Armor']) {
				$armor_ac = Itmes::getArmor($type);
				$this->stats->setStat($type, $item_name);
				$this->stats->setStat(Stats::AC_BONUS_ITEMS, $armor_ac['armor']);
				$this->stats->setStat(Stats::BACKPACK_ARMOR, '');
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
		$ac_check = $this->stats_ref->getStat(Stats::STR_TOTAL) + rand(1, 6);
		$defense_ac = $defender->stats->getStat(Stats::AC_TOTAL);
		$defender_hp = $defender->stats->getStat(Stats::HP_TOTAL);
		$hp_result = $defender_hp - $weapon_damage;
		$attacker_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
		$defender_name = "{$defender->stats->getStat(Stats::NAME)} the {$defender->stats->getStat(Stats::CLASS_NAME)}";
		
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
			$defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
				if ($weapon_damage > $defender_hp) {
						$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
				}
		}
		if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
			$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
		}
		
		echo "{$attack_message}" . "\n" . "{$d_text}" . "\n";
	}
	// like melee, i'll need to check to see if im using magic arrows. add if statement if the $defender is magic
	// (10/30)
	public function rangedAttack($defender) {
		$weapon = Items::getWeapon('Ranged');
		$backpack = $this->stats_ref->getStat(Stats::BACKPACK);
		$ammo = $backpack['Arrows'];
		$weapon_damage = rand(1, $weapon['damage']);
		$dex_check = $this->stats_ref->getStat(Stats::DEX_TOTAL) + rand(1, 6);
		$defense_dex = $defender->stats->getStat(Stats::DEX_TOTAL);
		$defender_hp = $defender->stats->getStat(Stats::HP_TOTAL);
		$hp_result = $defender_hp - $weapon_damage;
		$attacker_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
		$defender_name = "{$defender->stats->getStat(Stats::NAME)} the {$defender->stats->getStat(Stats::CLASS_NAME)}";
		
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
				$this->stats_ref->setArrowQuantity($new_ammo);
			} else {
				$defender_text = self::DEFENSE_RESPONSES['miss'];
			}
			
			if ($defender_text == self::DEFENSE_RESPONSES['hit']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $weapon_damage, $hp_result);
				$defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
					if ($weapon_damage > $defender_hp) {
							$d_text = sprintf(self::DEFENSE_RESPONSES['dead'], $defender_name, $attacker_name);
					}
			}
			if ($defender_text == self::DEFENSE_RESPONSES['miss']) {
				$d_text = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);
			}
			
			echo "{$attack_message}" . "\n" . "{$d_text}" . "\n";
		} else {
			echo "You do not have any arrows left. Try something else." . "\n";
		}	
	}

	// lol. no idea if this is still something i want or not. i guess it'd be useful if you know you're going to
	// get stomped on next round. fuck, just realized i made new stats but not a "temp" stat. fuck me. (10/30)
	public function defend() {
		$defend_roll = rand(3, 6);
		$new_ac = $this->stats_ref->getStat(Stats::AC_TEMP) + $defend_roll;
		$this->stats_ref->setStat(Stats::AC_TEMP, $new_ac); 
		$boosted_ac = $new_ac + $this->stats_ref->getStat(Stats::AC_TOTAL);

		echo "{$this->stats_ref->getStat(Stats::NAME)} gets into a defesive stance." . "\n" . "{$this->stats_ref->getStat(Stats::NAME)}'s defense has been boosted by {$defend_roll} and is now {$boosted_ac}\n" . "\n";
	}

	// not sure what needs work on here. pretty sure i refactored everything with new consts. will need to do a 
	// once over. (10/30)
	public function usePotion($type) {
		$quantity = $this->stats_ref->potion_bag['Potions'][$type]['quantity'];
		$hero_hp = $this->stats_ref->getStat(Stats::HP_TOTAL);
		$hero_str = $this->stats_ref->getStat(Stats::STR_BONUS_EFFECTS);
		$hero_ac = $this->stats_ref->getStat(Stats::AC_BONUS_EFFECTS);
		$hero_int = $this->stats_ref->getStat(Stats::INT_BONUS_EFFECTS);
		$hero_dex = $this->stats_ref->getStat(Stats::DEX_BONUS_EFFECTS);
		$hero_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
		
		if ($type === Stats::POTION_HEAL) {
			if ($quantity >= 1) {
				$update = Items::getPotion(Stats::POTION_HEAL);
				$hero_hp += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->stats_ref->setStat(Stats::HP_TOTAL, $hero_hp);
				$this->stats_ref->setPotionQuantity(Stats::POTION_HEAL, $new_quantity);
				echo "{$hero_name} drank a health potion.\n{$hero_name} now has {$hero_hp} hit points! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any health potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_ATK) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Attack');
				$hero_str += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->stats_ref->setStat(Stats::STR_BONUS_EFFECTS, $hero_str);
				$this->stats_ref->updateTotalStats();
				$new_str = $this->stats_ref->getStat(tats::STR_TOTAL);
				$this->stats_ref->setPotionQuantity(Stats::POTION_ATK, $new_quantity);
				echo "{$hero_name} drank an attack potion.\n{$hero_name} now has {$new_str} strength! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any attack potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_DEF) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Defense');
				$hero_ac += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->stats_ref->setStat(Stats::AC_BONUS_EFFECTS, $hero_ac);
				$this->stats_ref->updateTotalStats();
				$new_ac = $this->stats_ref->getStat(Stats::AC_TOTAL);
				$this->stats_ref->setPotionQuantity(Stats::POTION_DEF, $new_quantity);
				echo "{$hero_name} drank a defense potion.\n{$hero_name} now has {$new_ac} defense! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any defense potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_INT) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Intelligence');
				$hero_int += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->stats_ref->setStat(Stats::INT_BONUS_EFFECTS, $hero_int);
				$this->stats_ref->updateTotalStats();
				$new_int = $this->stats_ref->getStat(Stats::INT_TOTAL);
				$this->stats_ref->setPotionQuantity(Stats::POTION_INT, $new_quantity);
				echo "{$hero_name} drank an intelligence potion.\n{$hero_name} now has {$new_int} intelligence! \n" . "\n";
			} else {
				echo "{$hero_name} does not have any intelligence potions in their inventory." . "\n";
			}
		} else if ($type === Stats::POTION_DEX) {
			if ($quantity >= 1) {
				$update = Items::getPotion('Dexterity');
				$hero_dex += $update['amount'];
				$new_quantity = ($quantity - 1);
				$this->stats_ref->setStat(Stats::DEX_BONUS_EFFECTS, $hero_dex);
				$this->stats_ref->updateTotalStats();
				$new_dex = $this->stats_ref->getStat(Stats::DEX_TOTAL);
				$this->stats_ref->setPotionQuantity(Stats::POTION_DEX, $new_quantity);
				echo "{$hero_name} drank a dexterity potion.\n{$hero_name} now has {$new_dex} dexterity! \n" . "\n";
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
		$hero_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
		$hero_hp = $this->stats_ref->getStat(Stats::HP_TOTAL);
		$hero_ac = $this->stats_ref->getStat(Stats::AC_TOTAL);
		$hero_int = $this->stats_ref->getStat(Stats::INT_TOTAL);
		$hero_str = $this->stats_ref->getStat(Stats::STR_TOTAL);
		$hero_dex = $this->stats_ref->getStat(Stats::DEX_TOTAL);

		$target_name = "{$target->stats->getStat(Stats::NAME)} the {$target->stats->getStat(Stats::CLASS_NAME)}";
		$target_hp = $target->stats->getStat(Stats::HP_TOTAL);
		$target_int = $target->stats->getStat(Stats::INT_TOTAL);
		$int_check = $this->stats_ref->getStat(Stats::INT_TOTAL) + rand(1, 6);

		switch ($spell['name']) {
			case Items::SPELL_FIREBALL:
				$damage = rand(3, $spell['amount']);
				$hp_result = $target->stats->getStat(Stats::HP_TOTAL) - $damage;
				if ($int_check > $target_int) {
					$result = self::SPELL_ATTACK_RESPONSES['fireball'];
					$attack_message = sprintf(self::SPELL_ATTACK_RESPONSES['fireball'], $target_name, $hero_name, $damage);
				} else {
					$result = self::SPELL_ATTACK_RESPONSES['miss'];
					$attack_message = sprintf(self::SPELL_ATTACK_RESPONSES['miss'], $target_name);
				} if ($result == self::SPELL_ATTACK_RESPONSES['fireball'] ) {
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
				break;
			case Items::SPELL_HEAL_WOUNDS:
				$boost = $spell['amount'];
				$hero_hp += $boost;
				$this->stats_ref->setStat(Stats::HP_TOTAL, $hero_hp);
				echo "{$hero_name} weaves bright light together and heals {$boost} hit points. \n{$hero_name} now has {$hero_hp} hit points!";
				break;
			case Items::SPELL_MAGIC_ARMOR:
				$boost = $spell['amount'];
				$hero_ac += $boost;
				$this->stats_ref->setStat(Stats::AC_BONUS_EFFECTS, $hero_ac);
				echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_ac} defense!";
				break;
			case Items::SPELL_QUICKEN:
				$boost = $spell['amount'];
				$hero_dex += $boost;
				$this->stats_ref->setStat(Stats::DEX_BONUS_EFFECTS, $hero_dex);
				echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_dex} dexterity!";
				break;
			case Items::SPELL_ENRAGE:
				$boost = $spell['amount'];
				$hero_str += $boost;
				$this->stats_ref->setStat(Stats::STR_BONUS_EFFECTS, $hero_str);
				echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_str} strength!";
				break;
			default:
				echo "Error: '{$type}' is not a valid entry for castSpell. Check your spelling!" . "\n";

		}
	}	
}
