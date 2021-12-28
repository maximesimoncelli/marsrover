<?php
declare(strict_types=1);

use App\Entities\Coordinator\Coordinator;
use App\Entities\Direction\Direction;
use PHPUnit\Framework\TestCase;

final class CoordinatorTest extends TestCase
{
    /**
     * check plateau isValidCoordinate methods
     */
    public function testCoordinator(){
        /* North Check */
        $coordinator=new Coordinator(Direction::DIRECTION_NORTH);
        $this->assertTrue($coordinator->hasYAxisMove());
        $this->assertFalse($coordinator->hasXAxisMove());
        $this->assertSame(1, $coordinator->getYAxisStep());
        $this->assertSame(0, $coordinator->getXAxisStep());
        $this->assertSame(Direction::DIRECTION_WEST, $coordinator->setCommandChangeDirection('L')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_NORTH, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_EAST, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());

        /* South Check */
        $coordinator=new Coordinator(Direction::DIRECTION_SOUTH);
        $this->assertTrue($coordinator->hasYAxisMove());
        $this->assertFalse($coordinator->hasXAxisMove());
        $this->assertSame(-1, $coordinator->getYAxisStep());
        $this->assertSame(0, $coordinator->getXAxisStep());
        $this->assertSame(Direction::DIRECTION_EAST, $coordinator->setCommandChangeDirection('L')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_SOUTH, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_WEST, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());

        /* West Check */
        $coordinator=new Coordinator(Direction::DIRECTION_WEST);
        $this->assertTrue($coordinator->hasXAxisMove());
        $this->assertFalse($coordinator->hasYAxisMove());
        $this->assertSame(0, $coordinator->getYAxisStep());
        $this->assertSame(-1, $coordinator->getXAxisStep());
        $this->assertSame(Direction::DIRECTION_NORTH, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_WEST, $coordinator->setCommandChangeDirection('L')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_SOUTH, $coordinator->setCommandChangeDirection('L')->getCurrentDirection());

        /* East Check */
        $coordinator=new Coordinator(Direction::DIRECTION_EAST);
        $this->assertTrue($coordinator->hasXAxisMove());
        $this->assertFalse($coordinator->hasYAxisMove());
        $this->assertSame(0, $coordinator->getYAxisStep());
        $this->assertSame(1, $coordinator->getXAxisStep());
        $this->assertSame(Direction::DIRECTION_NORTH, $coordinator->setCommandChangeDirection('L')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_EAST, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());
        $this->assertSame(Direction::DIRECTION_SOUTH, $coordinator->setCommandChangeDirection('R')->getCurrentDirection());

    }

    /**
     * check plateau InvalidArgumentException
     */
    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $coordinator1=new Coordinator("P");
        $coordinator2=new Coordinator(Direction::DIRECTION_NORTH);
        $coordinator2->setCommandChangeDirection('D');
    }

}