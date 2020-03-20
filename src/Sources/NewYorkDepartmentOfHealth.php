<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contract\AbstractSource;

final class NewYorkDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://coronavirus.health.ny.gov/home';

    protected $state = 'New York';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/statewide total to (.*) cases/', $page, $matches);
        return (int) str_replace(',', '', $matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/Last Updated: (.*)\<\/div\>/', $page, $matches);
        $parts = explode(' ', $matches[1]);
        $month = $parts[0];
        $day = str_replace(',', '', $parts[1]);
        $year = $parts[2];
        $time = $parts[4];
        $string = sprintf('%d %s %d %s', $day, $month, $year, $time);
        return strtotime($string);
    }
}
