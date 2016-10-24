<?php

namespace ReddogsTest\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Migration;
use Doctrine\DBAL\Migrations\OutputWriter;
use Reddogs\Doctrine\Migrations\MigrateAllCommand;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class MigrateAllCommandTest extends \PHPUnit_Framework_TestCase
{
    private $configurations, $migrations, $configuration, $migration;

    protected function setUp()
    {
        $this->configuration = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->setMethods(['createMigrationTable', 'setOutputWriter'])
            ->getMock();;
        $this->configurations = ['testKey' => $this->configuration];

        $this->migration = $this->getMockBuilder(Migration::class)
            ->disableOriginalConstructor()
            ->setMethods(['migrate'])
            ->getMock();
        $this->migrations = ['testKey' => $this->migration];

        $this->command = new MigrateAllCommand($this->configurations, $this->migrations);
    }

    public function testGetConfigurations()
    {
        $this->assertSame($this->configurations, $this->command->getConfigurations());
    }

    public function testGetMigrations()
    {
        $this->assertSame($this->migrations, $this->command->getMigrations());
    }

    public function testInvoke()
    {
        $this->configuration->expects($this->once())
            ->method('createMigrationTable');

        $this->configuration->expects($this->once())
            ->method('setOutputWriter')
            ->with($this->isInstanceOf(OutputWriter::class));

        $this->migration->expects($this->once())
            ->method('migrate')
            ->will($this->returnValue(['some result line']));

        $route = new Route('mogrations:migrate-all', 'mogrations:migrate-all <moduleName>');
        $adapter = $this->createMock(AdapterInterface::class);
        $this->command->__invoke($route, $adapter);
    }

    public function testInvokeEmptyResultOutputsInfo()
    {
        $this->configuration->expects($this->once())
            ->method('createMigrationTable');

        $this->configuration->expects($this->once())
            ->method('setOutputWriter')
            ->with($this->isInstanceOf(OutputWriter::class));

        $this->migration->expects($this->once())
            ->method('migrate')
            ->will($this->returnValue([]));

        $route = new Route('mogrations:migrate-all', 'mogrations:migrate-all <moduleName>');
        $adapter = $this->getMockBuilder(AdapterInterface::class)
            ->setMethods(['writeLine'])
            ->getMockForAbstractClass();

        $adapter->expects($this->once())
                ->method('writeLine')
                ->with($this->equalTo('module \'testKey\': no migrations to execute'));
        $this->command->__invoke($route, $adapter);
    }
}