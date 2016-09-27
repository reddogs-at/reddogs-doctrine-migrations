<?php

namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

class GenerateCommand extends AbstractCommand
{
    public function getInputCommand(Route $route)
    {
        return 'migrations:generate';
    }
}