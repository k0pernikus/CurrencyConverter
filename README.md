# CurrencyConverter

# Installation

[Get composer](https://getcomposer.org/) and then require the library using:

```
composer require k0pernikus/currency-converter
```

Currency Converter supporting the [European Central Bank XML](http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml).

# Usage
```
    $converter = CurrencyConverterFactory::createCurrencyConverter();

    $euroPrice = 1337;

    $usdPrice = $converter
        ->setFromCurrency('EUR')
        ->setToCurrency('USD')
        ->convert($euroPrice);
```

# TODO:

* symfony2 bundle
