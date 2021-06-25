<?php

namespace Delta935142\Mitake\Tests;

//use PHPUnit\Framework\TestCase;
use Delta935142\Mitake\Newsletter;

class NewsletterTest extends TestCase
{
    /**
     * send test
     *
     * @return void
     */
    public function test_send()
    {
        $response = Newsletter::smSend('0972358078', '測試簡訊');

        $this->assertEquals(true, $response['success']);
    }

    /**
     * query test
     *
     * @return void
     */
    /*public function test_query()
    {
        $response = Newsletter::smQuery();

        $this->assertEquals(true, $response['success']);
    }*/
}
