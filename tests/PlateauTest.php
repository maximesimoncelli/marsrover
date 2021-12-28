<?php
declare(strict_types=1);

use App\Entities\Plateau\Plateau;
use PHPUnit\Framework\TestCase;

final class PlateauTest extends TestCase
{
    /**
     * check plateau isValidCoordinate methods
     */
    public function testPlateau(){
        $plateau=new Plateau(10,10);

        $this->assertTrue($plateau->isValidCoordinate(5,5));

        $this->assertFalse($plateau->isValidCoordinate(11,5));
    }

    /**
     * check plateau InvalidArgumentException
     */
    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $plateau=new Plateau(-1,10);
        $plateau=new Plateau(-1,-1);
        $plateau=new Plateau(10,-1);

    }

}