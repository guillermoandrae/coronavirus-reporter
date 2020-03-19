<?php

namespace Guillermoandrae\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\SourceAggregatorInterface;

final class Reporter
{
    /**
     * The SourceAggregator.
     *
     * @var SourceAggregatorInterface
     */
    private $sourceAggregator;

    /**
     * Reporter constructor.
     *
     * @param SourceAggregatorInterface $sourceAggregator The SourceAggregator.
     */
    public function __construct(SourceAggregatorInterface $sourceAggregator)
    {
        $this->sourceAggregator = $sourceAggregator;
    }

    /**
     * Returns the SourceAggregator.
     *
     * @return SourceAggregatorInterface
     */
    public function getSourceAggregator(): SourceAggregatorInterface
    {
        return $this->sourceAggregator;
    }

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
