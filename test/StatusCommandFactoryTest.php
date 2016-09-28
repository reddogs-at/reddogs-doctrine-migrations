<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\StatusCommandFactory;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand as MigrationsStatusCommand;
use Reddogs\Doctrine\Migrations\StatusCommand;

class StatusCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new StatusCommandFactory();
    }

    public function testGetCommandClass()
    {
        $this->assertSame(StatusCommand::class, $this->factory->getCommandClass());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(MigrationsStatusCommand::class, $this->factory->getMigrationsCommand());
    }
}