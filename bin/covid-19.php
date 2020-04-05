<?php declare(strict_types = 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Command;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\CaliforniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\GeorgiaCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\NewYorkCovidTrackingApi;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\VirginiaCovidTrackingApi;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

$filesystemAdapter = new Local(dirname(__DIR__));
$filesystem = new Filesystem($filesystemAdapter);
$cacheItemPool = new FilesystemCachePool($filesystem);

$aggregator = new SourceAggregator($cacheItemPool);
$aggregator->addSource(new NewYorkCovidTrackingApi());
$aggregator->addSource(new PennsylvaniaDepartmentOfHealth());
$aggregator->addSource(new GeorgiaCovidTrackingApi());
$aggregator->addSource(new CaliforniaDepartmentOfHealth());
$aggregator->addSource(new VirginiaCovidTrackingApi());

$reporter = new Command($aggregator);
$reporter->execute();
