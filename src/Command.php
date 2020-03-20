<?php

namespace Guillermoandrae\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\AbstractOutput;

final class Command extends AbstractOutput
{
    /**
     * Prints case information from each source.
     */
    public function execute()
    {
        $sources = $this->getSourceAggregator()->getSources();
        foreach ($sources as $source) {
            printf(
                'Number of confirmed cases in %s: %s (as of %s)' . PHP_EOL,
                $source->getState(),
                number_format($source->getNumConfirmedCases()),
                date('F d, Y \a\t g:i A', $source->getLastModified())
            );
        }
    }
}
