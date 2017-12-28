<?php

namespace Tests\Unit\Core;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public $request;

    public function setUp()
    {
        $this->request = new \App\Core\Request();
    }

    public function testRequestUriReturnArray()
    {
        $this->assertInternalType('array', DS);
    }
}