<?php
namespace Reddogs\Doctrine\Migrations;

use ZF\Console\Route;

class MigrateCommand extends AbstractCommand
{

    /**
     * Boolean rout params
     *
     * @var array
     */
    protected $booleanParams = [
        '--dry-run',
        '--write-sql',
        '--query-time',
        '--no-interaction',
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
     *
     * {@inheritdoc}
     *
     * @see \Reddogs\Doctrine\Migrations\AbstractCommand::getInputCommand()
     */
    public function getInputCommand(Route $route)
    {
        $matches = $route->getMatches();
        $inputCommand = 'migrations:migrate';

        if (is_array($matches)) {
            $params = [];
            $params = $this->applyBooleanParams($params, $matches);
            if (isset($matches['version'])) {
                $params[] = $matches['version'];
            }
            if (! empty($params)) {
                $inputCommand .= ' ' . implode(' ', $params);
            }
        }
        return $inputCommand;
    }
}