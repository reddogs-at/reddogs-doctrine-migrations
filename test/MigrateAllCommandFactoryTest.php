<?php

namespace ReddogsTest\Doctrine\Migrations;

use Interop\Container\ContainerInterface;
use Reddogs\Doctrine\Migrations\MigrateAllCommand;
use Reddogs\Doctrine\Migrations\MigrateAllCommandFactory;
use Reddogs\Doctrine\Migrations\MigrateCommand;

class MigrateAllCommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new MigrateAllCommandFactory; 
    }

    public function testInvoke()
    {
        $container = $this->getMockBuilder(ContainerInterface::class)
                          ->setMethods(['get', 'has'])
                          ->getMock();

        $migrateCommand = $this->getMockBuilder(MigrateCommand::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $config = [
            'doctrine' => [
                'reddogs_doctrine_migrations' => ['testkey' => 'testConfig']
            ]
        ];

        $container->expects($this->at(0))
            ->method('get')
            ->with($this->equalTo('config'))
            ->will($this->returnValue($config));

        $container->expects($this->at(1))
            ->method('get')
            ->with($this->equalTo(MigrateCommand::class))
            ->will($this->returnValue($migrateCommand));

        $service = $this->factory->__invoke($container, MigrateAllCommand::class);
        $this->assertInstanceOf(MigrateAllCommand::class, $service);
        $this->assertSame($migrateCommand, $service->getMigrateCommand());
        $this->assertSame(['testkey' => 'testConfig'], $service->getMigrationsConfig());
    }
}