<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\MigrateCommand;
use Reddogs\Doctrine\Migrations\MigrateAllCommand;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class MigrateAllCommandTest extends \PHPUnit_Framework_TestCase
{
    private $command, $migrateCommand, $migrationsConfig;

    protected function setUp()
    {
        $this->migrateCommand = $this->getMockBuilder(MigrateCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['__invoke'])
            ->getMock();

        $this->migrationsConfig = [
            'testKey1' => [],
            'testKey2' => [],
        ];

        $this->command = new MigrateAllCommand($this->migrateCommand, $this->migrationsConfig);
    }

    public function testGetMigrateCommand()
    {
        $this->assertSame($this->migrateCommand, $this->command->getMigrateCommand());
    }

    public function testGetMigrationsConfig()
    {
        $this->assertSame($this->migrationsConfig, $this->command->getMigrationsConfig());
    }

    public function testInvoke()
    {
        $route = new Route('mogrations:migrate-all', 'mogrations:migrate-all');
        $console = $this->createMock(AdapterInterface::class);

        $migrateRoute1 = new Route('migrations:migrate', 'migrations:migrate testKey1');
        $migrateRoute2 = new Route('migrations:migrate', 'migrations:migrate testKey2');

        $this->migrateCommand->expects($this->at(0))
            ->method('__invoke')
            ->with($this->equalTo($migrateRoute1),
                   $this->equalTo($console));

        $this->migrateCommand->expects($this->at(1))
            ->method('__invoke')
            ->with($this->equalTo($migrateRoute2),
                   $this->equalTo($console));

        $this->command->__invoke($route, $console);
    }
}