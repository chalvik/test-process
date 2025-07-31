<?php

namespace TestProcess;

class LeadProcessor
{
    private const MAX_PROCESSES = 16;

    public function processQueue(\SplQueue $queue): void
    {
        $children = [];

        // Делим очередь на равные части
        $chunks = $this->splitQueue($queue, self::MAX_PROCESSES);

        foreach ($chunks as $chunk) {
            $pid = pcntl_fork();

            if ($pid === -1) {
                throw new \RuntimeException('Не удалось создать дочерний процесс');
            } elseif ($pid === 0) {
                // Дочерний процесс
                $handler = new LeadHandler();

                foreach ($chunk as $lead) {
                    try {
                        $handler->handle($lead);
                    } catch (\Throwable $e) {
                        // Здесь можно логировать исключения
                    }
                }

                exit(0);
            } else {
                $children[] = $pid;
            }
        }

        // Ожидаем завершения всех дочерних процессов
        foreach ($children as $pid) {
            pcntl_waitpid($pid, $status);
        }
    }

    private function splitQueue(\SplQueue $queue, int $parts): array
    {
        $total = $queue->count();
        $chunkSize = (int)ceil($total / $parts);
        $chunks = [];

        for ($i = 0; $i < $parts; $i++) {
            $chunk = [];

            for ($j = 0; $j < $chunkSize && !$queue->isEmpty(); $j++) {
                $chunk[] = $queue->dequeue();
            }

            if (!empty($chunk)) {
                $chunks[] = $chunk;
            }
        }

        return $chunks;
    }
}
