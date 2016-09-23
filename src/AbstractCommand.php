<?php
namespace Reddogs\Doctrine\Migrations;

use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use ZF\Console\Route;

abstract class AbstractCommand
{

    /**
     * Application
     *
     * @var Application
     */
    private $application;

    /**
     * Migrations command
     *
     * @var MigrationsCommand
     */
    private $migrationsCommand;

    /**
     * Configuration
     *
     * @var Configuration
     */
    private $configuration;

    /**
     * Migrations config
     *
     * @var array
     */
    private $migrationsConfig;

    /**
     *
     * @param Application $application
     * @param MigrationsCommand $migrationsCommand
     */
    public function __construct(
        Application $application, MigrationsCommand $migrationsCommand,
        Configuration $configuration, array $migrationsConfig
    ) {
        $this->application = $application;
        $this->migrationsCommand = $migrationsCommand;
        $this->configuration = $configuration;
        $this->migrationsConfig = $migrationsConfig;
    }


    public function __invoke(Route $route)
    {
        $migrationsConfig = $this->getMigrationsConfig();
        $moduleName = $route->getMatchedParam('moduleName');

        $params = $migrationsConfig[$moduleName];

        $configuration = $this->getConfiguration();
        $configuration->setMigrationsNamespace($params['namespace']);
        $configuration->setMigrationsDirectory($params['directory']);
        $configuration->setMigrationsTableName($params['table_name']);
        $configuration->registerMigrationsFromDirectory($params['directory']);
    }

    /**
     * Get application
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Get migrations command
     *
     * @return MigrationsCommand
     */
    public function getMigrationsCommand()
    {
        return $this->migrationsCommand;
    }

    /**
     * Get configuration
     *
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Get migrations config
     *
     * @return the array
     */
    public function getMigrationsConfig()
    {
        return $this->migrationsConfig;
    }
}