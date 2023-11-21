<?php
namespace App\Tests\Entity;
use App\Entity\Forecast;
use PHPUnit\Framework\TestCase;
class MeasurementTest extends TestCase
{
//    public function testSomething(): void
//    {
//        $this->assertTrue(true);
//    }
    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['0.5', 32.9],
            ['11.1',51.98],
            ['-11.1',12.02],
            ['57.4',135.32],
            ['74',165.2],
            ['90',194],
            ['84',183.2],
            ['-100', -148],
            ['100', 212]
        ];
    }

    /**
     * @dataProvider dataGetFahrenheit
     */
    public function testGetFahrenheit($celsius, $expectedFahrenheit): void    {
        $measurement = new Forecast();
//        $measurement->setTemperature('0');
//        $this->assertEquals(32, $measurement->getFahrehneit());
//        $measurement->setTemperature('-100');
//        $this->assertEquals(-148, $measurement->getFahrehneit());
//        $measurement->setTemperature('100');
//        $this->assertEquals(212, $measurement->getFahrehneit());


        $measurement->setTemperature($celsius);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrehneit(),
            "Spodziewana wartość farenfraufuf
             $expectedFahrenheit dla stopni celcjusza $celsius otrzymana wartosc farenfutuf
            {$measurement->getFahrehneit()}");
    }

}
