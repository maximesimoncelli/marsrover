<?php

namespace App\Entities\Rover;

use App\Contracts\CoordinatorInterface;
use App\Contracts\PlateauInterface;
use App\Contracts\RoverInterface;
use Exception;
use InvalidArgumentException;
use OutOfRangeException;

class Rover implements RoverInterface
{
    /**
     * @var int
     */
    protected $X_AXIS;
    /**
     * @var
     */
    protected $Y_AXIS;
    /**
     * @var PlateauInterface
     */
    protected $plateau;
    /**
     * @var CoordinatorInterface
     */
    protected $coordinator;

    /**
     * Rover constructor.
     * @param int $x_axis
     * @param int $y_axis
     * @param CoordinatorInterface $coordinator
     * @param PlateauInterface $plateau
     */
    public function __construct(int $x_axis, int $y_axis, CoordinatorInterface $coordinator, PlateauInterface $plateau)
    {
        $this->X_AXIS = $x_axis;
        $this->Y_AXIS = $y_axis;
        $this->coordinator = $coordinator;
        $this->plateau = $plateau;
    }


    /**
     * @param string $command
     * @return $this
     * @throws Exception
     */
    public function runCommand(string $command)
    {
        for ($i=0;$i<strlen($command);$i++) {
            $currentCommand=$command[$i];
            if ($this->coordinator->isDirectionCommand($currentCommand)){
                $this->coordinator->setCommandChangeDirection($currentCommand);
            } else {
                $this->setRoverCommand($currentCommand);
            }
        }
        return $this;
    }

    /**
     * @param $command
     * @return $this
     * @throws Exception
     */
    private function setRoverCommand($command)
    {
        $command = strtoupper($command);
        if ($command == 'M') {
            $this->runMoveCommand();
        } else {
            throw new InvalidArgumentException("Rover dose not support this command!", 20001);
        }
        return $this;
    }


    /**
     * @return $this
     * @throws Exception
     */
    private function runMoveCommand()
    {
        if ($this->coordinator->hasXAxisMove()) {
            $this->setMoveBySteps($this->coordinator->getXAxisStep(), $this->X_AXIS);
        }
        if ($this->coordinator->hasYAxisMove()) {
            $this->setMoveBySteps($this->coordinator->getYAxisStep(), $this->Y_AXIS);
        }
        if(!$this->plateau->isValidCoordinate($this->X_AXIS, $this->Y_AXIS)){
            throw new OutOfRangeException("Rover can not move to this position!", 20002);
        }
        return $this;
    }


    /**
     * @param int $step
     * @param int $mover
     * @return $this
     */
    private function setMoveBySteps(int $step, int &$mover)
    {
        switch (true) {
            case $step > 0:
                $mover = $mover + abs($step);
                break;
            case $step < 0:
                $mover = $mover - abs($step);
                break;
            default:
                break;
        }
        return $this;
    }


    /**
     * @return array
     */
    public function getRoverStatus(){
        return [$this->X_AXIS,$this->Y_AXIS,$this->coordinator->getCurrentDirection()];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(' ',$this->getRoverStatus());
    }

}