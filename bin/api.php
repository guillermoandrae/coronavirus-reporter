<?php declare(strict_types = 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Aws\S3\S3Client;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Api;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\CaliforniaCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\GeorgiaCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\NewYorkCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\VirginiaCovidTrackingApi;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

lambda(function (array $event) {
    $s3client = new S3Client([
        'region' => 'us-east-1',
        'version' => 'latest'
    ]);
    $s3Adapter = new AwsS3Adapter($s3client, 'coronavirus-reporter');
    $filesystem = new Filesystem($s3Adapter);
    $cacheItemPool = new FilesystemCachePool($filesystem);

    $aggregator = new SourceAggregator($cacheItemPool);
    $aggregator->addSource(new CaliforniaCovidTrackingApi());
    $aggregator->addSource(new GeorgiaCovidTrackingApi());
    $aggregator->addSource(new NewYorkCovidTrackingApi());
    $aggregator->addSource(new PennsylvaniaCovidTrackingApi());
    $aggregator->addSource(new VirginiaCovidTrackingApi());

    $reporter = new Api($aggregator);
    return $reporter->execute();
});
