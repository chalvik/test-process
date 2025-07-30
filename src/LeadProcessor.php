<?php

namespace App;

class LeadProcessor
{
    private const MAX_PROCESSES = 16;

    public function process(array $leads): void
    {
        $chunks = array_chunk($leads, ceil(count($leads) / self::MAX_PROCESSES));
        $children = [];

        foreach ($chunks as $chunk) {
            $pid = pcntl_fork();
            if ($pid === -1) {
                throw new \RuntimeException('Cannot fork process');
            } elseif ($pid === 0) {

            } else {
                $children[] = $pid;
            }
        }

        foreach ($children as $child) {
            pcntl_waitpid($child, $status);
        }
    }
}
