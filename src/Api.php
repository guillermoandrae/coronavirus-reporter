<?php

namespace Guillermoandrae\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\AbstractOutput;

final class Api extends AbstractOutput
{
    public function execute()
    {
        return [
            'statusCode' => 200,
            'headers' => [
                'Access-Control-Allow-Origin' => '*',
            ],
            'body' => json_encode($this->getBody()),
        ];
    }

    /**
     * Returns the response body.
     *
     * @return array The response body.
     */
    private function getBody(): array
    {
        $sources = $this->getSourceAggregator()->getSources();
        $body = [
            'meta' => [
                'counts' => count($sources)
            ],
            'data' => []
        ];
        foreach ($sources as $source) {
            $body['data'][] = [
                'state' => $source->getState(),
                'url' => $source->getUrl(),
                'numConfirmedCases' => $source->getNumConfirmedCases(),
                'updatedAt' => date(DATE_ISO8601, $source->getLastModified())
            ];
        }
        return $body;
    }
}
