<?php

namespace Guillermoandrae\Coronavirus\Contracts;

abstract class AbstractSource implements SourceInterface
{
    protected $url = '';

    protected $state = '';

    public function __construct(string $state = '', string $url = '')
    {
        if (!empty($state)) {
            $this->state = $state;
        } elseif (empty($this->state)) {
            $name = get_called_class();
            preg_match('/\\\Sources\\\(.*)Department/', $name, $matches);
            $this->state = $matches[1];
        }

        if (!empty($url)) {
            $this->url = $url;
        }
    }

    final public function getUrl(): string
    {
        return $this->url;
    }

    final public function getData(): string
    {
        $key = md5(get_called_class());
        $path = sprintf('cache/%s.cache', $key);
        $age = time() - filemtime(realpath($path));
        if (file_exists($path) && $age < SourceInterface::CACHE_LIFETIME) {
            return file_get_contents($path);
        } else {
            $data = file_get_contents($this->getUrl());
            file_put_contents($path, $data);
            return $data;
        }
    }

    final public function getState(): string
    {
        return $this->state;
    }
}
