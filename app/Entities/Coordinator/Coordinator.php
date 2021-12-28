<?php

namespace App\Entities\Coordinator;

use App\Contracts\CoordinatorInterface;
use App\Entities\Direction\Direction;

class Coordinator extends CoordinatorAbstract implements CoordinatorInterface
{
    /**
     * define coordinator directions
     */
    protected $coordinator_directions = [
        Direction::DIRECTION_NORTH => ['left_direction' => Direction::DIRECTION_WEST, 'right_direction' => Direction::DIRECTION_EAST],
        Direction::DIRECTION_SOUTH => ['left_direction' => Direction::DIRECTION_EAST, 'right_direction' => Direction::DIRECTION_WEST],
        Direction::DIRECTION_EAST => ['left_direction' => Direction::DIRECTION_NORTH, 'right_direction' => Direction::DIRECTION_SOUTH],
        Direction::DIRECTION_WEST => ['left_direction' => Direction::DIRECTION_SOUTH, 'right_direction' => Direction::DIRECTION_NORTH],
    ];

    /**
     * define coordinator movements
     */
    protected $coordinator_movements = [
        Direction::DIRECTION_NORTH => ['x_axis' => 0, 'y_axis' => 1],
        Direction::DIRECTION_SOUTH => ['x_axis' => 0, 'y_axis' => -1],
        Direction::DIRECTION_EAST => ['x_axis' => 1, 'y_axis' => 0],
        Direction::DIRECTION_WEST => ['x_axis' => -1, 'y_axis' => 0],
    ];


    /**
     * @var string
     */
    protected $current_direction;


}