<?php

namespace Guillermoandrae\Coronavirus\Contracts;

interface SourceInterface extends CacheItemPoolAwareInterface
{
    /**
     * The cache lifetime.
     */
    const CACHE_LIFETIME = 3600;

    /**
     * Sets the URL.
     *
     * @param string $url  The source URL.
     * @return SourceInterface The source.
     */
    public function setUrl(string $url): SourceInterface;

    /**
     * Returns the source URL.
     *
     * @return string  The source URL.
     */
    public function getUrl(): string;

    /**
     * Returns the source data.
     *
     * @return string  The source data.
     */
    public function getData(): string;

    /**
     * Sets the source state.
     *
     * @param string $state The source state.
     * @return SourceInterface The source.
     */
    public function setState(string $state): SourceInterface;

    /**
     * Returns the source state.
     *
     * @return string  The source state.
     */
    public function getState(): string;

    /**
     * Returns the number of confirmed cases in the state.
     *
     * @return int  Number of confirmed cases in the state.
     */
    public function getNumConfirmedCases(): int;

    /**
     * Returns the timestamp for the last time the data was modified.
     *
     * @return int  Time the data was last modified.
     */
    public function getLastModified(): int;
}
