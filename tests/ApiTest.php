<?php


namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Api;
use Guillermoandrae\Coronavirus\SourceAggregator;

final class ApiTest extends AbstractOutputTestCase
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
        $aggregator = new SourceAggregator();
        $source = new $className();
        $source->setUrl($path);
        $aggregator->addSource($source);
        $api = new Api($aggregator);
        $output = $api->execute();
        $body = json_decode($output['body'], true);
        $this->assertEquals($state, $body['data'][0]['state']);
        $this->assertEquals($path, $body['data'][0]['url']);
        $this->assertEquals($numConfirmedCases, $body['data'][0]['numConfirmedCases']);
        $this->assertEquals($date, date('F d, Y \a\t g:i A', strtotime($body['data'][0]['updatedAt'])));
    }
}
