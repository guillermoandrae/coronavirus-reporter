<?php declare(strict_types = 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Guillermoandrae\Coronavirus\Api;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Sources\NewYorkDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\PennsylvaniaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\GeorgiaDepartmentOfHealth;
use Guillermoandrae\Coronavirus\Sources\CaliforniaDepartmentOfHealth;

lambda(function (array $event) {
    $aggregator = new SourceAggregator();
    $aggregator->addSource(new CaliforniaDepartmentOfHealth());
    $aggregator->addSource(new GeorgiaDepartmentOfHealth());
    $aggregator->addSource(new NewYorkDepartmentOfHealth());
    $aggregator->addSource(new PennsylvaniaDepartmentOfHealth());

    $reporter = new Api($aggregator);
    return $reporter->execute();
});
