<?php

namespace App\Contracts;

interface PlateauInterface
{

    /**
     * PlateauInterface constructor.
     * @param int $x
     * @param int $y
     * @param int $minX
     * @param int $minY
     */
    public function __construct(int $x, int $y, int $minX = 0, int $minY = 0);

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function isValidCoordinate(int $x, int $y): bool;
}