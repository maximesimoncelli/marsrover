<?php
namespace App\Traits;

use App\Builder\Rover\RoverBuilder;
use App\Contracts\PlateauInterface;
use App\Contracts\RoverInterface;
use App\Entities\Plateau\Plateau;

trait RoverHelper
{

    /**
     * @param int $x
     * @param int $y
     * @return Plateau
     */
    protected function createPlateau(int $x, int $y){
        return new Plateau($x,$y);
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $direction
     * @param PlateauInterface $plateau
     * @return \App\Entities\Rover\Rover
     */
    protected function createRover(int $x, int $y, string $direction, PlateauInterface $plateau){
        return RoverBuilder::getRover($x,$y,$direction,$plateau);
    }

    /**
     * @param RoverInterface $rover
     * @param $command
     * @return $this
     */
    protected function runRoverCommand(RoverInterface &$rover, $command){
        $rover->runCommand($command);
        return $this;
    }
}