<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ModuleConfig;
use Reddogs\Doctrine\Migrations\GenerateCommand;
use Reddogs\Doctrine\Migrations\GenerateCommandFactory;
use Reddogs\Doctrine\Migrations\ExecuteCommandFactory;
use Reddogs\Doctrine\Migrations\LatestCommandFactory;
use Reddogs\Doctrine\Migrations\LatestCommand;
use Reddogs\Doctrine\Migrations\MigrateCommandFactory;
use Reddogs\Doctrine\Migrations\MigrateCommand;
use Reddogs\Doctrine\Migrations\StatusCommandFactory;
use Reddogs\Doctrine\Migrations\ExecuteCommand;
use Reddogs\Doctrine\Migrations\StatusCommand;

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

        $this->assertEquals(ExecuteCommandFactory::class, $factories[ExecuteCommand::class]);
        $this->assertEquals(GenerateCommandFactory::class, $factories[GenerateCommand::class]);
        $this->assertEquals(LatestCommandFactory::class, $factories[LatestCommand::class]);
        $this->assertEquals(MigrateCommandFactory::class, $factories[MigrateCommand::class]);
        $this->assertEquals(StatusCommandFactory::class, $factories[StatusCommand::class]);

        $routes = $config['console_routes'];
        $this->assertEquals(ExecuteCommand::class, $routes['mogrations:execute']['handler']);
        $this->assertEquals(GenerateCommand::class, $routes['mogrations:generate']['handler']);
        $this->assertEquals(LatestCommand::class, $routes['mogrations:latest']['handler']);
        $this->assertEquals(MigrateCommand::class, $routes['mogrations:migrate']['handler']);
        $this->assertEquals(StatusCommand::class, $routes['mogrations:status']['handler']);
    }
}