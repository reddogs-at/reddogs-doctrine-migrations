<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

/**
 * Outputs the latest module migrations version number
 */
class LatestCommand extends AbstractCommand
{
    /**
     * Get input command
     * {@inheritDoc}
     * @see \Reddogs\Doctrine\Migrations\AbstractCommand::getInputCommand()
     */
    public function getInputCommand(Route $route)
    {
        return 'migrations:latest';
    }
}