<?php
namespace Kopernikus\Provider;

class XMLRateProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var XMLRateProvider
     */
    protected $xmlRateProvider;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $xml = file_get_contents(__DIR__ . '/xml/eurofxref-daily.xml');
        $this->xmlRateProvider = new XMLRateProvider($xml);
    }

    /**
     *
     */
    public function testRatesFromBaseCurrency()
    {
        $actual = $this->xmlRateProvider->getRate('USD');
        $this->assertEquals(1.115, $actual);

        $actual = $this->xmlRateProvider->getRate('JPY');
        $this->assertEquals(134.03, $actual);

        $actual = $this->xmlRateProvider->getRate('IDR');
        $this->assertEquals(16297.40, $actual);
    }

}
