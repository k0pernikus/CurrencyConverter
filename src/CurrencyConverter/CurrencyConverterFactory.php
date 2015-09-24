<?php
namespace Kopernikus\CurrencyConverter;

use Kopernikus\Provider\EcbXmlFetcher;
use Kopernikus\Provider\XMLRateProvider;

/**
 * Class CurrencyConverterFactory
 * @package Kopernikus\CurrencyConverter
 */
class CurrencyConverterFactory
{
    /**
     * @return CurrencyConverter
     */
    public static function createCurrencyConverter()
    {
        $ecbRates = (new EcbXmlFetcher())->fetch();
        return new CurrencyConverter(new XMLRateProvider($ecbRates));
    }

}