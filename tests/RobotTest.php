<?php
declare(strict_types=1);

use App\Robot;
use App\Direction;
use PHPUnit\Framework\TestCase;

final class RobotTest extends TestCase
{
    public function testTurningLeft()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->left();

        $this->assertEquals($robot->facingDirection, Direction::WEST);
    }

    public function testTurningLeftTwice()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->left();
        $robot->left();

        $this->assertEquals($robot->facingDirection, Direction::SOUTH);
    }

    public function testTurningLeftThrice()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->left();
        $robot->left();
        $robot->left();

        $this->assertEquals($robot->facingDirection, Direction::EAST);
    }    
    
    public function testTurningLeftFourTimes()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->rotate(Robot::TURN_LEFT, 4);

        $this->assertEquals(Direction::NORTH, $robot->facingDirection);
    }

    public function testTurningRight()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->right();

        $this->assertEquals($robot->facingDirection, Direction::EAST);
    }

    public function testTurningRightTwice()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->right();
        $robot->right();

        $this->assertEquals($robot->facingDirection, Direction::SOUTH);
    }

    public function testTurningRightThrice()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->right();
        $robot->right();
        $robot->right();

        $this->assertEquals($robot->facingDirection, Direction::WEST);
    }    
    
    public function testTurningRightFourTimes()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->rotate(Robot::TURN_RIGHT, 4);

        $this->assertEquals(Direction::NORTH, $robot->facingDirection);
    }

    public function testTurningRightEightTimes()
    {
        $robot = new Robot(Direction::NORTH);
        $robot->rotate(Robot::TURN_RIGHT, 8);

        $this->assertEquals(Direction::NORTH, $robot->facingDirection);
    }
}