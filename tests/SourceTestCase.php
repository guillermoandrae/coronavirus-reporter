<?php

namespace GuillermoandraeTest\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\SourceInterface;
use PHPUnit\Framework\TestCase;

abstract class SourceTestCase extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    protected function setUp(): void
    {
        $path = realpath('cache');
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if (strstr($file, '.cache')) {
                    unlink($path  . '/' . $file);
                }
            }
            closedir($handle);
        }
    }
}
