<?php

namespace Guillermoandrae\Coronavirus\Sources;

use \DOMDocument;
use \DOMXPath;
use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class PennsylvaniaDepartmentOfHealth extends AbstractSource
{
    protected $url = 'https://www.health.pa.gov/topics/disease/Pages/Coronavirus.aspx';

    public function getNumConfirmedCases(): int
    {
        $page = $this->getData();
        preg_match('/there are(.*) confirmed cases/', $page, $matches);
        return (int) str_replace([',', '&#160;', '&nbsp;'], '', $matches[1]);
    }

    public function getLastModified(): int
    {
        $page = $this->getData();
        preg_match('/count last updated at (.*)\<\/span\>/', $page, $matches);
        $parts = explode(' ', $matches[1]);
        $time = $parts[0] . ' ' . strtoupper(str_replace('.', '', $parts[1]));
        $date = $parts[3];
        $string = sprintf('%s %s', $date, $time);
        return strtotime($string);
    }
}
