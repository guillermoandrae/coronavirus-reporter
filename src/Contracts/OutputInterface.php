<?php

namespace Guillermoandrae\Coronavirus\Contracts;

interface OutputInterface
{
    /**
     * Sets the SourceAggregator.
     *
     * @param SourceAggregatorInterface $sourceAggregator The SourceAggregator.
     * @return OutputInterface This object.
     */
    public function setSourceAggregator(SourceAggregatorInterface $sourceAggregator): OutputInterface;

    /**
     * Returns the SourceAggregator.
     *
     * @return SourceAggregatorInterface
     */
    public function getSourceAggregator(): SourceAggregatorInterface;

    /**
     * Outputs case information from each source.
     */
    public function execute();
}
