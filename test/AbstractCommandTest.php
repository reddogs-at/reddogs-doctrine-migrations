<?php
namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommand;
use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use ZF\Console\Route;
use Zend\Console\Adapter\AdapterInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;

class AbstractCommandTest extends \PHPUnit_Framework_TestCase
{

    private $command, $application, $migrationsCommand, $configuration, $migrationsConfig, $output;

    protected function setUp()
    {
        $this->application = $this->getMockBuilder(Application::class)
            ->setMethods(['add', 'run'])
            ->getMock();
        $this->migrationsCommand = $this->getMockBuilder(MigrationsCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['setMigrationConfiguration'])
            ->getMockForAbstractClass();
        $this->configuration = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'setMigrationsNamespace', 'setMigrationsDirectory', 'setMigrationsTableName',
                'registerMigrationsFromDirectory'
            ])
            ->getMock();

        $this->output = $this->createMock(OutputInterface::class);

        $this->migrationsConfig = [
            'testKey' => [
                'namespace' => 'TestNamespace',
                'directory' => 'path/to/migrations',
                'table_name' => 'test_tablename'
            ]
        ];

        $this->command = $this->getMockBuilder(AbstractCommand::class)
                              ->setMethods(['getInputCommand'])
                              ->setConstructorArgs([
                                    $this->application,
                                    $this->migrationsCommand,
                                    $this->configuration,
                                    $this->output,
                                    $this->migrationsConfig,
                              ])->getMockForAbstractClass();

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

    public function testGetOutput()
    {
        $this->assertSame($this->output, $this->command->getOutput());
    }

    public function testGetMigrationsConfig()
    {
        $this->assertSame($this->migrationsConfig, $this->command->getMigrationsConfig());
    }

    public function testInvoke()
    {
        $route = new Route('mogrations:test', 'mogrations:testroute <moduleName>');
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

        $this->migrationsCommand->expects($this->once())
                                ->method('setMigrationConfiguration')
                                ->with($this->equalTo($this->configuration));

        $this->application->expects($this->once())
                          ->method('add')
                          ->with($this->identicalTo($this->migrationsCommand));
        $this->application->expects($this->once())
                          ->method('run')
                          ->with($this->isInstanceOf(StringInput::class),
                                 $this->identicalTo($this->output));

        $this->command->expects($this->once())
                      ->method('getInputCommand')
                      ->with($this->equalTo($route))
                      ->will($this->returnValue('testInputCommand'));

        $route->match(['mogrations:testroute', 'testKey']);

        $console = $this->createMock(AdapterInterface::class);
        $this->command->__invoke($route, $console);
    }
}