<?php

namespace Delta935142\Mitake\Tests;

//use PHPUnit\Framework\TestCase;
use Delta935142\Mitake\Newsletter;

class NewsletterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * send test
     *
     * @return void
     */
    public function test_send()
    {
        $newsletter = new Newsletter();
        $response = $newsletter->smSend('123456789', '測試簡訊');

        $this->assertEquals(true, $response['success']);
    }

    /**
     * query test
     *
     * @return void
     */
    public function test_query()
    {
        $newsletter = new Newsletter();
        $response = $newsletter->smQuery();

        $this->assertEquals(true, $response['success']);
    }
}
