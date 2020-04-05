<?php

namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Sources\CaliforniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\GeorgiaCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\NewYorkCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\VirginiaCovidTrackingApi;
use PHPUnit\Framework\TestCase;

abstract class AbstractOutputTestCase extends TestCase
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
    abstract public function testExecute(
        string $className,
        string $state,
        string $path,
        string $numConfirmedCases,
        string $date
    );

    public function getSources(): array
    {
        return [
            [
                GeorgiaCovidTrackingApi::class,
                'Georgia',
                'tests/fixtures/ga.json',
                '404',
                'March 20, 2020 at 5:00 AM'
            ],
            [
                NewYorkCovidTrackingApi::class,
                'New York',
                'tests/fixtures/ny.json',
                '7180',
                'March 20, 2020 at 5:00 AM'
            ],
            [
                PennsylvaniaDepartmentOfHealth::class,
                'Pennsylvania',
                'tests/fixtures/pa.html',
                '412',
                'March 17, 2020 at 12:45 PM'
            ],
            [
                CaliforniaDepartmentOfHealth::class,
                'California',
                'tests/fixtures/ca.html',
                '415',
                'March 18, 2020 at 6:00 PM'
            ],
            [
                VirginiaCovidTrackingApi::class,
                'Virginia',
                'tests/fixtures/va.json',
                '757',
                'March 20, 2020 at 5:00 AM'
            ],
        ];
    }
}
