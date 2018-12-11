<?php


class Items {
    const SPELL_FIREBALL = 'Fireball';
    const SPELL_HEAL_WOUNDS = 'Heal Wounds';
    const SPELL_MAGIC_ARMOR = 'Magic Armor';
    const SPELL_DISPELL = 'Dispell';
    const SPELL_QUICKEN = 'Quicken';
    const SPELL_ENRAGE = 'Enrage';

    const POTIONS_HEALTH = 'health';
    const POTIONS_ATTACK = 'attack';
    const POTIONS_DEFENSE = 'defense';
    const POTIONS_INTELLIGENCE = 'intelligence';
    const POTIONS_DEXTERITY = 'dexterity';

    const WEAPONS_SHORT_SWORD = 'Short Sword';
    const WEAPONS_LONG_BOW = 'Long Bow';
    const WEAPONS_IRON_ARROWS = 'Iron Arrow(s)';
    const WEAPONS_SILVER_SHORT_SWORD = 'Silver Short Sword';
    const WEAPONS_MAGIC_ARROWS = 'Magic Arrow(s)';

    const ARMOR_CLOTH = 'Cloth';
    const ARMOR_LEATHER = 'Leather';
    const ARMOR_CHAINMAIL = 'Chainmail';
    const ARMOR_ELVEN = 'Elven';

    const VALID_WEAPONS = ['Short Sword', 'Long Bow', 'Iron Arrow', 'Iron Arrows', 'Iron Arrow(s)', 'Silver Short Sword', 'Magic Arrow', 'Magic Arrows', 'Magic Arrow(s)'];
    const VALID_ARMOR = ['Cloth', 'Leather', 'Chainmail', 'Elven'];

    const WEAPONS = [
        'Short Sword' => [
            'name' => 'Short Sword',
            'damage' => 8,
            'description' => "This is a short sword.",
            'magic' => false,
        ], 
        'Long Bow' => [
            'name' => 'Long Bow',
            'damage' => 10,
            'description' => "This is a Long Bow.",
            'magic' => false,
        ],
        'Iron Arrow(s)' => [
            'name' => 'Iron Arrow(s)',
            'quantity' => 0,
            'description' => "This is an iron arrowhead on a wooden shaft with feather fins.",
            'magic' => false,
        ],
        'Silver Short Sword' => [
            'name' => 'Silver Short Sword',
            'damage' => 10,
            'description' => "Runes shimmer along the blade, giving a dim glow. Magic energy courses through this weapon.",
            'magic' => true,
        ],
        'Magic Arrow(s)' => [
            'name' => 'Magic Arrow(s)',
            'quantity' => 0,
            'description' => "Runes shiummer along the arrow tip, giving a dim glow. Magic energy courses through this weapon.",
            'magic' => true,
        ],
    ];
    const ARMOR = [
        'Cloth' => [
            'name' => 'Cloth Armor',
            'armor' => 2,
            'description' => "This is cloth armor. Offers light protection. You also look poor in it",
            'magic' => false,
        ],
        'Leather' => [
            'name' => 'Leather Armor',
            'armor' => 4,
            'description' => "This is leather armor. Offers medium protection.",
            'magic' => false,
        ], 
        'Chainmail' => [
            'name' => "Chainmail Armor",
            'armor' => 6,
            'description' => "This is chainmail armor. Offers heavy protection.",
            'magic' => false,
        ],
        'Elven' => [
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
        'Fireball' => [
            'name' => "Fireball",
            'amount' => 8,
            'description' => "A ball of fire. Duh."
        ],
        'Heal Wounds' => [
            'name' => "Heal Wounds",
            'amount' => 10,
            'description' => "Weaving light to restore some health."
        ],
        'Magic Armor' => [
            'name' => "Magic Armor",
            'amount' => 5,
            'description' => "Mystical runes surround the caster and boost their armor."
        ],
        'Dispell' => [
            'name' => "Dispell",
            'amount' => -5,
            'description' => "Removes enchancements from an opponent."
        ],
        'Quicken' => [
            'name' => "Quicken",
            'amount' => 5,
            'description' => "Magic courses through your veins as your feel yourself get quicker."
        ],
        'Enrage' => [
            'name' => "Enrage",
            'amount' => 5,
            'description' => "Magic courses through your veins as your feel yourself get stronger."
        ],
    ];
    static function getWeapon($type) {
        $weapon = self::WEAPONS[$type];
        return $weapon;
    }
    static function getArmor($type) {
        $armor = self::ARMOR[$type];
        return $armor;
    }
    static function getPotion($type) {
        $potion = self::POTIONS[$type];
        return $potion;
    }
    static function getSpell($type) {
        $spell = self::SPELLS[$type];
        return $spell;
    }

    /*
    // *** UNDER CONSTRUCTION ***
    static function getItemInfo($type) {
        $item = $type[];

        if ($type === "Melee") {
            $name = Items::getWeapon('Melee');
            echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n";
        } else if ($type === "Ranged") {
            $name = Items::getWeapon('Ranged');
            echo "Item Information: \n" . "Weapon Name: {$name['name']} \n" . "Damage: 1-{$name['damage']} \n" . "Description: {$name['description']} \n";
        }
    }
    */
}

