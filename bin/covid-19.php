<?php require 'vendor/autoload.php';

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Reporter;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;

$filesystemAdapter = new Local(realpath('.'));
$filesystem = new Filesystem($filesystemAdapter);
$cacheItemPool = new FilesystemCachePool($filesystem);
$aggregator = new SourceAggregator($cacheItemPool);
$aggregator->addSource(new NewYorkDepartmentOfHealth());
$aggregator->addSource(new PennsylvaniaDepartmentOfHealth());
$aggregator->addSource(new GeorgiaDepartmentOfHealth());

$reporter = new Reporter($aggregator);
$reporter->execute();
