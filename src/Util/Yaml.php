<?php

declare(strict_types=1);

namespace JRF\Util;

use JRF\Util\File;

class Yaml
{
    public static function parseFile(string $fullFilePath): array
    {
        if (!$fullFilePath)
            return [];

        if (!$yaml = File::read($fullFilePath))
            return [];

        $decoded = yaml_parse($yaml);

        return $decoded;
    }
}
