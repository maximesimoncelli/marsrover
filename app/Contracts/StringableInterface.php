<?php

namespace App\Contracts;


interface StringableInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}