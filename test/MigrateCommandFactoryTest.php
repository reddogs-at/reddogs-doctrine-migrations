<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\MigrateCommandFactory;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand as MigrationsMigrateCommand;
use Reddogs\Doctrine\Migrations\MigrateCommand;

class MigrateCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new MigrateCommandFactory();
    }

    public function testGetCommandClass()
    {
        $this->assertSame(MigrateCommand::class, $this->factory->getCommandClass());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(MigrationsMigrateCommand::class, $this->factory->getMigrationsCommand());
    }
}