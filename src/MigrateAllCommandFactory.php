<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Migration;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        $connection = $container->get(EntityManager::class)->getConnection();
        $configurations = [];
        $migrations = [];
        foreach ($config['doctrine']['reddogs_doctrine_migrations'] as $key => $moduleConfig) {
            $configurations[$key] = new Configuration($connection);
            $configurations[$key]->setMigrationsTableName($moduleConfig['table_name']);
            $configurations[$key]->setMigrationsDirectory($moduleConfig['directory']);
            $configurations[$key]->setMigrationsNamespace($moduleConfig['namespace']);
            $migrations[$key] = new Migration($configurations[$key]);
        }
        return new MigrateAllCommand($configurations, $migrations);
    }
}