<?php

namespace App\Contracts;

interface CoordinatorInterface
{

    /**
     * CoordinatorInterface constructor.
     * @param string $direction
     */
    public function __construct(string $direction);

    /**
     * @param string $direction
     * @return bool
     */
    public function isValidDirection(string $direction): bool;

    /**
     * @return bool
     */
    public function hasYAxisMove(): bool;

    /**
     * @return int
     */
    public function getYAxisStep(): int;

    /**
     * @return bool
     */
    public function hasXAxisMove(): bool;

    /**
     * @return int
     */
    public function getXAxisStep(): int;

    /**
     * @param string $command
     * @return CoordinatorInterface
     */
    public function setCommandChangeDirection(string $command): self;

    /**
     * @return string
     */
    public function getCurrentDirection(): string;

    /**
     * @param string $command
     * @return boolean
     */
    public function isDirectionCommand(string $command): bool;

}