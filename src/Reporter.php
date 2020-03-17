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

    public function __construct(SourceAggregatorInterface $sourceAggregator)
    {
        $this->sourceAggregator = $sourceAggregator;
    }

    public function getSourceAggregator(): SourceAggregatorInterface
    {
        return $this->sourceAggregator;
    }

    public function execute()
    {
        $sources = $this->getSourceAggregator()->getSources();
        foreach ($sources as $source) {
            $state = $source->getState();
            $number = $source->getNumConfirmedCases();
            printf('Number of confirmed cases in %s: %d' . PHP_EOL, $state, $number);
        }
    }
}
