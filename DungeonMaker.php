<?php

class DungeonMaker {

	const DUNGEON_BEFALLEN = 'dungeon_befallen';

	const DUNGEONS = [
		'dungeon_befallen' => [
			'name' => 'Befallen',
			'description' => 'A dank and musty crypt with hidden dangers all around!',
			'rooms' => [
				'room_1' => [
					'description' => 'a stuff.',
					'mobs' => 1,
					'traps' => 1,
					'loot' => [
						'gold' => 5,
						'potion' => 1,
					],
					'connection' => ['room_2'],
				],
				'room_2' => [
					'description' => 'more a stuff.',
					'mobs' => 1,
					'traps' => 1,
					'loot' => [
						'gold' => 5,
						'potion' => 1,
					],
					'connection' => ['room_1', 'room_3'],
				],			
				'room_3' => [
					'description' => 'even more a stuff.',
					'mobs' => 1,
					'traps' => 1,
					'loot' => [
						'gold' => 5,
						'potion' => 1,
					],
					'connection' => ['room_2'],
				],
			],				
		],
	];

	public $rooms;
	public $dungeon;
	public $dungeon_name;

	public function __construct() {
		$this->dungeon = self::DUNGEON_BEFALLEN;
		$this->dungeon_name = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'name');
		$this->rooms = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'rooms');
	}

	public function getRoomInfo($dungeon, $info) {
		$result = self::DUNGEONS[$dungeon][$info];
		return $result;
	}
}
