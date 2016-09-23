<?php

namespace Reddogs\Doctrine\Migrations;

use Symfony\Component\Console\Application;

class GenerateCommandTest extends \PHPUnit_Framework_TestCase
{
    private $command;

    protected function setUp()
    {
        $this->command = $this->getMockBuilder(GenerateCommand::class)
                              ->disableOriginalConstructor()
                              ->setMethods(['null'])
                              ->getMock();
    }

    public function testGetInputCommand()
    {
        $this->assertSame('migrations:generate', $this->command->getInputCommand());
    }
}