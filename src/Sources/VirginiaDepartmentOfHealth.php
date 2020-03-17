<?php

namespace Guillermoandrae\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;

final class VirginiaDepartmentOfHealth extends AbstractSource
{
    public function getNumConfirmedCases(): int
    {
        return 0;
    }
}
