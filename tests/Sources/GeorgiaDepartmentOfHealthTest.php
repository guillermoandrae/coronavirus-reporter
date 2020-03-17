<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Contracts\SourceInterface;
use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;
use PHPUnit\Framework\TestCase;

final class GeorgiaDepartmentOfHealthTest extends TestCase
{
    private $source;

    public function testGetData()
    {
        $path = 'cache/' . md5(GeorgiaDepartmentOfHealth::class) . '.cache';
        $this->assertSame(404, $this->source->getNumConfirmedCases());
        $this->assertSame(file_get_contents($path), file_get_contents($this->source->getUrl()));
        touch($path, time() - (SourceInterface::CACHE_LIFETIME + 1));
        $this->assertSame(404, $this->source->getNumConfirmedCases());
    }

    protected function setUp(): void
    {
        $this->source = new GeorgiaDepartmentOfHealth('', 'tests/Fixtures/ga.html');
    }
}
