<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class MigrateAllCommand
{
    /**
     * Migrate command
     *
     * @var MigrateCommand
     */
    private $migrateCommand;

    /**
     * Migrations config 
     * 
     * @var array
     */
    private $migrationsConfig;

    public function __construct(MigrateCommand $migrateCommand, array $migrationsConfig)
    {
        $this->migrateCommand = $migrateCommand;
        $this->migrationsConfig = $migrationsConfig;
    }

    /**
     * Get migrate command
     *
     * @return MigrateCommand
     */
    public function getMigrateCommand()
    {
        return $this->migrateCommand;
    }

    /**
     * Get migrations config 
     *
     * @return array
     */
    public function getMigrationsConfig()
    {
        return $this->migrationsConfig;
    }

    public function __invoke(Route $route, AdapterInterface $console)
    {
        foreach ($this->getMigrationsConfig() as $key => $params)
        {
            $migrateCommand = $this->getMigrateCommand();
            $migrateRoute = new Route('migrations:migrate', 'migrations:migrate ' . $key);
            $migrateCommand($migrateRoute, $console);
        }
    }
}