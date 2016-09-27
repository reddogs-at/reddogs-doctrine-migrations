<?php

namespace Reddogs\Doctrine\Migrations;


class MigrateCommand extends AbstractCommand
{
    public function getInputCommand()
    {
        return 'migrations:migrate';
    }
}