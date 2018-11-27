<?php

class Hero extends Character {
    // this is just placeholder for now, but id like to have the user choose their class and have them populate 
    // the stats. might need a function to do this. not sure yet. should also update to the consts stat names.
    // (10/30)
    const RACES = [
        'Dwarf',
        'Elf',
        'Human',
    ];
    const CLASSES = [
            'Warrior' => [
                'class' => 'Warrior',
                'hp_total' => 30,
                'hp_max' => 100,
                'is_magic' => false,
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
                    'Arrows' => '',
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
            'Wizard' => [
                'class' => 'Wizard',
                'hp_total' => 20,
                'hp_max' => 80,
                'is_magic' => true,
                'ac_base' => 12,
                'ac_temp' => 0,
                'ac_total' => 0,
                'ac_bonus_items' => 0,
                'ac_bonus_effects' => 0,
                'str_base' => 6,
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
                    'Arrows' => '',
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
            'Ranger' => [
                'class' => 'Ranger',
                'hp_total' => 25,
                'hp_max' => 90,
                'is_magic' => false,
                'ac_base' => 15,
                'ac_temp' => 0,
                'ac_total' => 0,
                'ac_bonus_items' => 0,
                'ac_bonus_effects' => 0,
                'str_base' => 10,
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
                    'Arrows' => '',
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
        $this->stats->updateTotalStats();
        echo "<<< Character Stats >>>" . "\n" .     
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


