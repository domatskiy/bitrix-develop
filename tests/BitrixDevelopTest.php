<?php

namespace Domatskiy\Tests;

use Domatskiy\BitrixDevelop;

class BitrixDevelopTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
 
    }
    public function tearDown()
    {
        
    }

    public function test()
    {
        $CBitrixDevelop = \Domatskiy\BitrixDevelop::getInstance();
        $CBitrixDevelop->setDevelopMode(strpos($_SERVER['SERVER_NAME'], 'dev.') !== false);
        $CBitrixDevelop->sendAllEmailTo('test@test.ru');
    }

    public static function testMethod(){}

}

function call(){}