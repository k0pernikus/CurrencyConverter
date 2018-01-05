<?php

namespace Kopernikus\CurrencyConverter;


use Kopernikus\Provider\XMLRateProvider;

class CurrencyConverterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurrencyConverter
     */
    protected $currencyConverter;

    public function rateProvider()
    {
        return [
            // read as: 200 EUR should be converted to 223 USD
            [200, 'EUR', 223, 'USD'],
            [330, 'USD', 2106.23, 'CNY'],
            [1, 'RUB', .06, 'BRL'],
            [14, 'USD', 12.56, 'EUR'],
        ];
    }

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
     * @dataProvider rateProvider
     * @param int $amountToConvert
     * @param string $fromCurrency
     * @param int $expected
     * @param string $toCurrency
     */
    public function testPriceConversion(
        $amountToConvert,
        $fromCurrency,
        $expected,
        $toCurrency)
    {
        $actual = $this->currencyConverter
            ->setFromCurrency($fromCurrency)
            ->setToCurrency($toCurrency)
            ->convert($amountToConvert);

        $this->assertEquals(
            $expected,
            $actual,
            "should convert {$amountToConvert} {$fromCurrency} to {$expected} ${toCurrency} but got ${actual} ${toCurrency}");
    }
}
