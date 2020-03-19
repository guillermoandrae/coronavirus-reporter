<?php

namespace GuillermoandraeTest\Coronavirus\Contracts;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;
use GuillermoandraeTest\Coronavirus\SourceTestCase;

final class SourceTest extends SourceTestCase
{
    public function testGetData()
    {
        $this->assertStringContainsString('Title', $this->source->getData());
    }

    public function testGetDataWithCacheItemPool()
    {
        $key = md5(get_class($this->source)) . '.cache';
        $this->source->setCacheItemPool($this->pool);
        $this->assertStringContainsString('Title', $this->source->getData());
        $this->assertEquals($this->source->getCacheItemPool()->getItem($key)->get(), $this->source->getData());
        $this->pool->clear();
        $this->assertStringContainsString('Title', $this->source->getData());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->source = $this->getMockForAbstractClass(
            AbstractSource::class,
            ['State of Mind', 'tests/Fixtures/mind.html'],
            'MindDepartmentOfHealth'
        );
    }
}
