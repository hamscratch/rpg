<?php

class NPC extends Character {
    
    const NAMES = ['Rique Jhames', 'Bilge', 'Gorbash', 'Mordok', 'Draxiz', 'Innoruuk', 'Lanys', 'Mooto', 'Treskar', 'Fipphy'];
    const RACES = ['Orc', 'Skeleton', 'Gnoll', 'Ghoul'];
    const CLASS_NAMES = ['Grunt', 'Sorcerer', 'Hunter'];

    const CLASSES = [
            'Grunt' => [
                'class' => 'Grunt',
                'hp_total' => 15,
                'hp_max' => 100,
                'is_magic' => true,
                'ac_base' => 15,
                'ac_temp' => 0,
                'ac_total' => 0,
                'ac_bonus_items' => 0,
                'ac_bonus_effects' => 0,
                'str_base' => 15,
                'str_temp' => 0,
                'str_total' => 0,
                'str_bonus_items' => 0,
                'str_bonus_effects' => 0,
                'dex_base' => 8,
                'dex_temp' => 0,
                'dex_total' => 0,
                'dex_bonus_items' => 0,
                'dex_bonus_effects' => 0,
                'int_base' => 5,
                'int_temp' => 0,
                'int_total' => 0,
                'int_bonus_items' => 0,
                'int_bonus_effects' => 0,
                'equipped' => [
                    'Melee Weapon' => '',
                    'Ranged Weapon' => '',
                    'Armor' => '',
                ],
                'backpack' => [
                    'Melee Weapon' => 'Short Sword',
                    'Ranged Weapon' => 'Long Bow',
                    'Armor' => 'Leather',
                    'Arrows' => 5,
                ],
                'potion_bag' => [
                    'Potions' => [
                        'health' => ['name' => 'Health Potion', 'quantity' => 1],
                        'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
                        'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
                        'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
                        'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
                    ]
                ],
                'class_description' => "Hailing from the mountains of Halas, the warrior beats its enemies with melee weapons"
            ],
            'Sorcerer' => [
                'class' => 'Sorcerer',
                'hp_total' => 15,
                'hp_max' => 80,
                'is_magic' => true,
                'ac_base' => 12,
                'ac_temp' => 0,
                'ac_total' => 0,
                'ac_bonus_items' => 0,
                'ac_bonus_effects' => 0,
                'str_base' => 15,
                'str_temp' => 0,
                'str_total' => 0,
                'str_bonus_items' => 0,
                'str_bonus_effects' => 0,
                'dex_base' => 6,
                'dex_temp' => 0,
                'dex_total' => 0,
                'dex_bonus_items' => 0,
                'dex_bonus_effects' => 0,
                'int_base' => 15,
                'int_temp' => 0,
                'int_total' => 0,
                'int_bonus_items' => 0,
                'int_bonus_effects' => 0,
                'equipped' => [
                    'Melee Weapon' => '',
                    'Ranged Weapon' => '',
                    'Armor' => '',
                ],
                'backpack' => [
                    'Melee Weapon' => 'Short Sword',
                    'Ranged Weapon' => 'Long Bow',
                    'Armor' => 'Leather',
                    'Arrows' => 0,
                ],
                'potion_bag' => [
                    'Potions' => [
                        'health' => ['name' => 'Health Potion', 'quantity' => 1],
                        'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
                        'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
                        'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
                        'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
                    ]
                ],
                'class_description' => "Hailing from the gilded halls for Qeynos, the wizard blasts its enemies with magic spells."
            ],
            'Hunter' => [
                'class' => 'Hunter',
                'hp_total' => 15,
                'hp_max' => 90,
                'is_magic' => true,
                'ac_base' => 15,
                'ac_temp' => 0,
                'ac_total' => 0,
                'ac_bonus_items' => 0,
                'ac_bonus_effects' => 0,
                'str_base' => 15,
                'str_temp' => 0,
                'str_total' => 0,
                'str_bonus_items' => 0,
                'str_bonus_effects' => 0,
                'dex_base' => 15,
                'dex_temp' => 0,
                'dex_total' => 0,
                'dex_bonus_items' => 0,
                'dex_bonus_effects' => 0,
                'int_base' => 8,
                'int_temp' => 0,
                'int_total' => 0,
                'int_bonus_items' => 0,
                'int_bonus_effects' => 0,
                'equipped' => [
                    'Melee Weapon' => '',
                    'Ranged Weapon' => '',
                    'Armor' => '',
                ],
                'backpack' => [
                    'Melee Weapon' => 'Short Sword',
                    'Ranged Weapon' => 'Long Bow',
                    'Armor' => 'Leather',
                    'Arrows' => 10,
                ],
                'potion_bag' => [
                    'Potions' => [
                        'health' => ['name' => 'Health Potion', 'quantity' => 1],
                        'attack' => ['name' => 'Attack Potion', 'quantity' => 1],
                        'defense' => ['name' => 'Defense Potion', 'quantity' => 1],
                        'intelligence' => ['name' => 'Intelligence Potion', 'quantity' => 1],
                        'dexterity' => ['name' => 'Dexterity Potion', 'quantity' => 1],
                    ]
                ],
                'class_description' => "Hailing from the sprawling forests of Misty Vale, the ranger beats its enemies with ranged weapons."
            ],
    ];

    public function __construct() {
        parent::__construct();
        $name = $this->thingPicker(self::NAMES);
        $class = $this->thingPicker(self::CLASSES);
        $class_name = $class['class'];
        $race = $this->thingPicker(self::RACES);

        $this->stats->setStat(Stats::NAME, $name);
        $this->stats->setStat(Stats::CLASS_NAME, $class_name);
        $this->stats->setStat(Stats::RACE, $race);
        $this->stats->setClassStats('NPC', $class_name);
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

    public function npcTurn($target) {
        $hp = $this->stats->hp_total;
        $health_potion = $this->stats->potion_bag['Potions'][Stats::POTION_HEAL];
        $health_potion_quantity = $health_potion['quantity'];

        if ($hp >= 11) {
            $this->actions->meleeAttack($target);
        } 
        if ($hp <= 10) {
            if ($health_potion_quantity >= 1) {
                $this->actions->usePotion(Stats::POTION_HEAL);
            } else {
                $this->actions->meleeAttack($target);
            }
        }
    }

    public function characterInfo() {
        $this->stats->updateTotalStats();
        echo "<<< NPC Stats >>>" . "\n" .   
                   "Name: {$this->stats->getStat(Stats::NAME)} \n" . 
                   "Race: {$this->stats->getStat(Stats::RACE)} \n" . 
                   "Class: {$this->stats->getStat(Stats::CLASS_NAME)} \n" .
                   "Hit Points: {$this->stats->getStat(Stats::HP_TOTAL)} \n" . 
                   "Defense: {$this->stats->getStat(Stats::AC_TOTAL)} \n" .
                   "Strength: {$this->stats->getStat(Stats::STR_TOTAL)} \n" .
                   "Dexterity: {$this->stats->getStat(Stats::DEX_TOTAL)} \n" .
                   "Intelligence: {$this->stats->getStat(Stats::INT_TOTAL)} \n" . "\n"; 
    }
}
