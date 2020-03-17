<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class VirginiaDepartmentOfHealth extends AbstractSource
{
    public function getNumConfirmedCases(): int
    {
        return 0; // can't get the data out of tableau
    }
}
