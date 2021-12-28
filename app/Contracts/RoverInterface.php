<?php

namespace App\Contracts;

interface RoverInterface extends StringableInterface
{

    /**
     * RoverInterface constructor.
     * @param int $x_axis
     * @param int $y_axis
     * @param CoordinatorInterface $coordinator
     * @param PlateauInterface $plateau
     */
    public function __construct(int $x_axis, int $y_axis, CoordinatorInterface $coordinator, PlateauInterface $plateau);

    /**
     * @param string $command
     * @return mixed
     */
    public function runCommand(string $command);

}