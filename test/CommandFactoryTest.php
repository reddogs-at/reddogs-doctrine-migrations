<?php

namespace ReddogsTest\Doctrine\Migrations;

use Interop\Container\ContainerInterface;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand as MigrateMigrationsCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand as StatusMigrationsCommand;
use Reddogs\Doctrine\Migrations\StatusCommand;
use Reddogs\Doctrine\Migrations\MigrateCommand;
use Reddogs\Doctrine\Migrations\CommandFactory;

require_once __DIR__ . '/_files/TestCommandImplementation.php';

class CommandFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new CommandFactory();
    }

    public function testCreateService()
    {
        $factory = $this->getMockBuilder(CommandFactory::class)
                        ->setMethods(['getMigrationsCommand'])
                        ->getMock();
        $generateCommand = new GenerateCommand();
        $factory->expects($this->once())
                ->method('getMigrationsCommand')
                ->with($this->equalTo(TestCommandImplementation::class))
                ->will($this->returnValue($generateCommand));

        $container = $this->getMockBuilder(ContainerInterface::class)
                          ->setMethods(['get', 'has'])
                          ->getMock();
        $entityManager = $this->createMock(EntityManager::class);
        $connection = $this->createMock(Connection::class);
        $entityManager->expects($this->once())
                      ->method('getConnection')
                      ->will($this->returnValue($connection));
        $config = [
            'doctrine' => [
                'reddogs_doctrine_migrations' => [
                    'testmodule' => ['test']
                ]
            ]
        ];
        $container->expects($this->at(0))
                  ->method('get')
                  ->with($this->equalTo('config'))
                  ->will($this->returnValue($config));
        $container->expects($this->at(1))
                  ->method('get')
                  ->with($this->equalTo(EntityManager::class))
                  ->will($this->returnValue($entityManager));

        $service = $factory->__invoke($container, TestCommandImplementation::class);
        $this->assertInstanceOf(TestCommandImplementation::class, $service);
    }

    public function testGetMigrationsCommand()
    {
        $this->assertInstanceOf(StatusMigrationsCommand::class,
                                $this->factory->getMigrationsCommand(StatusCommand::class));
    }
}