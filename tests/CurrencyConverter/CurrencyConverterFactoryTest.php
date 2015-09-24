<?php

namespace Kopernikus\CurrencyConverter;


use Kopernikus\Provider\XMLRateProvider;

class CurrencyConverterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurrencyConverter
     */
    protected $currencyConverter;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $provider = new XMLRateProvider(file_get_contents(__DIR__ . '/../Provider/xml/eurofxref-daily.xml'));
        $this->currencyConverter = new CurrencyConverter($provider);
    }

    /**
     *
     */
    public function testPriceConversion()
    {
        $actual = $this->currencyConverter
            ->setFromCurrency('EUR')
            ->setToCurrency('USD')
            ->convert(200);
        $this->assertEquals(223, $actual, 'converts 200 euro');

        $actual = $this->currencyConverter
            ->setFromCurrency('USD')
            ->setToCurrency('CNY')
            ->convert(330);
        $this->assertEquals(2106.23, $actual, 'usd in cny');

        $actual = $this->currencyConverter
            ->setFromCurrency('RUB')
            ->setToCurrency('BRL')
            ->convert(1);
        $this->assertEquals(0.06, $actual);

        $actual = $this->currencyConverter
            ->setFromCurrency('USD')
            ->setToCurrency('EUR')
            ->convert(14);
        $this->assertEquals(12.56, $actual);
    }
}
