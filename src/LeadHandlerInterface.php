<?php

namespace TestProcess;

use LeadGenerator\Lead;

interface LeadHandlerInterface
{
    public function handle(Lead $lead): void;
}