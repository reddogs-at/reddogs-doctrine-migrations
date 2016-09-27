<?php

namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommandFactory;
use Interop\Container\ContainerInterface;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;

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
        $generateCommand = new GenerateCommand();
        $factory->expects($this->once())
                ->method('getMigrationsCommand')
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





        $service = $factory->__invoke($container, 'testServiceName');
        $this->assertInstanceOf(TestCommandImplementation::class, $service);
    }

    public function testGetCommandClass()
    {
        $this->assertNull($this->factory->getCommandClass());
    }
}