<?php

require_once __DIR__ . '/vendor/autoload.php';

use TestProcess\LeadProcessor;
use LeadGenerator\Generator;
use LeadGenerator\Lead;

$generator = new Generator();

$queue = new SplQueue();
$generator->generateLeads(10000, function(Lead $lead) use ($queue) {
    $queue->enqueue($lead);
});

$processor = new LeadProcessor();
$processor->processQueue($queue);

echo "Обработка завершена. Лог записан в log.txt\n";
