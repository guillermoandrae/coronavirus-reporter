<?php

namespace Guillermoandrae\Coronavirus\Contracts;

abstract class AbstractDepartmentOfHealthSource extends AbstractSource
{
    /**
     * AbstractSource constructor. Derives state name if not provided.
     */
    final public function __construct()
    {
        if (empty($this->state)) {
            $name = get_called_class();
            preg_match('/\\\Sources\\\(.*)Department/', $name, $matches);
            $this->setState($matches[1]);
        }
    }
}
