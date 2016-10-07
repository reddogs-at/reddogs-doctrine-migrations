<?php
namespace Reddogs\Doctrine\Migrations;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as AbstractMigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class AbstractCommandFactory implements FactoryInterface
{

    /**
     * Command class
     *
     * @var string
     */
    protected $commandClass;

    /**
     * Get command
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     * @return AbstractCommand
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $commandClass = $this->getCommandClass();
        $config = $container->get('config');
        return new $commandClass(
            new Application(),
            $this->getMigrationsCommand(),
            new Configuration($container->get(EntityManager::class)->getConnection()),
            new ConsoleOutput(),
            $config['doctrine']['reddogs_doctrine_migrations']
        );
    }

    /**
     * Get command class
     *
     * @return string
     */
    public function getCommandClass()
    {
        return $this->commandClass;
    }

    /**
     * Get migrations command
     * @return AbstractMigrationsCommand
     */
    abstract public function getMigrationsCommand();

}