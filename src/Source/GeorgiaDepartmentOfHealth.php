<?php

namespace Guillermoandrae\Coronavirus\Source;

use Guillermoandrae\Coronavirus\Contract\AbstractSource;

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

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/\<em\>Report generated on: (.*)\<\/em\>/', $page, $matches);
        return strtotime($matches[1]);
    }
}
