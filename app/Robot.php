<?php

namespace App;

use App\Direction;
class Robot
{
    public $facingDirection;

    const TURN_RIGHT = 'R';
    const TURN_LEFT = 'L';

    public function __construct($initialDirection)
    {
        $this->facingDirection = $initialDirection;
    }

    public function left() : void
    {
        switch ($this->facingDirection) {
            case Direction::NORTH :
                $this->facingDirection = Direction::WEST;
                break;
            case Direction::WEST :
                $this->facingDirection = Direction::SOUTH;
                break;
            case Direction::SOUTH :
                $this->facingDirection = Direction::EAST;
                break;
            case Direction::EAST :
                $this->facingDirection = Direction::NORTH;
                break;
            default:
                break;
        }
    }

    public function right() : void
    {
        switch ($this->facingDirection) {
            case Direction::NORTH :
                $this->facingDirection = Direction::EAST;
                break;
            case Direction::EAST :
                $this->facingDirection = Direction::SOUTH;
                break;
            case Direction::SOUTH :
                $this->facingDirection = Direction::WEST;
                break;
            case Direction::WEST :
                $this->facingDirection = Direction::NORTH;
                break;
            default:
                break;
        }
    }

    public function rotate($direction, $repetitions)
    {
        for ($i=0; $i < $repetitions; $i++) { 
            if ($direction === Robot::TURN_RIGHT) {
                $this->right();
            } else {
                $this->left();
            }
        }
    }
}