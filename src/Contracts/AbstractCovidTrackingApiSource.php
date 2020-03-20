<?php

namespace Guillermoandrae\Coronavirus\Contracts;

use Guillermoandrae\Coronavirus\Helpers\StringParser;

abstract class AbstractCovidTrackingApiSource extends AbstractSource
{
    /**
     * The state abbreviation.
     *
     * @var string
     */
    protected $stateAbbr = '';

    public function __construct()
    {
        if (empty($this->state)) {
            $name = get_called_class();
            preg_match('/\\\Sources\\\(.*)Covid/', $name, $matches);
            $this->setState($matches[1]);
        }
        $this->setUrl('https://covidtracking.com/api/states?state=%s', $this->stateAbbr);
    }

    public function getNumConfirmedCases(): int
    {
        $page = json_decode($this->getData(), true);
        return (int) $page['positive'];
    }

    public function getLastModified(): int
    {
        $page = json_decode($this->getData(), true);
        return strtotime(str_replace('1970', '2020', $page['dateModified']));
    }
}
