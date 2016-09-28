<?php

namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

class GenerateCommand extends AbstractCommand
{
    /**
     * Boolean rout params
     *
     * @var array
     */
    protected $booleanParams = [
        '--quiet',
        '-q',
        '-n',
        '--verbose',
        '-v',
        '-vv',
        '-vvv'
    ];

    /**
     * Get input command
     * {@inheritDoc}
     * @see \Reddogs\Doctrine\Migrations\AbstractCommand::getInputCommand()
     */
    public function getInputCommand(Route $route)
    {
        $matches = $route->getMatches();
        $inputCommand =  'migrations:generate';

        if (is_array($matches)) {
            $params = [];
            $params = $this->applyBooleanParams($params, $matches);
            if (! empty($params)) {
                $inputCommand .= ' ' . implode(' ', $params);
            }
        }
        return $inputCommand;
    }
}