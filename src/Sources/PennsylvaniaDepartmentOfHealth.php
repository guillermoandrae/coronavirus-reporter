<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractDepartmentOfHealthSource;
use Guillermoandrae\Coronavirus\Helpers\StringParser;

final class PennsylvaniaDepartmentOfHealth extends AbstractDepartmentOfHealthSource
{
    protected $url = 'https://www.health.pa.gov/topics/disease/coronavirus/Pages/Coronavirus.aspx';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/Confirmed Cases(.*)\<\/span\>/', $page, $matches);
        if (!isset($matches[1])) {
            return 0;
        }
        return (int) StringParser::stripChars($matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/last updated (.*)\<\/span\>/', $page, $matches);
        if (!isset($matches[1])) {
            return time();
        }
        $parts = explode(' ', $matches[1]);
        $time = str_replace('&#58;', ':', $parts[4]) . ' ' . StringParser::stripCharsMeridiem($parts[5]);
        $date = implode(' ', [$parts[0], $parts[1], $parts[2]]);
        $string = sprintf('%s %s', $date, $time);
        return strtotime($string);
    }
}
