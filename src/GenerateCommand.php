<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\ORM\EntityManager;
use Reddogs\Doctrine\ORM\EntityManagerAwareTrait;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand as DoctrineGenerateCommand;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Application;
use ZF\Console\Route;
use Zend\Console\Adapter\AdapterInterface;

class GenerateCommand extends AbstractCommand
{
    public function getInputCommand()
    {
        return 'migrations:generate';
    }
}