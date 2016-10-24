<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\OutputWriter;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class MigrateAllCommand
{

    /**
     * Configurations
     * 
     * @var array
     */
    private $configurations;

    /**
     * Migrations
     * 
     * @var array
     */
    private $migrations;

    /**
     * Constructor
     * 
     * @param array $configurations
     * @param array $migrations 
     */
     public function __construct(array $configurations, array $migrations)
     {
         $this->configurations = $configurations;
         $this->migrations = $migrations;
     }

     /**
      * Get configurations
      *
      * return array
      */
     public function getConfigurations()
     {
         return $this->configurations;
     }

     /**
      * Get migrations
      * 
      * @return array
      */
     public function getMigrations()
     {
         return $this->migrations;
     }

    /**
     * Invoke 
     *
     * @param Route $route
     * @param AdapterInterface $console
     */
    public function __invoke(Route $route, AdapterInterface $console)
    {
        $migrations = $this->getMigrations();
        foreach($this->getConfigurations() as $key => $configuration) {
            $configuration->createMigrationTable();
            $outputWriter = new OutputWriter(function($message) use ($console) {
                return $console->writeLine($message);
            });
            $configuration->setOutputWriter($outputWriter);
            $result = $migrations[$key]->migrate();
            if (empty($result)) {
                $console->writeLine(sprintf('module \'%1$s\': no migrations to execute', $key));
            }
        }
    }
}