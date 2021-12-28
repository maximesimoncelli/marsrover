<?php

namespace App\Entities\Coordinator;


use App\Contracts\CoordinatorInterface;
use InvalidArgumentException;

Abstract class CoordinatorAbstract implements CoordinatorInterface
{
    /**
     * @var array
     */
    protected $coordinator_directions = [];
    /**
     * @var array
     */
    protected $coordinator_movements = [];

    /**
     * @var array
     */
    protected $supported_commands = ['L', 'R'];

    /**
     * @var string
     */
    protected $current_direction;

    /**
     * Coordinator constructor.
     * @param string $direction
     * @throws Exception
     */
    public function __construct(string $direction)
    {
        if (!$this->isValidDirection($direction)) {
            throw new InvalidArgumentException("Direction is not valid.", 10001);
        }
        $this->current_direction = $this->getTextUpper($direction);
    }

    /**
     * @param string $direction
     * @return bool
     */
    public function isValidDirection(string $direction): bool
    {
        $direction = $this->getTextUpper($direction);
        if (isset($this->coordinator_directions[$direction])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function hasYAxisMove(): bool
    {
        if (isset($this->coordinator_movements[$this->current_direction], $this->coordinator_movements[$this->current_direction]['y_axis']) && $this->coordinator_movements[$this->current_direction]['y_axis'] != 0) {
            return true;
        }
        return false;
    }


    /**
     * @return int
     */
    public function getYAxisStep(): int
    {
        if (isset($this->coordinator_movements[$this->current_direction], $this->coordinator_movements[$this->current_direction]['y_axis']) && $this->coordinator_movements[$this->current_direction]['y_axis'] != 0) {
            return $this->coordinator_movements[$this->current_direction]['y_axis'];
        }
        return 0;
    }

    /**
     * @return bool
     */
    public function hasXAxisMove(): bool
    {
        if (isset($this->coordinator_movements[$this->current_direction], $this->coordinator_movements[$this->current_direction]['x_axis']) && $this->coordinator_movements[$this->current_direction]['x_axis'] != 0) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getXAxisStep(): int
    {
        if (isset($this->coordinator_movements[$this->current_direction], $this->coordinator_movements[$this->current_direction]['x_axis']) && $this->coordinator_movements[$this->current_direction]['x_axis'] != 0) {
            return $this->coordinator_movements[$this->current_direction]['x_axis'];
        }
        return 0;
    }

    /**
     * @param string $command
     * @return CoordinatorAbstract
     * @throws Exception
     */
    public function setCommandChangeDirection(string $command): self
    {
        $command = $this->getTextUpper($command);
        if ($command == 'L') {
            $this->current_direction = $this->coordinator_directions[$this->current_direction]['left_direction'];
        } elseif ($command == 'R') {
            $this->current_direction = $this->coordinator_directions[$this->current_direction]['right_direction'];
        } else {
            throw new InvalidArgumentException("Direction is not valid.", 10001);
        }
        return $this;
    }

    /**
     * @param string $command
     * @return bool
     */
    public function isDirectionCommand(string $command): bool
    {
        $command = $this->getTextUpper($command);
        if (in_array($command, $this->supported_commands)) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getCurrentDirection(): string
    {
        return $this->current_direction;
    }
    /**
     * @param string $text
     * @return string
     */
    private function getTextUpper(string $text): string
    {
        return strtoupper($text);
    }

}