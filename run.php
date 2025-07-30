<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\LeadProcessor;

$leads = [];

// Запуск обработки
$processor = new LeadProcessor();
$processor->process($leads);

echo "Обработка завершена. Лог записан в log.txt\n";
