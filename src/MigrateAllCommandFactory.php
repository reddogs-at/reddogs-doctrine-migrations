<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Reddogs\Doctrine\Migrations\MigrateCommand;

class MigrateAllCommandFactory implements FactoryInterface
{
    /**
     * Get command
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     * @return MigrateAllCommand
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new MigrateAllCommand(
            $container->get(MigrateCommand::class),
            $config['doctrine']['reddogs_doctrine_migrations']
        );
    }
}