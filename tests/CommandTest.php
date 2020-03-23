<?php

namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Command;
use Guillermoandrae\Coronavirus\Contracts\AbstractCovidTrackingApiSource;
use Guillermoandrae\Coronavirus\SourceAggregator;

final class CommandTest extends AbstractOutputTestCase
{
    /**
     * Tests reporting on all sources.
     *
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
        $source = new $className();
        $source->setUrl($path);
        $aggregator->addSource($source);
        $reporter = new Command($aggregator);
        $reporter->execute();
        $output = ob_get_clean();
        $this->assertStringContainsString($state, $output);
        $this->assertStringContainsString(number_format($numConfirmedCases), $output);
        $this->assertStringContainsString($date, $output);
    }

    /**
     * Tests reporting when errors occur in all sources.
     *
     * @param string $className The source class name.
     * @param string $state The state.
     * @dataProvider getSources
     */
    public function testExecuteWithError(string $className, string $state)
    {
        $source = new $className();
        $path = 'tests/fixtures/null.';
        $path .= is_a($source, AbstractCovidTrackingApiSource::class) ? 'json' : 'html';
        $source->setUrl($path);
        $this->assertEquals(0, $source->getNumConfirmedCases());
        $this->assertEquals(time(), $source->getLastModified());
    }
}
