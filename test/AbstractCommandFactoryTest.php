<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommandFactory;
use Interop\Container\ContainerInterface;

require_once __DIR__ . '/_files/TestCommandImplementation.php';

class AbstractCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = $this->getMockForAbstractClass(AbstractCommandFactory::class);
    }

    public function testCreateService()
    {
        $factory = $this->getMockBuilder(AbstractCommandFactory::class)
                        ->setMethods(['getCommandClass'])
                        ->getMockForAbstractClass();
        $factory->expects($this->once())
                ->method('getCommandClass')
                ->will($this->returnValue(TestCommandImplementation::class));

        $container = $this->getMockBuilder(ContainerInterface::class)
                          ->setMethods(['get', 'has'])
                          ->getMock();



        $service = $factory->__invoke($container, 'testServiceName');
    }

    public function testGetCommandClass()
    {
        $this->assertNull($this->factory->getCommandClass());
    }
}