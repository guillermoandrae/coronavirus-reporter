<?php

namespace GuillermoandraeTest\Coronavirus;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Contract\SourceInterface;
use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

final class SourceTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var CacheItemPoolInterface
     */
    protected $pool;

    /**
     * @var string
     */
    private $expectedData = 'March';

    public function testGetData()
    {
        $this->assertStringContainsString($this->expectedData, $this->source->getData());
    }

    public function testGetDataWithCacheItemPool()
    {
        $key = md5(get_class($this->source)) . '.cache';
        $this->source->setCacheItemPool($this->pool);
        $this->assertStringContainsString($this->expectedData, $this->source->getData());
        $this->assertEquals($this->source->getCacheItemPool()->getItem($key)->get(), $this->source->getData());
        $this->pool->clear();
        $this->assertStringContainsString($this->expectedData, $this->source->getData());
    }

    protected function setUp(): void
    {
        $filesystemAdapter = new Local(realpath('tests'));
        $filesystem = new Filesystem($filesystemAdapter);
        $this->pool = new FilesystemCachePool($filesystem);
        $this->pool->clear();
        $this->source = new NewYorkDepartmentOfHealth();
        $this->source->setUrl('tests/fixtures/ny.html');
    }
}
