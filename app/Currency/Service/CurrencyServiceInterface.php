<?php

namespace InboxAgency\Currency\Service;

interface CurrencyServiceInterface
{
    public function set($code);

    public function get();
}
