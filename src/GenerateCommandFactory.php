<?php

namespace Reddogs\Doctrine\Migrations;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;

class GenerateCommandFactory implements FactoryInterface
{

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
}