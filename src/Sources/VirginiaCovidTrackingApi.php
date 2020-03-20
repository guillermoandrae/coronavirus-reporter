<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractCovidTrackingApiSource;

final class VirginiaCovidTrackingApi extends AbstractCovidTrackingApiSource
{
    protected $stateAbbr = 'VA';
}
