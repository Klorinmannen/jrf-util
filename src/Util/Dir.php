<?php

declare(strict_types=1);

namespace Projom\Util;

use Projom\Util\File;

class Dir
{
    /** 
     * Returns the system path, the root directory of the project.
     * Defaults to 'vendor', which is common in Composer-based projects.
     * 
     * * @param string $from The directory from which to find the system path.
     *
     * * Example: '/home/user/my-webapp.com/vendor/package/src/Util/Dir.php' returns '/home/user/my-webapp.com/'.
     */
    public static function systemRoot(string $from = 'vendor'): string
    {
        $dir = __DIR__;
        $srcPos = strpos($dir, $from);
        if ($srcPos === false)
            return '';

        $systemPath = substr($dir, 0, $srcPos);
        $systemPath = rtrim($systemPath, DIRECTORY_SEPARATOR);

        return $systemPath;
    }

    public static function parse(string $fullDirPath): array
    {
        $readable = Dir::isReadable($fullDirPath);
        if (!$readable)
            return [];

        $fileList = scandir($fullDirPath);
        if (!$fileList)
            return [];

        $fileList = static::cleanFileList($fileList);
        $fileList = static::prependfullDirPath($fullDirPath, $fileList);

        $parsedFileList = File::parseList($fileList);

        return $parsedFileList;
    }

    public static function isReadable(string $fullDirPath): bool
    {
        if (!$fullDirPath)
            return false;
        if (!is_dir($fullDirPath))
            return false;
        if (!is_readable($fullDirPath))
            return false;
        return true;
    }

    public static function create(string $fullDirPath, int $permission = 0777, bool $recursive = false): bool
    {
        if (is_dir($fullDirPath))
            return true;

        $isCreated = mkdir($fullDirPath, $permission, $recursive);
        return $isCreated;
    }

    public static function cleanFileList(array $fileList): array
    {
        $unwanted = [
            '.',
            '..'
        ];
        return array_diff($fileList, $unwanted);
    }

    public static function prependfullDirPath(string $fullDirPath, array $fileList): array
    {
        return array_map(fn($file) => $fullDirPath . DIRECTORY_SEPARATOR . $file, $fileList);
    }
}
