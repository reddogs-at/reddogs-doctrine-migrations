<?php
namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommand;
use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use ZF\Console\Route;

class AbstractCommandTest extends \PHPUnit_Framework_TestCase
{

    private $command, $application, $migrationsCommand, $configuration, $migrationsConfig;

    protected function setUp()
    {
        $this->application = $this->getMockBuilder(Application::class)->getMock();
        $this->migrationsCommand = $this->getMockBuilder(MigrationsCommand::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $this->configuration = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'setMigrationsNamespace', 'setMigrationsDirectory', 'setMigrationsTableName',
                'registerMigrationsFromDirectory'
            ])
            ->getMock();
        $this->migrationsConfig = [
            'testKey' => [
                'namespace' => 'TestNamespace',
                'directory' => 'path/to/migrations',
                'table_name' => 'test_tablename'
            ]
        ];

        $this->command = $this->getMockForAbstractClass(AbstractCommand::class, [
            $this->application,
            $this->migrationsCommand,
            $this->configuration,
            $this->migrationsConfig,
        ]);
    }

    public function testGetApplication()
    {
        $this->assertSame($this->application, $this->command->getApplication());
    }

    public function testGetMigrationsCommand()
    {
        $this->assertSame($this->migrationsCommand, $this->command->getMigrationsCommand());
    }

    public function testGetConfiguration()
    {
        $this->assertSame($this->configuration, $this->command->getConfiguration());
    }

    public function testGetMigrationsConfig()
    {
        $this->assertSame($this->migrationsConfig, $this->command->getMigrationsConfig());
    }

    public function testInvoke()
    {
        $this->configuration->expects($this->once())
                            ->method('setMigrationsNamespace')
                            ->with($this->equalTo('TestNamespace'));
        $this->configuration->expects($this->once())
                            ->method('setMigrationsDirectory')
                            ->with($this->equalTo('path/to/migrations'));
        $this->configuration->expects($this->once())
                            ->method('setMigrationsTableName')
                            ->with($this->equalTo('test_tablename'));
        $this->configuration->expects($this->once())
                            ->method('registerMigrationsFromDirectory')
                            ->with($this->equalTo('path/to/migrations'));

        $route = new Route('mogrations:test', 'mogrations:testroute <moduleName>');
        $route->match(['mogrations:testroute', 'testKey']);
        $this->command->__invoke($route);
    }
}