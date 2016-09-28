<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\MigrateCommand;
use ZF\Console\Route;
use Reddogs\Doctrine\Migrations\ModuleConfig;

class MigrateCommandTest extends \PHPUnit_Framework_TestCase
{
    private $command, $route;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(MigrateCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['null'])
            ->getMock();
        $moduleConfig = (new ModuleConfig())->__invoke();
        $migrateParams = $moduleConfig['console_routes']['mogrations:migrate'];
        $this->route = new Route($migrateParams['name'], $migrateParams['route']);
    }

    public function testGetInputCommand()
    {
        $this->route->match(['mogrations:migrate']);
        $this->assertSame('migrations:migrate', $this->command->getInputCommand($this->route));
    }

    public function testGetInputCommandWithParams()
    {
        $this->route->match([
            'mogrations:migrate', 'testModuleName', '--version=testVersion', '--dry-run', '--write-sql',
            '--query-time', '-n', '--verbose'
        ]);
        $expected = 'migrations:migrate --dry-run --write-sql --query-time -n --verbose testVersion';
        $this->assertEquals($expected, $this->command->getInputCommand($this->route));
    }

    public function testGetInputCommandVerboseNormal()
    {
        $this->route->match([
            'mogrations:migrate', 'testModuleName', '-v'
        ]);
        $this->assertEquals('migrations:migrate -v', $this->command->getInputcommand($this->route));
    }

    public function testGetInputCommandVerboseMore()
    {
        $this->route->match([
            'mogrations:migrate', 'testModuleName', '-vv'
        ]);
        $this->assertEquals('migrations:migrate -vv', $this->command->getInputcommand($this->route));
    }

    public function testGetInputCommandVerboseDebug()
    {
        $this->route->match([
            'mogrations:migrate', 'testModuleName', '-vvv'
        ]);
        $this->assertEquals('migrations:migrate -vvv', $this->command->getInputcommand($this->route));
    }
}