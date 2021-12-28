<?php
namespace App\Builder\Rover;

use App\Contracts\PlateauInterface;
use App\Contracts\RoverBuilderInterface;
use App\Entities\Coordinator\Coordinator;
use App\Entities\Rover\Rover;

class RoverBuilder implements RoverBuilderInterface
{


    /**
     * @param int $x
     * @param int $y
     * @param string $direction
     * @param PlateauInterface $plateau
     * @return Rover
     */
    static public function getRover(int $x, int $y, string $direction, PlateauInterface $plateau)
    {
        $coordinator=new Coordinator($direction);
        return new Rover($x,$y,$coordinator,$plateau);
    }
}