<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use GuillermoandraeTest\Coronavirus\SourceTestCase;

final class NewYorkDepartmentOfHealthTest extends SourceTestCase
{
    public function testGetNumConfirmedCases()
    {
        $this->assertStringContainsString(7180, $this->source->getNumConfirmedCases());
    }

    public function testGetLastModified()
    {
        $this->assertEquals('02:03', date('h:i', $this->source->getLastModified()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->source = new NewYorkDepartmentOfHealth('', 'tests/Fixtures/ny.html');
    }
}
