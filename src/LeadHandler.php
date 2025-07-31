<?php

namespace TestProcess;

use LeadGenerator\Lead;

class LeadHandler implements LeadHandlerInterface
{
    public function handle(Lead $lead): void
    {
        sleep(2); // Эмуляция тяжелой обработки
        Logger::log($lead->id, $lead->categoryName);
    }
}
