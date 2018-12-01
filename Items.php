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

    const WEAPONS_SHORT_SWORD = 'short_sword';
    const WEAPONS_LONG_BOW = 'long_bow';
    const WEAPONS_ARROWS = 'arrows';
    const WEAPONS_SILVER_SHORT_SWORD = 'silver_short_sword';
    const WEAPONS_MAGIC_ARROWS = 'magic_arrows';

    const ARMOR_CLOTH = 'cloth';
    const ARMOR_LEATHER = 'leather';
    const ARMOR_CHAINMAIL = 'chainmail';
    const ARMOR_ELVEN = 'elven';

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
}
