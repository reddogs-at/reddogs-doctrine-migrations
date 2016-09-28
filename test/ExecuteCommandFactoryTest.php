<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\ExecuteCommandFactory;
use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand as MigrationsExecuteCommand;
use Reddogs\Doctrine\Migrations\ExecuteCommand;

class ExecuteCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new ExecuteCommandFactory();
    }

    public function testGetCommandClass()
    {
        $this->assertSame(ExecuteCommand::class, $this->factory->getCommandClass());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(MigrationsExecuteCommand::class, $this->factory->getMigrationsCommand());
    }
}