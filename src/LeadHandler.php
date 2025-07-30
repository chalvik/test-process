<?php

namespace App;

class LeadHandler implements LeadHandlerInterface
{
    public function handle(array $lead): void
    {
        sleep(2); // Эмуляция тяжелой обработки
        Logger::log($lead['id'], $lead['category']);
    }
}
