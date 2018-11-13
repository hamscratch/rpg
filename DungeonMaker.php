<?php

class DungeonMaker {

    const DUNGEON_BEFALLEN = 'dungeon_befallen';

    const DUNGEONS = [
        'dungeon_befallen' => [
            'name' => 'Befallen',
            'description' => 'A dank and musty crypt with hidden dangers all around!',
            'rooms' => [
                'room_1' => [
                    'name' => 'Entrance',
                    'description' => 'This is the entrance to the dungeon. There is a door ahead of you and a stairway leading out behind you.',
                    'mob' => false,
                    'named_mob' => false,
                    'traps' => 1,
                    'loot' => [
                        'gold' => 5,
                        'potion' => 1,
                    ],
                    'connection' => ['room_2'],
                ],
                'room_2' => [
                    'name' => 'Hallway',
                    'description' => 'This is a hallway. There is a monster in here that wants to eat you. In front of you is a door and behind you is the door where you came from.',
                    'mob' => true,
                    'named_mob' => false,
                    'traps' => 1,
                    'loot' => [
                        'gold' => 5,
                        'potion' => 1,
                    ],
                    'connection' => ['room_1', 'room_3'],
                ],          
                'room_3' => [
                    'name' => 'Boss Room',
                    'description' => 'This is a room with a named monster that wants to eat you. There is a treasure chest in this room that is available once you defeat the monster. The only door in the room is the one behind you that leads into the hallway.',
                    'mob' => false,
                    'named_mob' => true,
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

    public $dungeon;
    public $dungeon_name;
    public $room_1;
    public $room_2;
    public $room_3;

    public $npc;
    public $named_npc;

    public function __construct() {
        $this->dungeon = self::DUNGEON_BEFALLEN;
        $this->dungeon_name = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'name');
        $this->room_1 = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'rooms', 'Entrance');
        $this->room_2 = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'rooms', 'Hallway');
        $this->room_3 = $this->getRoomInfo(self::DUNGEON_BEFALLEN, 'rooms', 'Boss Room');
    }

    public function getRoomInfo($dungeon, $info, $additional_info = NULL) {
        if ($additional_info === NULL) {
            $result = self::DUNGEONS[$dungeon][$info];
            return $result;
        } else {
            $room_array = self::DUNGEONS[$dungeon][$info];
            
            foreach ($room_array as $room) {
                if ($room['name'] === $additional_info) {
                    return $room;
                }
            }
        }
    }

    public function makeNPC($room) {
        if ($room['named_mob'] === true) {
            $named_npc = new NPC;

            $this->named_npc = $named_npc;
        }
        if ($room['mob'] === true) {
            $npc = new NPC;

            $this->npc = $npc;
        }   
    }
}
