<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\MigrateCommand;
use ZF\Console\Route;
use Reddogs\Doctrine\Migrations\ModuleConfig;
use PHPUnit\Framework\TestCase;

class MigrateCommandTest extends TestCase
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
            '--query-time', '-n', '-q', '--verbose'
        ]);
        $expected = 'migrations:migrate --dry-run --write-sql --query-time -n -q --verbose testVersion';
        $this->assertEquals($expected, $this->command->getInputCommand($this->route));
    }
}