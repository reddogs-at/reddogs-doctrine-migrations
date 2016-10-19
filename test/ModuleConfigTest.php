<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ModuleConfig;
use Reddogs\Doctrine\Migrations\GenerateCommand;
use Reddogs\Doctrine\Migrations\LatestCommand;
use Reddogs\Doctrine\Migrations\MigrateCommand;
use Reddogs\Doctrine\Migrations\MigrateAllCommand;
use Reddogs\Doctrine\Migrations\ExecuteCommand;
use Reddogs\Doctrine\Migrations\StatusCommand;
use Reddogs\Doctrine\Migrations\CommandFactory;
use Reddogs\Doctrine\Migrations\MigrateAllCommandFactory;

class ModuleConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $moduleConfig = new ModuleConfig();
        $config = $moduleConfig->__invoke();
        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('console_routes', $config);
        $this->assertArrayHasKey('dependencies', $config);

        $factories = $config['dependencies']['factories'];

        $this->assertEquals(CommandFactory::class, $factories[ExecuteCommand::class]);
        $this->assertEquals(CommandFactory::class, $factories[GenerateCommand::class]);
        $this->assertEquals(CommandFactory::class, $factories[LatestCommand::class]);
        $this->assertEquals(CommandFactory::class, $factories[MigrateCommand::class]);
        $this->assertEquals(MigrateAllCommandFactory::class, $factories[MigrateAllCommand::class]);
        $this->assertEquals(CommandFactory::class, $factories[StatusCommand::class]);

        $routes = $config['console_routes'];
        $this->assertEquals(ExecuteCommand::class, $routes['mogrations:execute']['handler']);
        $this->assertEquals(GenerateCommand::class, $routes['mogrations:generate']['handler']);
        $this->assertEquals(LatestCommand::class, $routes['mogrations:latest']['handler']);
        $this->assertEquals(MigrateCommand::class, $routes['mogrations:migrate']['handler']);
        $this->assertEquals(MigrateAllCommand::class, $routes['mogrations:migrate-all']['handler']);
        $this->assertEquals(StatusCommand::class, $routes['mogrations:status']['handler']);
    }
}