<?php

namespace App\Entities\Plateau;

use App\Contracts\PlateauInterface;
use InvalidArgumentException;

class Plateau implements PlateauInterface
{
    protected $X_AXIS;
    protected $Y_AXIS;

    protected $MIN_X_AXIS;
    protected $MIN_Y_AXIS;


    /**
     * Plateau constructor.
     * @param int $x
     * @param int $y
     * @param int $minX
     * @param int $minY
     * @throws Exception
     */
    public function __construct(int $x, int $y, int $minX = 0, int $minY = 0)
    {
        if($x < 0 || $y < 0){
            throw new InvalidArgumentException("Minimal position for plateau is [0,0]!", 30001);
        }
        $this->MIN_X_AXIS = $minX;
        $this->MIN_Y_AXIS = $minY;
        $this->X_AXIS = $x;
        $this->Y_AXIS = $y;
    }

    /**
     * Check the position can be in the plateau or not
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function isValidCoordinate(int $x, int $y): bool
    {
        if ($x > $this->X_AXIS || $x < $this->MIN_X_AXIS ||
            $y > $this->Y_AXIS || $y < $this->MIN_Y_AXIS) {
            return false;
        }
        return true;
    }
}