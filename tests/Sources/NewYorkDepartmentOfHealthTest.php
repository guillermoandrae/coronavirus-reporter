<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use PHPUnit\Framework\TestCase;

final class NewYorkDepartmentOfHealthTest extends TestCase
{
    private $source;

    public function testGetNumConfirmedCases()
    {
        $this->assertStringContainsString(718, $this->source->getNumConfirmedCases());
    }

    protected function setUp(): void
    {
        $this->source = new NewYorkDepartmentOfHealth('', 'tests/Fixtures/ny.html');
    }
}
