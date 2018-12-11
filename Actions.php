<?php

class Actions {
    const MELEE_ATTACK_RESPONSES = [
    'hit' => "%s swings and hits %s for %s damage.\n",
    'magic_message' => "%s is a magical being and cannot be harmed by %s's weapon.\n",
    'crit_hit' => "currently not using.\n",
    'miss' => "%s swung and missed %s.\n",
    ];
    const RANGED_ATTACK_RESPONSES = [
    'hit' => "%s shoots an arrow into %s for %s damage.\n",
    'magic_message' => "%s is a magical being and cannot be harmed by %s's weapon.\n",
    'crit_hit' => 'currently not using',
    'miss' => "%s's arrow soars past %s"  . "\n",
    ];
    const SPELL_ATTACK_RESPONSES = [
    'fireball' => "%s blasts %s with a fireball for %s damage\n",
    'hit' => "You swing and hit %s for %s damage.\n",
    'crit_hit' => "You crush your enemy for a lot of damage.\n",
    'miss' => "%s's fireball flies past %s.\n",
    'crit_miss' => "You miss so bad your weapon laughs at you.\n",
    ];
    const DEFENSE_RESPONSES = [
    'hit' => "%s has %s hit points left.\n",
    'miss' => "%s still has %s hit points left.\n",
    'dead' => "%s has been slain by %s.\n",
    ];
    
    const WEAPONS = 'WEAPONS';
    const ARMOR = 'ARMOR';

    public function initStatsRef(&$stats_ref) {
        $this->stats_ref = $stats_ref;
    }

    public function validItemOption($item, $valid_choices) {
        if (in_array($item, $valid_choices)) {
            return true;
        } else {
            return false;
        }
    }

    // *** UNDER CONSTRUCTION ***
    public function equip($type, $item_name, $valid_choices) {
        $backpack = $this->stats_ref->getStat(Stats::BACKPACK);
        $equipped = $this->stats_ref->getStat(Stats::EQUIPPED);
        $current_item = $this->stats_ref->getEquippedItem($type);
        $valid_option = $this->validItemOption($item_name, Items::$valid_choices);
        $hero_name = $this->stats_ref->getStat(Stats::NAME);
        $is_owned = $this->stats_ref->backpackCheck($item_name);

        if ($is_owned === true) {
            if ($valid_option === true) {
                switch ($type) {
                    case Stats::EQUIPPED_MELEE:
                        $this->stats_ref->setStat($backpack, $current_item);
                        $this->stats_ref->setEquippedItem($item_name);
                        $this->stats_ref->removeFromBackpack($item_name);
                        echo "{$hero_name} has equipped {$item_name}";
                        break;
                    case Stats::EQUIPPED_RANGED:
                        $this->stats_ref->setStat($backpack, $current_item);
                        $this->stats_ref->setEquippedItem($item_name);
                        $this->stats_ref->removeFromBackpack($item_name);
                        echo "{$hero_name} has equipped {$item_name}";
                        break;
                    case Stats::EQUIPPED_ARMOR:
                        $this->stats_ref->setStat($backpack, $current_item);
                        $this->stats_ref->setEquippedItem($item_name);
                        $this->stats_ref->removeFromBackpack($item_name);
                        $armor = Items::getArmor($item_name);
                        $armor_bonus = $armor['armor'];
                        $this->stats_ref->setStat(Stats::AC_BONUS_ITEMS, $armor_bonus);
                        $this->stats_ref->updateTotalStats();
                        echo "{$hero_name} has equipped {$item_name}";
                        break;
                    case Stats::EQUIPPED_ARROWS:
                        $this->stats_ref->setStat($backpack, $current_item);
                        $this->stats_ref->setEquippedItem($item_name);
                        $this->stats_ref->removeFromBackpack($item_name);
                        echo "{$hero_name} has equipped {$item_name}";
                        break;
                }
            } else {
                echo "'{$item_name}' cannot not be equipped in that slot. Please try a different slot.\n";
            }
        } else {
            echo "You do not have '{$item_name}' in your backpack.\n";
        }     
    } 

