<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use ZF\Console\Route;
use Zend\Console\Adapter\AdapterInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;

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
     * Output
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * Migrations config
     *
     * @var array
     */
    private $migrationsConfig;

    /**
     * Constructor
     *
     * @param Application $application
     * @param MigrationsCommand $migrationsCommand
     * @param Configuration $configuration
     * @param OutputInterface $output
     * @param array $migrationsConfig
     */
    public function __construct(
        Application $application, MigrationsCommand $migrationsCommand, Configuration $configuration,
        OutputInterface $output, array $migrationsConfig)
    {
        $this->application = $application;
        $this->migrationsCommand = $migrationsCommand;
        $this->configuration = $configuration;
        $this->output = $output;
        $this->migrationsConfig = $migrationsConfig;
    }

    public function __invoke(Route $route, AdapterInterface $console)
    {
        $migrationsConfig = $this->getMigrationsConfig();
        $moduleName = $route->getMatchedParam('moduleName');

        $params = $migrationsConfig[$moduleName];

        $configuration = $this->getConfiguration();
        $configuration->setMigrationsNamespace($params['namespace']);
        $configuration->setMigrationsDirectory($params['directory']);
        $configuration->setMigrationsTableName($params['table_name']);
        $configuration->registerMigrationsFromDirectory($params['directory']);

        $migrationsCommand = $this->getMigrationsCommand();
        $migrationsCommand->setMigrationConfiguration($configuration);

        $application = $this->getApplication();
        $application->add($migrationsCommand);

        $input = new ArrayInput(['command' => $this->getInputCommand($route)]);

        $application->run($input, $this->getOutput());
    }

    /**
     * Get input command
     *
     * @param Route $route
     * @return string
     */
    abstract public function getInputCommand(Route $route);

    /**
     * Apply boolean params
     *
     * @param array $params
     * @param array $matches
     * @return array
     */
    protected function applyBooleanParams(array $params, array $matches)
    {
        foreach ($this->booleanParams as $booleanParam) {
            if (true === $matches[ltrim($booleanParam, '-')]) {
                $params[] = $booleanParam;
            }
        }
        return $params;
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

    /**
     * Get output
     *
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }
}