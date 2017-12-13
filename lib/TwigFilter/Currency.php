<?php

namespace InboxAgency\TwigFilter;

use InboxAgency\Currency\Service\CurrencyServiceInterface;

class Currency
{
    private $currencyService;

    public function __construct(CurrencyServiceInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function __invoke($string)
    {
        $currency = $this->currencyService->get();

        $exchangedValue = floatval($string) * $currency['rate'];

        return $currency['symbol'] . ' ' 
            . number_format($exchangedValue, 2, '.', ',');
    }
}
