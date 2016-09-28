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
    private $booleanParams = [
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
            foreach ($this->booleanParams as $booleanParam) {
                if (true === $matches[ltrim($booleanParam, '-')]) {
                    $params[] = $booleanParam;
                }
            }
            if (! empty($params)) {
                $inputCommand .= ' ' . implode(' ', $params);
            }
        }
        return $inputCommand;
    }
}