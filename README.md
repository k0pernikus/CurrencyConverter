# CurrencyConverter [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/k0pernikus/currencyconverter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/k0pernikus/CurrencyConverter/?branch=master)

## About
Currency Converter supporting the [European Central Bank XML](http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml).

## Installation

[Get composer](https://getcomposer.org/) and then require the library using:

```
composer require k0pernikus/currency-converter
```

## Usage
```
    $converter = CurrencyConverterFactory::createCurrencyConverter();

    $euroPrice = 1337;

    $usdPrice = $converter
        ->setFromCurrency('EUR')
        ->setToCurrency('USD')
        ->convert($euroPrice);
```

## TODOs

* symfony2 bundle
