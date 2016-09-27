<?php
namespace ReddogsTest\Doctrine\Migrations;

use Reddogs\Doctrine\Migrations\AbstractCommand;
use ZF\Console\Route;

class TestCommandImplementation extends AbstractCommand
{
    public function getInputCommand(Route $route)
    {
        return 'testInputCommand';
    }
}