    public function showInventory() {
        $equipped = $this->stats_ref->getStat(Stats::EQUIPPED);
        $backpack = $this->stats_ref->getStat(Stats::BACKPACK);
        $potion_bag = $this->stats_ref->potion_bag['Potions'];
        $hero_name = $this->stats_ref->getStat(Stats::NAME);

        foreach ($equipped as $key => $value) {
            $equip_string = "{$key}: {$value}\n";
            $equipped_contents[] = $equip_string;
        }

        foreach ($backpack as $key => $value) {
            if (is_string($key)) {
                $item_value_string = "{$key}: {$value}\n";
                $backpack_contents[] = $item_value_string;
            } else {
                $backpack_contents[] = $value . "\n";
            }
        }

        foreach ($potion_bag as $potion => $type) {
            $potion_name = $type['name'];
            $potion_quantity = $type['quantity'];
            $potion_string = "{$potion_name}: {$potion_quantity} \n";
            $potion_bag_contents[] = $potion_string;
        }

        $equipped_results = implode($equipped_contents);
        $potion_bag_result = implode($potion_bag_contents);
        $backpack_result = implode($backpack_contents);
        
        $message = "<<< {$hero_name}'s Inventory >>> \n" . "\n" . "<<< Equipped >>>\n" . $equipped_results . "\n" . "<<< Backpack >>>\n" . $backpack_result . "\n" . "<<< Potion Bag >>> \n" . $potion_bag_result . "\n";
        echo $message . "\n";
    }

