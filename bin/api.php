<?php declare(strict_types = 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Aws\S3\S3Client;
use League\Flysystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Api;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\CaliforniaDepartmentOfHealth;

lambda(function (array $event) {
    $s3client = new S3Client([
        'region' => 'us-east-1',
        'version' => 'latest'
    ]);
    $s3Adapter = new AwsS3Adapter($s3client, 'coronavirus-reporter');
    $filesystem = new Filesystem($s3Adapter);
    $cacheItemPool = new FilesystemCachePool($filesystem);

    $aggregator = new SourceAggregator($cacheItemPool);
    $aggregator->addSource(new CaliforniaDepartmentOfHealth());
    $aggregator->addSource(new GeorgiaDepartmentOfHealth());
    $aggregator->addSource(new NewYorkDepartmentOfHealth());
    $aggregator->addSource(new PennsylvaniaDepartmentOfHealth());

    $reporter = new Api($aggregator);
    return $reporter->execute();
});