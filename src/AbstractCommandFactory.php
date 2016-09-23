<?php
namespace Reddogs\Doctrine\Migrations;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class AbstractCommandFactory implements FactoryInterface
{

    /**
     * Command class
     *
     * @var string
     */
    private $commandClass;

    /**
     * Get command
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     * @return AbstractCommand
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $commandClasss = $this->getCommandClass();
    }

    /**
     * Get command class
     *
     * @return string
     */
    public function getCommandClass()
    {
        return $this->commandClass;
    }
}