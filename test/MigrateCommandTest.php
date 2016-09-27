<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\MigrateCommand;

class MigrateCommandTest extends \PHPUnit_Framework_TestCase
{
    private $command;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(MigrateCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['null'])
            ->getMock();
    }

    public function testGetInputCommand()
    {
        $this->assertSame('migrations:migrate', $this->command->getInputCommand());
    }
}