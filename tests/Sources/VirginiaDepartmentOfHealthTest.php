<?php

namespace GuillermoandraeTest\Coronavirus\Sources;

use Guillermoandrae\Coronavirus\Sources\VirginiaDepartmentOfHealth;
use PHPUnit\Framework\TestCase;

final class VirginiaDepartmentOfHealthTest extends TestCase
{
    private $source;

    public function testGetNumConfirmedCases()
    {
        $this->assertEmpty($this->source->getNumConfirmedCases());
    }

    protected function setUp(): void
    {
        $this->source = new VirginiaDepartmentOfHealth();
    }
}
