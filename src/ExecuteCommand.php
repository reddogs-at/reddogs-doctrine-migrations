<?php
namespace Reddogs\Doctrine\Migrations;

/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
use Reddogs\Doctrine\Migrations\AbstractCommand;
use ZF\Console\Route;

/**
 * Execute Command
 */
class ExecuteCommand extends AbstractCommand
{

    /**
     * Boolean rout params
     *
     * @var array
     */
    protected $booleanParams = [
        '--dry-run',
        '--write-sql',
        '--up',
        '--down',
        '--query-time',
        '--no-interaction',
        '-n',
        '--quiet',
        '-q',
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
        $inputCommand = 'migrations:execute';

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