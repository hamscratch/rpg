<?php


class Items {
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
		'fireball' => [
			'name' => "Fireball",
			'amount' => 8,
			'description' => "A ball of fire. Duh."
		],
		'heal_wounds' => [
			'name' => "Heal Wounds",
			'amount' => 10,
			'description' => "Weaving light to restore some health."
		],
		'magic_armor' => [
			'name' => "Magic Armor",
			'amount' => 5,
			'description' => "Mystical runes surround the caster and boost their armor."
		],
		'dispell' => [
			'name' => "Dispell",
			'amount' => -5,
			'description' => "Removes enchancements from an opponent."
		],
		'quicken' => [
			'name' => "Quicken",
			'amount' => 5,
			'description' => "Magic courses through your veins as your feel yourself get quicker."
		],
		'enrage' => [
			'name' => "Enrage",
			'amount' => 5,
			'description' => "Magic courses through your veins as your feel yourself get stronger."
		],
	];
	static function getWeapon($type) {
		if ($type === 'Melee') {
			$weapon = self::WEAPONS['short_sword'];
		} else if ($type === 'Ranged') {
			$weapon = self::WEAPONS['long_bow'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getWeapon. Check your spelling!" . "\n";
		}
		return $weapon;
	}
	static function getArmor($type) {
		if ($type === 'cloth') {
			$armor = self::ARMOR['cloth'];
		} else if ($type === 'leather') {
			$armor = self::ARMOR['leather'];
		} else if ($type === 'chainmail') {
			$armor = self::ARMOR['chainmail'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getArmor. Check your spelling!" . "\n";
		}
		return $armor;
	}
	static function getPotion($type) {
		if ($type === 'Health') {
			$potion = self::POTIONS['health'];
		} else if ($type === 'Attack') {
			$potion = self::POTIONS['attack'];
		} else if ($type === 'Defense') {
			$potion = self::POTIONS['defense'];
		} else if ($type === 'Intelligence') {
			$potion = self::POTIONS['intelligence']; 
		} else if ($type === 'Dexterity') {
			$potion = self::POTIONS['dexterity'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getPotion. Check your spelling!" . "\n";
		}
		return $potion;
	}
	static function getSpell($type) {
		if ($type === 'fireball') {
			$spell = self::SPELLS['fireball'];
		} else if ($type === 'heal_wounds') {
			$spell = self::SPELLS['heal_wounds'];
		} else if ($type === 'magic_armor') {
			$spell = self::SPELLS['magic_armor'];
		} else if ($type === 'dispell') {
			$spell = self::SPELLS['dispell'];
		} else if ($type ==='quicken') {
			$spell = self::SPELLS['quicken'];
		} else if ($type === 'enrage') {
			$spell = self::SPELLS['enrage'];
		} else {
			echo "Error: '{$type}' is not a valid entry for getSpell. Check your spelling!" . "\n";
		}
		return $spell;
	}
}
