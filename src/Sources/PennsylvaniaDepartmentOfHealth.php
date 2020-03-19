<?php

namespace Guillermoandrae\Coronavirus\Sources;

use \DOMDocument;
use \DOMXPath;
use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class PennsylvaniaDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://www.health.pa.gov/topics/disease/coronavirus/Pages/Coronavirus.aspx';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/Confirmed Cases(.*) -/', $page, $matches);
        return (int) str_replace([',', '&#160;', '&nbsp;', '&#58;'], '', trim($matches[1]));
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/last updated (.*)\<\/span\>/', $page, $matches);
        $parts = explode(' ', $matches[1]);
        $time = str_replace('&#58;', ':', $parts[4]) . ' ' . strtoupper(str_replace('.', '', $parts[5]));
        $date = implode(' ', [$parts[0], $parts[1], $parts[2]]);
        $string = sprintf('%s %s', $date, $time);
        return strtotime($string);
    }
}
