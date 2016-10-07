<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand as MigrationsGenerateCommand;
use Reddogs\Doctrine\Migrations\GenerateCommand;

class GenerateCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = GenerateCommand::class;

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand
     */
    public function getMigrationsCommand()
    {
        return new MigrationsGenerateCommand();
    }
}