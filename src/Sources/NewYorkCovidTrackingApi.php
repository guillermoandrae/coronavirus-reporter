<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractCovidTrackingApiSource;

final class NewYorkCovidTrackingApi extends AbstractCovidTrackingApiSource
{
    protected $state = 'New York';

    protected $stateAbbr = 'NY';
}
