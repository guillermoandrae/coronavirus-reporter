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
        $dom = new DOMDocument();
        @$dom->loadHTML($page);
        $xpath = new DOMXPath($dom);
        $elements = $xpath->query("//td[@class='ms-rteTableOddCol-default']");
        return (int) str_replace("\xE2\x80\x8B", '', $elements->item(count($elements)-1)->nodeValue);
    }
}
