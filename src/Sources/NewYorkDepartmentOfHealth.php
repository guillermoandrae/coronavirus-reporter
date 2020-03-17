<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class NewYorkDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://www.health.ny.gov/diseases/communicable/coronavirus/';

    protected $state = 'New York';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        $phrase = '<td>Total Positive Cases (Statewide)</td>';
        $start = strpos($page, $phrase) + strlen($phrase);
        $limit = strpos(substr($page, $start), '</tr>');
        $segment = trim(substr($page, $start, $limit));
        preg_match('/\<td\>(.*)\<\/td\>/', $segment, $matches);
        return (int) str_replace(',', '', $matches[1]);
    }
}
