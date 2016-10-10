<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as AbstractMigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Output\ConsoleOutput;

class CommandFactory implements FactoryInterface
{

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
        $config = $container->get('config');
        return new $requestedName(
            new Application(),
            $this->getMigrationsCommand($requestedName),
            new Configuration($container->get(EntityManager::class)->getConnection()),
            new ConsoleOutput(),
            $config['doctrine']['reddogs_doctrine_migrations']
        );
    }

    /**
     * Get migrations command
     *
     * @param string $requestedName
     * @return AbstractMigrationsCommand
     */
    public function getMigrationsCommand($requestedName)
    {
        $parts = explode('\\', $requestedName);
        $class = 'Doctrine\\DBAL\\Migrations\\Tools\\Console\\Command\\' . array_pop($parts);
        return new $class();
    }

}