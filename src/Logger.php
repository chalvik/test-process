<?php

namespace TestProcess;

class Logger
{
    public static function log(string $id, string $category): void
    {
        $line = sprintf("%s | %s | %s\n", $id, $category, date('Y-m-d H:i:s'));
        file_put_contents(__DIR__ . '/../log.txt', $line, FILE_APPEND | LOCK_EX);
    }
}
