<?php

namespace GuillermoandraeTest\Coronavirus;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Contracts\AbstractSource;
use Guillermoandrae\Coronavirus\SourceAggregator;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

final class SourceAggregatorTest extends TestCase
{
    public function testExecute()
    {
        $filesystemAdapter = new Local(realpath('tests'));
        $filesystem = new Filesystem($filesystemAdapter);
        $pool = new FilesystemCachePool($filesystem);
        $aggregator = new SourceAggregator($pool);
        $mock = $this->getMockForAbstractClass(
            AbstractSource::class,
            ['California'],
            'CaliforniaDepartmentOfHealth'
        );
        $aggregator->addSource($mock);
        $this->assertInstanceOf(
            CacheItemPoolInterface::class,
            $aggregator->getSources()[0]->getCacheItemPool()
        );
    }
}
