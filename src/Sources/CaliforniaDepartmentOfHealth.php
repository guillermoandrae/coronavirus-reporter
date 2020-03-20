<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class CaliforniaDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://www.cdph.ca.gov/Programs/CID/DCDC/Pages/Immunization/ncov2019.aspx';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/there are a total of (.*)positive cases/', $page, $matches);
        return (int) str_replace(',', '', $matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/As of (.*) Pacific Daylight Time/', $page, $matches);
        $parts = explode(' ', $matches[1]);
        $month = $parts[0];
        $day = str_replace(',', '', $parts[1]);
        $year = str_replace(',', '', $parts[2]);
        $time = $parts[3] . strtoupper(str_replace('.', '', $parts[4]));
        $string = sprintf('%d %s %d %s', $day, $month, $year, $time);
        return strtotime($string);
    }
}
