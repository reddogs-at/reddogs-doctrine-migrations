<?php
namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommand;

class TestCommandImplementation extends AbstractCommand
{
    public function getInputCommand()
    {
        return 'testInputCommand';
    }
}