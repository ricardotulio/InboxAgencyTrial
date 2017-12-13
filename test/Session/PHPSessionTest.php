<?php

namespace InboxAgency\Session;

use PHPUnit\Framework\TestCase;

class PHPSessionTest extends TestCase
{
    /**
     * @test
     */
    public function mustSetAndGetItem()
    {
        $session = new PHPSession();

        $item = new \stdClass;
        $item->id = 10;
        $item->name = 'teste';

        $session->set('teste', $item);
        $itemRetrieved = $session->get('teste');

        $this->assertEquals($item, $itemRetrieved);
    }

    /**
     * @test
     */
    public function mustReturnFalseWhenHasNoItem()
    {
        $session = new PHPSession();

        $this->assertFalse($session->get('bla'));
    }
}
