<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractCovidTrackingApiSource;

final class CaliforniaCovidTrackingApi extends AbstractCovidTrackingApiSource
{
    protected $stateAbbr = 'CA';
}
