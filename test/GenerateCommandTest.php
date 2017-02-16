<?php

namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;
use PHPUnit\Framework\TestCase;

class GenerateCommandTest extends TestCase
{
    private $command, $route;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(GenerateCommand::class)
                              ->disableOriginalConstructor()
                              ->setMethods(['null'])
                              ->getMock();
        $moduleConfig = (new ModuleConfig())->__invoke();
        $migrateParams = $moduleConfig['console_routes']['mogrations:generate'];
        $this->route = new Route($migrateParams['name'], $migrateParams['route']);
    }

    public function testGetInputCommand()
    {
        $this->assertSame('migrations:generate', $this->command->getInputCommand($this->route));
    }

    public function testGetInputCommandWithParams()
    {
        $this->route->match(['mogrations:generate', 'testModuleName', '-q', '-n', '-v']);
        $this->assertEquals('migrations:generate -q -n -v', $this->command->getInputCommand($this->route));
    }
}