<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\LatestCommandFactory;
use Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand as MigrationsLatestCommand;
use Reddogs\Doctrine\Migrations\LatestCommand;

class LatestCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new LatestCommandFactory();
    }

    public function testGetCommandClass()
    {
        $this->assertSame(LatestCommand::class, $this->factory->getCommandClass());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(MigrationsLatestCommand::class, $this->factory->getMigrationsCommand());
    }
}