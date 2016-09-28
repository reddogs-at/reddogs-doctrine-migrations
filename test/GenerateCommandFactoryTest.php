<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\GenerateCommandFactory;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand as MigrationsGenerateCommand;
use Reddogs\Doctrine\Migrations\GenerateCommand;

class GenerateCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new GenerateCommandFactory();
    }

    public function testGetCommandClass()
    {
        $this->assertSame(GenerateCommand::class, $this->factory->getCommandClass());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(MigrationsGenerateCommand::class, $this->factory->getMigrationsCommand());
    }
}