    public function meleeAttack($defender) {
        $equipped_weapon = $this->stats_ref->getEquippedItem(Stats::EQUIPPED_MELEE);
        $weapon = Items::getWeapon($equipped_weapon);
        $magic_weapon = $weapon['magic'];
        $weapon_damage = rand(1, $weapon['damage']);
        $ac_check = $this->stats_ref->getStat(Stats::STR_TOTAL) + rand(1, 6);
        $defense_ac = $defender->stats->getStat(Stats::AC_TOTAL);
        $defender_hp = $defender->stats->getStat(Stats::HP_TOTAL);
        $defender_magic_status = $defender->stats->getStat(Stats::IS_MAGIC);
        $hp_result = $defender_hp - $weapon_damage;
        $attacker_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
        $defender_name = "{$defender->stats->getStat(Stats::NAME)} the {$defender->stats->getStat(Stats::CLASS_NAME)}";
        
        $hit = sprintf(self::MELEE_ATTACK_RESPONSES['hit'], $attacker_name, $defender_name, $weapon_damage);
        $miss = sprintf(self::MELEE_ATTACK_RESPONSES['miss'], $attacker_name, $defender_name);
        $magic_message = sprintf(self::MELEE_ATTACK_RESPONSES['magic_message'], $defender_name, $attacker_name);

        $defender_hit = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $hp_result);
        $defender_miss = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp);

        if ($ac_check > $defense_ac) {
            if ($defender_magic_status == true) {
                if ($magic_weapon == true) {
                    $defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
                    echo $hit . $defender_hit;
                } else {
                    echo $magic_message . $defender_miss;
                }
            } else {
                $defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
                echo $hit . $defender_hit;
            }
        } else {
            echo $miss . $defender_miss;
        }
    }

    public function rangedAttack($defender) {
        $equipped_weapon = $this->stats_ref->getEquippedItem(Stats::EQUIPPED_RANGED);
        $weapon = Items::getWeapon($equipped_weapon);
        $ammo = $this->stats_ref->getEquippedItem(Stats::EQUIPPED_ARROWS);
        $magic_ammo = $weapon['magic'];
        $weapon_damage = rand(1, $weapon['damage']);
        $dex_check = $this->stats_ref->getStat(Stats::DEX_TOTAL) + rand(1, 6);
        $defense_dex = $defender->stats->getStat(Stats::DEX_TOTAL);
        $defender_hp = $defender->stats->getStat(Stats::HP_TOTAL);
        $defender_magic_status = $defender->stats->getStat(Stats::IS_MAGIC);
        $hp_result = $defender_hp - $weapon_damage;
        $attacker_name = "{$this->stats_ref->getStat(Stats::NAME)} the {$this->stats_ref->getStat(Stats::CLASS_NAME)}";
        $defender_name = "{$defender->stats->getStat(Stats::NAME)} the {$defender->stats->getStat(Stats::CLASS_NAME)}";

        $hit = sprintf(self::RANGED_ATTACK_RESPONSES['hit'], $attacker_name, $defender_name, $weapon_damage);
        $miss = sprintf(self::RANGED_ATTACK_RESPONSES['miss'], $attacker_name, $defender_name);
        $magic_message = sprintf(self::RANGED_ATTACK_RESPONSES['magic_message'], $defender_name, $attacker_name);

        $defender_hit = sprintf(self::DEFENSE_RESPONSES['hit'], $defender_name, $hp_result);
        $defender_miss = sprintf(self::DEFENSE_RESPONSES['miss'], $defender_name, $defender_hp); 
        
        if ($ammo >= 1) {
            if ($dex_check > $defense_dex) {
                if ($defender_magic_status == true) {
                    if ($magic_ammo == true) {
                        $defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
                        $new_quantity = ($ammo - 1);
                        $this->stats_ref->setArrowQuantity($new_quantity);
                        echo $hit . $defender_hit;
                    } else {
                        echo $magic_message . $defender_miss;
                    }
                } else {
                    $defender->stats->setStat(Stats::HP_TOTAL, $hp_result);
                    $new_quantity = ($ammo - 1);
                    $this->stats_ref->setArrowQuantity($new_quantity);
                    echo $hit . $defender_hit;
                }
            }
        } else {
            echo $miss . $defender_miss;
        }  
    }

    public function defend() {
        $defend_roll = rand(3, 6);
        $new_ac = $this->stats_ref->getStat(Stats::AC_TEMP) + $defend_roll;
        $this->stats_ref->setStat(Stats::AC_TEMP, $new_ac); 
        $boosted_ac = $new_ac + $this->stats_ref->getStat(Stats::AC_TOTAL);

        echo "{$this->stats_ref->getStat(Stats::NAME)} gets into a defesive stance.\n{$this->stats_ref->getStat(Stats::NAME)}'s defense has been boosted by {$defend_roll} and is now {$boosted_ac}\n";
    }

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
                echo "{$hero_name} drank a health potion.\n{$hero_name} now has {$hero_hp} hit points! \n";
            } else {
                echo "{$hero_name} does not have any health potions in their inventory.\n";
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
                echo "{$hero_name} drank an attack potion.\n{$hero_name} now has {$new_str} strength! \n";
            } else {
                echo "{$hero_name} does not have any attack potions in their inventory.\n";
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
                echo "{$hero_name} drank a defense potion.\n{$hero_name} now has {$new_ac} defense! \n";
            } else {
                echo "{$hero_name} does not have any defense potions in their inventory.\n";
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
                echo "{$hero_name} drank an intelligence potion.\n{$hero_name} now has {$new_int} intelligence! \n";
            } else {
                echo "{$hero_name} does not have any intelligence potions in their inventory.\n";
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
                echo "{$hero_name} drank a dexterity potion.\n{$hero_name} now has {$new_dex} dexterity! \n";
            } else {
                echo "{$hero_name} does not have any dexterity potions in their inventory.\n";
            }
        } else {
            echo "Error: '{$type}' is not a valid entry for usePotion. Check your spelling!\n";
        }
    }

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
                    $target->stats->setStat(Stats::HP_TOTAL, $hp_result);
                    echo sprintf(self::SPELL_ATTACK_RESPONSES['fireball'], $hero_name, $target_name, $damage) . sprintf(self::DEFENSE_RESPONSES['hit'], $target_name, $hp_result);
                } else {
                    echo sprintf(self::SPELL_ATTACK_RESPONSES['miss'], $hero_name, $target_name) . sprintf(self::DEFENSE_RESPONSES['miss'], $target_name, $target_hp);
                }
                break;
            case Items::SPELL_HEAL_WOUNDS:
                $boost = $spell['amount'];
                $hero_hp += $boost;
                $this->stats_ref->setStat(Stats::HP_TOTAL, $hero_hp);
                echo "{$hero_name} weaves bright light together and heals {$boost} hit points. \n{$hero_name} now has {$hero_hp} hit points!\n";
                break;
            case Items::SPELL_MAGIC_ARMOR:
                $boost = $spell['amount'];
                $hero_ac += $boost;
                $this->stats_ref->setStat(Stats::AC_BONUS_EFFECTS, $hero_ac);
                $this->stats_ref->updateTotalStats();
                echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_ac} defense!\n";
                break;
            case Items::SPELL_DISPELL:
                $target->stats->resetBonusEffectsStats();
                $target->stats->updateTotalStats();
                echo "{$hero_name} weaves dark whispers together that invade {$target_name}'s senses. \n{$target_name} loses all effect bonuses.\n";
                break;
            case Items::SPELL_QUICKEN:
                $boost = $spell['amount'];
                $hero_dex += $boost;
                $this->stats_ref->setStat(Stats::DEX_BONUS_EFFECTS, $hero_dex);
                $this->stats_ref->updateTotalStats();
                echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_dex} dexterity!\n";
                break;
            case Items::SPELL_ENRAGE:
                $boost = $spell['amount'];
                $hero_str += $boost;
                $this->stats_ref->setStat(Stats::STR_BONUS_EFFECTS, $hero_str);
                $this->stats_ref->updateTotalStats();
                echo "{$hero_name} weaves mystic runes together and shields themsevles for {$boost} extra armor. \n{$hero_name} now has {$hero_str} strength!\n";
                break;
            default:
                echo "Error: '{$type}' is not a valid entry for castSpell. Check your spelling!\n";

        }
    }   
}
