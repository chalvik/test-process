<?php

namespace App;

interface LeadHandlerInterface
{
    public function handle(array $lead): void;
}