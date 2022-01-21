<?php
declare(strict_types=1);


use App\Robot;
use PHPUnit\Framework\TestCase;

final class RobotTest extends TestCase
{
    public function testDirection()
    {
        $robot = new Robot('N');
        $robot->left();

        $this->assertEquals($robot->facingDirection, 'W');
    }
}