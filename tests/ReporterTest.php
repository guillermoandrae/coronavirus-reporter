<?php

namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Reporter;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use PHPUnit\Framework\TestCase;

final class ReporterTest extends TestCase
{
    /**
     * @param string $className The source class name.
     * @param string $state The state.
     * @param string $path The path to the fixture data.
     * @param string $numConfirmedCases The number of cases.
     * @param string $date The date.
     * @dataProvider getSources
     */
    public function testExecute(string $className, string $state, string $path, string $numConfirmedCases, string $date)
    {
        ob_start();
        $aggregator = new SourceAggregator();
        $source = new $className('', $path);
        $aggregator->addSource($source);
        $reporter = new Reporter($aggregator);
        $reporter->execute();
        $output = ob_get_clean();
        $this->assertStringContainsString($state, $output);
        $this->assertStringContainsString($numConfirmedCases, $output);
        $this->assertStringContainsString($date, $output);
    }

    public function getSources(): array
    {
        return [
            [
                GeorgiaDepartmentOfHealth::class,
                'Georgia',
                'tests/Fixtures/ga.html',
                '404',
                'March 17, 2020 at 11:34 AM'
            ],
            [
                NewYorkDepartmentOfHealth::class,
                'New York',
                'tests/Fixtures/ny.html',
                '7,180',
                'March 17, 2020 at 2:03 PM'
            ],
            [
                PennsylvaniaDepartmentOfHealth::class,
                'Pennsylvania',
                'tests/Fixtures/pa.html',
                '412',
                'March 17, 2020 at 12:45 PM'
            ],
        ];
    }
}
