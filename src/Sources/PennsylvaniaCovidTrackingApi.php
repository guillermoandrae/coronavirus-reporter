<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractCovidTrackingApiSource;

final class PennsylvaniaCovidTrackingApi extends AbstractCovidTrackingApiSource
{
    protected $stateAbbr = 'PA';
}
