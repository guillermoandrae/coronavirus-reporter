<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;
use GuillermoandraeTest\Coronavirus\SourceTestCase;

final class GeorgiaDepartmentOfHealthTest extends SourceTestCase
{
    public function testGetNumConfirmedCases()
    {
        $this->assertSame(404, $this->source->getNumConfirmedCases());
    }

    public function testGetLastModified()
    {
        $this->assertEquals('11:34', date('h:i', $this->source->getLastModified()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->source = new GeorgiaDepartmentOfHealth('', 'tests/Fixtures/ga.html');
    }
}
