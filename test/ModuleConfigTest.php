<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ModuleConfig;

class ModuleConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $moduleConfig = new ModuleConfig();
        $config = $moduleConfig->__invoke();
        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('console_routes', $config);
    }
}