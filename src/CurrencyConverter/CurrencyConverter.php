<?php
namespace Kopernikus\CurrencyConverter;

use Kopernikus\Provider\XMLRateProvider;

/**
 * Class CurrencyConverter
 * @package Kopernikus\CurrencyConvert
 */
class CurrencyConverter
{
    /**
     * @var XMLRateProvider
     */
    private $provider;
    /**
     * @var string
     */
    private $toCurrency = null;
    /**
     * @var string
     */
    private $fromCurrency = 'EUR';

    /**
     * CurrencyConverter constructor.
     * @param XMLRateProvider $provider
     */
    public function __construct(XMLRateProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param int $amount
     * @return float
     */
    public function convert($amount = 0)
    {
        $rate = $this->getRate();
        return round($amount * $rate, 2);
    }

    /**
     * @return string
     */
    public function getFromCurrency()
    {
        if (null === $this->fromCurrency) {
            throw new \LogicException('Set from currency first!');
        }

        return $this->fromCurrency;
    }

    /**
     * @param string $fromCurrency
     * @return $this
     */
    public function setFromCurrency($fromCurrency)
    {
        if (!$this->provider->hasCode($fromCurrency)) {
            throw new \InvalidArgumentException("Currency $fromCurrency not supported");
        }

        $this->fromCurrency = $fromCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getToCurrency()
    {
        if (null === $this->toCurrency) {
            throw new \LogicException('Set to currency first!');
        }

        return $this->toCurrency;
    }

    /**
     * @param string $toCurrency
     * @return $this
     */
    public function setToCurrency($toCurrency)
    {
        if (!$this->provider->hasCode($toCurrency)) {
            throw new \InvalidArgumentException("Currency $toCurrency not supported");
        }

        $this->toCurrency = $toCurrency;

        return $this;
    }

    /**
     * @return int
     */
    public function getRate()
    {
        return $this->provider->getRate($this->toCurrency, $this->fromCurrency);
    }


}