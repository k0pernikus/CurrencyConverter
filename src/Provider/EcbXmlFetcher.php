<?php
namespace Kopernikus\Provider;

class EcbXmlFetcher
{
    const URL = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * @return string
     */
    public function fetch()
    {
        return file_get_contents(self::URL);
    }

}