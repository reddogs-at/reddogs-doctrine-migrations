<?php
namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

class StatusCommand extends AbstractCommand
{
    /**
     * Get input command
     * {@inheritDoc}
     * @see \Reddogs\Doctrine\Migrations\AbstractCommand::getInputCommand()
     */
    public function getInputCommand(Route $route)
    {
        return 'migrations:status';
    }
}