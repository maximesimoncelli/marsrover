<?php

namespace App\Contracts;

interface RoverBuilderInterface
{
    static public function getRover(int $x, int $y, string $direction, PlateauInterface $plateau);
}