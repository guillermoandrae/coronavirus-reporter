<?php

namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\AbstractSource;
use Guillermoandrae\Coronavirus\Reporter;
use Guillermoandrae\Coronavirus\SourceAggregator;
use PHPUnit\Framework\TestCase;

final class ReporterTest extends TestCase
{
    private $reporter;

    public function testExecute()
    {
        ob_start();
        $this->reporter->execute();
        $output = ob_get_clean();
        $this->assertStringContainsString('California', $output);
    }

    protected function setUp(): void
    {
        $aggregator = new SourceAggregator();
        $mock = $this->getMockForAbstractClass(
            AbstractSource::class,
            ['California'],
            'CaliforniaDepartmentOfHealth'
        );
        $aggregator->addSource($mock);
        $this->reporter = new Reporter($aggregator);
    }
}
