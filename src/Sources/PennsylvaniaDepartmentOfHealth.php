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
        preg_match('/43afff\;\"\>(.*)\<\/span\>/', $page, $matches);
        if (!isset($matches[1])) {
            return 0;
        }
        $number = str_replace(['<span style="color: #464646; font-weight: 800;">', '</span>'], '', $matches[1]);
        return (int) StringParser::stripChars($number);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/last updated (.*)\<\/span\>/', $page, $matches);
        if (!isset($matches[1])) {
            return time();
        }
        $dateString = str_replace('&#160;', ' ', $matches[1]);
        $parts = explode(' ', str_replace(['-&nbsp;', '- '], '', $dateString));
        $time = $parts[3] . ' ' . StringParser::stripCharsMeridiem($parts[4]);
        $date = implode(' ', [$parts[0], $parts[1], $parts[2]]);
        $string = sprintf('%s %s', $date, $time);
        return strtotime($string);
    }
}
