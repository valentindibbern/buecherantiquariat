<?php
declare(strict_types=1);

namespace App\Models;

use Exception;

class FileModel
{
    public static function getFileContent(string $path): array
    {
        if (!file_exists($path)) {
            throw new Exception("File not found at: $path");
        }
        return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}

?>
