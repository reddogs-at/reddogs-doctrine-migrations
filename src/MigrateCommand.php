<?php

namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

class MigrateCommand extends AbstractCommand
{
    public function getInputCommand(Route $route)
    {
        return 'migrations:migrate';
    }
}