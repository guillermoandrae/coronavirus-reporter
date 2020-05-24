<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractDepartmentOfHealthSource;
use Guillermoandrae\Coronavirus\Helpers\StringParser;

final class CaliforniaDepartmentOfHealth extends AbstractDepartmentOfHealthSource
{
    protected $url = 'https://www.cdph.ca.gov/Programs/CID/DCDC/Pages/Immunization/ncov2019.aspx';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/there are a total of(.*)positive cases/', $page, $matches);
        if (!isset($matches[1])) {
            return 0;
        }
        return (int) StringParser::stripChars($matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/As of (.*) Pacific Daylight Time/', $page, $matches);
        if (!isset($matches[1])) {
            return time();
        }
        $parts = explode(' ', $matches[1]);
        $month = $parts[0];
        $day = StringParser::stripChars($parts[1]);
        $year = StringParser::stripChars($parts[2]);
        $time = $parts[3] . StringParser::stripCharsMeridiem($parts[4]);
        $string = sprintf('%d %s %d %s', $day, $month, $year, $time);
        return strtotime($string);
    }
}
