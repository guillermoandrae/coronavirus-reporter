<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

class GeorgiaDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://dph.georgia.gov/covid-19-daily-status-report';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        $phrase = '<td>Total</td>';
        $start = strpos($page, $phrase) + strlen($phrase);
        $limit = strpos(substr($page, $start), '</tr>');
        $segment = trim(substr($page, $start, $limit));
        preg_match('/\<td\>(.*)\<\/td\>/', $segment, $matches);
        return (int) $matches[1];
    }
}