<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use GuillermoandraeTest\Coronavirus\SourceTestCase;

final class PennsylvaniaDepartmentOfHealthTest extends SourceTestCase
{
    public function testGetNumConfirmedCases()
    {
        $this->assertStringContainsString(412, $this->source->getNumConfirmedCases());
    }

    public function testGetLastModified()
    {
        $this->assertEquals('12:45', date('h:i', $this->source->getLastModified()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->source = new PennsylvaniaDepartmentOfHealth('', 'tests/Fixtures/pa.html');
    }
}
