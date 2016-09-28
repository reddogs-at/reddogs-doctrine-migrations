<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ModuleConfig;
use ZF\Console\Route;
use Reddogs\Doctrine\Migrations\ExecuteCommand;

class ExecuteCommandTest extends \PHPUnit_Framework_TestCase
{
    private $command, $route;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(ExecuteCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['null'])
            ->getMock();
        $moduleConfig = (new ModuleConfig())->__invoke();
        $migrateParams = $moduleConfig['console_routes']['mogrations:execute'];
        $this->route = new Route($migrateParams['name'], $migrateParams['route']);
    }

    public function testGetInputCommand()
    {
        $this->route->match(['mogrations:execute']);
        $this->assertSame('migrations:execute', $this->command->getInputCommand($this->route));
    }

    public function testGetInputCommandWithParams()
    {
        $this->route->match([
            'mogrations:execute', 'testModuleName', '--version=testVersion', '--dry-run', '--write-sql',
            '--query-time', '-n', '-q', '--verbose'
        ]);
        $expected = 'migrations:execute --dry-run --write-sql --query-time -n -q --verbose testVersion';
        $this->assertEquals($expected, $this->command->getInputCommand($this->route));
    }
}