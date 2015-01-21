<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Nice;

use Nice\Application;
use Symfony\Component\Console\Application as BaseConsole;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class Console extends BaseConsole
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * Constructor
     *
     * @param Application $app
     * @param string      $name
     * @param string      $version
     */
    public function __construct(Application $app, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->app = $app;

        parent::__construct($name, $version);
    }

    /**
     * Adds a command object.
     *
     * If a command with the same name already exists, it will be overridden.
     *
     * @param Command $command A Command object
     *
     * @return Command The registered command
     */
    public function add(Command $command)
    {
        if ($command instanceof ContainerAwareInterface) {
            $command->setContainer($this->app->getContainer());
        }

        return parent::add($command);
    }
}
