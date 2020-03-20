<?php declare(strict_types = 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Command;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Source\NewYorkDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Source\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Source\GeorgiaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Source\CaliforniaDepartmentOfHealth;

$filesystemAdapter = new Local(dirname(__DIR__));
$filesystem = new Filesystem($filesystemAdapter);
$cacheItemPool = new FilesystemCachePool($filesystem);

$aggregator = new SourceAggregator($cacheItemPool);
$aggregator->addSource(new NewYorkDepartmentOfHealth());
$aggregator->addSource(new PennsylvaniaDepartmentOfHealth());
$aggregator->addSource(new GeorgiaDepartmentOfHealth());
$aggregator->addSource(new CaliforniaDepartmentOfHealth());

$reporter = new Command($aggregator);
$reporter->execute();
