<?php

namespace ReddogsTest\Doctrine\Migrations;

use Interop\Container\ContainerInterface;
use Reddogs\Doctrine\Migrations\MigrateAllCommand;
use Reddogs\Doctrine\Migrations\MigrateAllCommandFactory;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;

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

        $config = [
            'doctrine' => [
                'reddogs_doctrine_migrations' => [
                    'testkey' => [
                        'table_name' => 'testTableName',
                        'directory' => 'testDirectory',
                        'namespace' => 'TestNameSpace'
                    ]
                ]
            ]
        ];

        $container->expects($this->at(0))
            ->method('get')
            ->with($this->equalTo('config'))
            ->will($this->returnValue($config));

        $entityManager = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getConnection'])
            ->getMock();
        $connection = $this->createMock(Connection::class);
        $entityManager->expects($this->once())
            ->method('getConnection')
            ->will($this->returnValue($connection));
        

        $container->expects($this->at(1))
            ->method('get')
            ->with($this->equalTo(EntityManager::class))
            ->will($this->returnValue($entityManager));
        
        $service = $this->factory->__invoke($container, MigrateAllCommand::class);
        
        $this->assertInstanceOf(MigrateAllCommand::class, $service);
        $configurations = $service->getConfigurations();
        $this->assertCount(1, $configurations);
        $this->assertArrayHasKey('testkey', $configurations);

        $this->assertSame('testTableName', $configurations['testkey']->getMigrationsTableName());
        $this->assertSame('testDirectory', $configurations['testkey']->getMigrationsDirectory());
        $this->assertSame('TestNameSpace', $configurations['testkey']->getMigrationsNamespace());

        $migrations = $service->getMigrations();
    }
}