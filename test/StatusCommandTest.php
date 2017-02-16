<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ModuleConfig;
use ZF\Console\Route;
use Reddogs\Doctrine\Migrations\StatusCommand;
use PHPUnit\Framework\TestCase;

class StatusCommandTest extends TestCase
{
    private $command, $route;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(StatusCommand::class)
                              ->disableOriginalConstructor()
                              ->setMethods(['null'])
                              ->getMock();
        $moduleConfig = (new ModuleConfig())->__invoke();
        $migrateParams = $moduleConfig['console_routes']['mogrations:status'];
        $this->route = new Route($migrateParams['name'], $migrateParams['route']);
    }

    public function testGetInputCommand()
    {
        $this->assertSame('migrations:status', $this->command->getInputCommand($this->route));
    }
}