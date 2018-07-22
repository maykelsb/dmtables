<?php

namespace Tables4dms\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\OutputConsole;
use Symfony\Component\Console\Helper\Table;
use Silex\Application;

class UtilCommand extends Command
{

    protected function configure()
    {
        $this->setName('upzone:dump-routes')
            ->setDescription('Dump the route list.')
            ->setHelp('Use to see all routes available.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (null === $output) {
            $output = new ConsoleOutput();
        }

        $table = new Table($output);
        $table->setHeaders(['Path', 'Methods']);

        $app = $this->getApplication()->getContainer();
        $app->flush();

        $routes = [];
        foreach ($app['routes'] as $route) {
            $routePath = $route->getPath();


            if (!key_exists($routePath, $routes)) {
                $routes[$routePath] = [];
            }

            $routes[$routePath] = array_merge(
                $routes[$routePath],
                $route->getMethods()
            );
        }

        ksort($routes);
        foreach ($routes as $path => $methods) {
           // sort($methods);
            $table->addRow([
                $path,
                implode(', ', $methods)
            ]);
        }

        $table->render();
    }
}

