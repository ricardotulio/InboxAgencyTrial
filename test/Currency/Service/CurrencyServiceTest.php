<?php

namespace InboxAgency\Currency\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\SessionInterface;

class CurrencyServiceTest extends TestCase
{
    /**
     * @test
     */
    public function mustSetCurrency()
    {
        $session = $this->createMock(SessionInterface::class);
        $currencyService = new CurrencyService($session);

        $currencies = $currencyService->getCurrencies();
        $currencyCode = 'BRL';

        $session->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('currency'),
                $this->equalTo($currencies[$currencyCode])
            );


        $currencyService->set($currencyCode);
    }

    /**
     * @test
     */
    public function mustRetrieveCurrency()
    {
        $session = $this->createMock(SessionInterface::class);
        $currencyService = new CurrencyService($session);

        $currencies = $currencyService->getCurrencies();
        $currencyCode = 'BRL';

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('currency'))
            ->willReturn($currencies[$currencyCode]);

        $this->assertEquals($currencies[$currencyCode], $currencyService->get());
    }

    /**
     * @test
     */
    public function mustRetrieveDefaultCurrency()
    {
        $session = $this->createMock(SessionInterface::class);
        $currencyService = new CurrencyService($session);

        $currencies = $currencyService->getCurrencies();

        $this->assertEquals(
            $currencies[CurrencyService::DEFAULT_CURRENCY],
            $currencyService->get()
        );
    }
}
