<?php

namespace InboxAgency\TwigFilter;

use PHPUnit\Framework\TestCase;

use InboxAgency\Currency\Service\CurrencyServiceInterface;

class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function mustFormatCurrency()
    {
        $currency = [
            'rate' => 1.5,
            'symbol' => 'R$'
        ];

        $currencyService = $this->createMock(CurrencyServiceInterface::class);
        $currencyService->expects($this->once())
            ->method('get')
            ->willReturn($currency);
        
        $value = strval(1342.22);
        $expected = 'R$ 2,013.33';

        $currencyFilter = new Currency($currencyService);
        $this->assertEquals(
            $expected,
            $currencyFilter($value)
        );
    }
}
