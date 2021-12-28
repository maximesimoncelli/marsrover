<?php
declare(strict_types=1);


use App\Builder\Rover\RoverBuilder;
use App\Entities\Coordinator\Coordinator;
use App\Entities\Direction\Direction;
use App\Entities\Plateau\Plateau;
use App\Entities\Rover\Rover;
use PHPUnit\Framework\TestCase;

final class RoverTest extends TestCase
{
    /**
     * check plateau isValidCoordinate methods
     */
    public function testRover(){
        $plateau=new Plateau(5,5);

        /* case first */
        $coordinator=new Coordinator(Direction::DIRECTION_NORTH);
        $rover=new Rover(1,2,$coordinator,$plateau);
        $this->assertSame('1 3 N', (string)$rover->runCommand('LMLMLMLMM'));

        /* case second */
        $coordinator=new Coordinator(Direction::DIRECTION_EAST);
        $rover=new Rover(3,3,$coordinator,$plateau);
        $this->assertSame('5 1 E', (string)$rover->runCommand('MMRMMRMRRM'));

        /* case first by builder */
        $rover=RoverBuilder::getRover(1,2,'N',$plateau);
        $this->assertSame('1 3 N', (string)$rover->runCommand('LMLMLMLMM'));
    }



    /**
     * check plateau InvalidArgumentException
     */
    public function testException(): void
    {
        $plateau=new Plateau(5,5);
        $coordinator=new Coordinator(Direction::DIRECTION_NORTH);
        $rover=new Rover(5,5,$coordinator,$plateau);

        $this->expectException(InvalidArgumentException::class);
        $rover->runCommand("P");

        $this->expectException(OutOfRangeException::class);
        $rover->runCommand("M");
    }


}