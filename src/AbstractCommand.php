<?php
namespace Reddogs\Doctrine\Migrations;

use Symfony\Component\Console\Application;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationsCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use ZF\Console\Route;
use Zend\Console\Adapter\AdapterInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

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
     * Input
     *
     * @var InputInterface
     */
    private $input;

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
     *
     * @param Application $application
     * @param MigrationsCommand $migrationsCommand
     */
    public function __construct(
        Application $application, MigrationsCommand $migrationsCommand, Configuration $configuration,
                    InputInterface $input, OutputInterface $output, array $migrationsConfig
    ) {
        $this->application = $application;
        $this->migrationsCommand = $migrationsCommand;
        $this->configuration = $configuration;
        $this->input = $input;
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

        $input = $this->getInput();
        $input->setOption('command', $this->getInputCommand($route));

        $application->run($input, $this->getOutput());

    }

    /**
     * Get input command
     * @param Route $route
     * @return string
     */
    abstract public function getInputCommand(Route $route);

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
     * Get input
     *
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
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