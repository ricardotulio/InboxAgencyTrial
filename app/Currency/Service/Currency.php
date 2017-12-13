<?php

namespace InboxAgency\Currency\Service;

use InboxAgency\Session\Session;

class Currency
{
    const CURRENCY_DEFAULT = 'BRL';

    private $session;

    private $currencies = [
        'BRL' => [
            'symbol' => 'R$',
            'rate' => 3.9
        ],
        'EUR' => [
            'symbol' => '€',
            'rate' => 1
        ],
        'USD' => [
            'symbol' => 'U$',
            'rate' => 1.17
        ],
    ];

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function set($code)
    {
        return $this->session->set('currency', $this->currencies[$code]);
    }

    public function get()
    {
        $currency = $this->session->get('currency');

        if ($currency == null) {
            $currency = $this->currencies[self::CURRENCY_DEFAULT];
        }

        return $currency;
    }
}
