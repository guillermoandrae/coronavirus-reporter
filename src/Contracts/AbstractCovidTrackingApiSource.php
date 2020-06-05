<?php

namespace Guillermoandrae\Coronavirus\Contracts;

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
        $this->setUrl(sprintf('https://covidtracking.com/api/states?state=%s', strtolower($this->stateAbbr)));
    }

    public function getNumConfirmedCases(): int
    {
        $page = json_decode($this->getData(), true);
        if (!isset($page['positive'])) {
            return 0;
        }
        return (int) $page['positive'];
    }

    public function getLastModified(): int
    {
        $page = json_decode($this->getData(), true);
        if (!isset($page['dateModified'])) {
            return time();
        }
        return strtotime(str_replace('1970', '2020', $page['dateModified']));
    }
}
