<?php
namespace Kopernikus\Provider;

/**
 * Class XMLRateProvider
 * @package Kopernikus\Provider
 */
class XMLRateProvider
{
    /**
     * All rates are relative to the EURO
     */
    const ANCHOR_CURRENCY = 'EUR';

    /**
     * @var array
     */
    protected $rates;

    /**
     * @param string $ratesXml
     */
    public function __construct($ratesXml)
    {
        $xml = simplexml_load_string($ratesXml);
        $this->rates = $this->parseRates($xml);
    }

    /**
     * @param string $currencyCode
     * @return mixed
     */
    public function hasCode($currencyCode)
    {
        if ($currencyCode === static::ANCHOR_CURRENCY) {
            return true;
        }

        $keys = array_keys($this->rates);

        return in_array($currencyCode, $keys);
    }

    /**
     * @param string $toCurrencyCode
     * @param string $fromCurrency
     * @return int
     */
    public function getRate($toCurrencyCode, $fromCurrency = self::ANCHOR_CURRENCY)
    {
        if (static::ANCHOR_CURRENCY === $fromCurrency) {
            return $this->rates[$toCurrencyCode];
        }

        $rate = 1 / $this->rates[$fromCurrency];

        if (static::ANCHOR_CURRENCY !== $toCurrencyCode) {
            $rate *= $this->rates[$toCurrencyCode];
        }

        return number_format($rate, 8);
    }

    /**
     * @param $xml
     * @return mixed
     */
    protected function parseRates(\SimpleXMLElement $xml)
    {
        $rates = [];
        foreach ($xml->Cube->Cube->Cube as $rate) {
            $currencyCode = (string)$rate['currency'];
            $rates[$currencyCode] = (float)$rate['rate'];
        }

        return $rates;
    }
}