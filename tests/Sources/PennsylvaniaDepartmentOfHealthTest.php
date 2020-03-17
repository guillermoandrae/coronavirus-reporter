<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use PHPUnit\Framework\TestCase;

final class PennsylvaniaDepartmentOfHealthTest extends TestCase
{
    private $source;

    public function testGetNumConfirmedCases()
    {
        $this->assertStringContainsString(412, $this->source->getNumConfirmedCases());
    }

    protected function setUp(): void
    {
        $this->source = new PennsylvaniaDepartmentOfHealth('', 'tests/Fixtures/pa.html');
    }
}
