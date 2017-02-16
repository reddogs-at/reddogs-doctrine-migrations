<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\LatestCommand;
use Reddogs\Doctrine\Migrations\ModuleConfig;
use ZF\Console\Route;
use PHPUnit\Framework\TestCase;

class LatestCommandTest extends TestCase
{
    private $command, $route;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(LatestCommand::class)
                              ->disableOriginalConstructor()
                              ->setMethods(['null'])
                              ->getMock();
        $moduleConfig = (new ModuleConfig())->__invoke();
        $migrateParams = $moduleConfig['console_routes']['mogrations:latest'];
        $this->route = new Route($migrateParams['name'], $migrateParams['route']);
    }

    public function testGetInputCommand()
    {
        $this->assertSame('migrations:latest', $this->command->getInputCommand($this->route));
    }
}