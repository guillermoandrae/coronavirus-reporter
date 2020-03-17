<?php require 'vendor/autoload.php';

use \Guillermoandrae\Coronavirus\Reporter;
use \Guillermoandrae\Coronavirus\SourceAggregator;
use \Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use \Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use \Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;

$aggregator = new SourceAggregator();
$aggregator->addSource(new NewYorkDepartmentOfHealth());
$aggregator->addSource(new PennsylvaniaDepartmentOfHealth());
$aggregator->addSource(new GeorgiaDepartmentOfHealth());

$reporter = new Reporter($aggregator);
$reporter->execute();
