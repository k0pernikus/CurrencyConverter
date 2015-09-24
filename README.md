# CurrencyConverter

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