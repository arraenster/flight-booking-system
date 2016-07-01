<?php
namespace Test\Inventory\Entity;

use Inventory\Entity\Flight;
/**
 * @coversDefaultClass Inventory\Entity\Flight
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class FlightTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Flight
     */
    protected $entity;

    public function setUp()
    {

        $this->entity = new Flight();
    }

    /**
     * @return array
     */
    public function provideInvalidStrings()
    {

        return [
            [''],
            [123]
        ];
    }

    /**
     * @covers ::getArrayCopy
     */
    public function testGetArrayCopyReturnArray()
    {

        $this->assertInternalType('array', $this->entity->getArrayCopy());
    }

    /**
     * @covers ::setId
     * @covers ::getId
     */
    public function testGetIdReturnInt()
    {

        $test = 1;
        $this->entity->setId($test);
        $this->assertSame($test, $this->entity->getId());
    }

    /**
     * @param string $flightDate
     *
     * @covers ::setFlightDate
     *
     * @dataProvider provideInvalidStrings
     * @expectedException \Exception
     */
    public function testGetFlightDateReturnString($flightDate)
    {

        $this->entity->setFlightDate($flightDate);
    }

    /**
     * @covers ::exchangeArray
     */
    public function testExchangeArray()
    {

        $testArray = [
            'id'            => 1,
            'origin'        => 'Kyiv',
            'destination'   => 'Berlin'
        ];

        $this->entity->exchangeArray($testArray);
        $this->assertSame(1, $this->entity->getId());
        $this->assertSame('Berlin', $this->entity->getDestination());
    }
}