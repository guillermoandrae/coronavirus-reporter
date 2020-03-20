<?php

namespace Guillermoandrae\Coronavirus\Contracts;

abstract class AbstractOutput implements OutputInterface
{
    /**
     * The SourceAggregator.
     *
     * @var SourceAggregatorInterface
     */
    protected $sourceAggregator;

    /**
     * Reporter constructor.
     *
     * @param SourceAggregatorInterface $sourceAggregator The SourceAggregator.
     */
    public function __construct(SourceAggregatorInterface $sourceAggregator)
    {
        $this->setSourceAggregator($sourceAggregator);
    }

    /**
     * Sets the SourceAggregator.
     *
     * @param SourceAggregatorInterface $sourceAggregator The SourceAggregator.
     * @return OutputInterface This object.
     */
    final public function setSourceAggregator(SourceAggregatorInterface $sourceAggregator): OutputInterface
    {
        $this->sourceAggregator = $sourceAggregator;
        return $this;
    }

    /**
     * Returns the SourceAggregator.
     *
     * @return SourceAggregatorInterface
     */
    final public function getSourceAggregator(): SourceAggregatorInterface
    {
        return $this->sourceAggregator;
    }
}
