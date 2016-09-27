<?php

namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

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
        $route = new Route('testName', 'testRoute');
        $this->assertSame('migrations:generate', $this->command->getInputCommand($route));
    }
}