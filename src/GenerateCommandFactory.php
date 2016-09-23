<?php

namespace Reddogs\Doctrine\Migrations;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;

class GenerateCommandFactory implements FactoryInterface
{
    protected $commandClass = GenerateCommand::class;

    /**
     * Create generate command
     * {@inheritDoc}
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     * @return GenerateCommand
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new GenerateCommand($container->get(
            EntityManager::class),
            $config['doctrine']['reddogs_doctrine_migrations']
        );
    }

    public function getCommandClass()
    {
        return $this->commandClass;
    }
}