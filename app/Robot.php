<?php

namespace App;
class Robot
{
    const TURN_LEFT = 'L';
    const TURN_RIGHT = 'R';

    public $initialDirection;
    public $facingDirection;

    public function __construct($initialDirection)
    {
        $this->initialDirection = $initialDirection;
    }

    public function left() : void
    {
        switch ($this->initialDirection) {
            case 'N' :
                $this->facingDirection = 'W';
                break;
            default:
                break;
        }
    }
}