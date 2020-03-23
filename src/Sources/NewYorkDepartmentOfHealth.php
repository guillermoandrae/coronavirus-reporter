<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractDepartmentOfHealthSource;
use Guillermoandrae\Coronavirus\Helpers\StringParser;

final class NewYorkDepartmentOfHealth extends AbstractDepartmentOfHealthSource
{
    protected $url = 'https://coronavirus.health.ny.gov/home';

    protected $state = 'New York';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/total to (.*) confirmed cases/', $page, $matches);
        if (!isset($matches[1])) {
            return 0;
        }
        return (int) StringParser::stripChars($matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/Last Updated: (.*)\<\/div\>/', $page, $matches);
        if (!isset($matches[1])) {
            return time();
        }
        $parts = explode(' ', $matches[1]);
        $month = $parts[0];
        $day = StringParser::stripChars($parts[1]);
        $year = $parts[2];
        $time = $parts[4];
        $string = sprintf('%d %s %d %s', $day, $month, $year, $time);
        return strtotime($string);
    }
}
