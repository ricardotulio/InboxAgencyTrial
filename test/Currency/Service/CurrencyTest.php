<?php

namespace InboxAgency\Currency\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\Session;

class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function mustSetCurrency()
    {
        $session = $this->createMock(Session::class);
        $service = new Currency($session);

        $currencies = $service->getCurrencies();
        $currencyCode = 'BRL';

        $session->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('currency'),
                $this->equalTo($currencies[$currencyCode])
            );


        $service->set($currencyCode);
    }

    /**
     * @test
     */
    public function mustRetrieveCurrency()
    {
        $session = $this->createMock(Session::class);
        $service = new Currency($session);

        $currencies = $service->getCurrencies();
        $currencyCode = 'BRL';

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('currency'))
            ->willReturn($currencies[$currencyCode]);

        $this->assertEquals($currencies[$currencyCode], $service->get());
    }
}
