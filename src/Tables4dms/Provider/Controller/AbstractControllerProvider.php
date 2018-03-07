<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;

/**
 * Base controller provider to manage requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @abstract
 */
abstract class AbstractControllerProvider implements ControllerProviderInterface
{
    /**
     * @var Silex\Application
     */
    protected $app;

    /**
     * @var Silex\ControllerCollection
     */
    protected $cc;

//    /**
//     * @var string
//     */
//    protected $controllerName;

    public function __construct()
    {
//        $this->controllerName = $this->getControllerName();
    }

    /**
     * Publish this controller routes.
     *
     * @param Silex\Application $app
     * @return Silex\ControllerCollection
     */
    public function connect(Application $app)
    {
        $this->app = $app;
        $this->cc = $this->app['controllers_factory'];

        return $this->enableRoutes()->cc;
    }

//    final protected function getControllerName()
//    {
//        return str_replace(
//          'ControllerProvider',
//          '',
//          end(explode('\\', get_class($this)))
//        );
//    }

    /**
     * Find 'Action' methods and bind them to routes.
     */
    final protected function enableRoutes()
    {
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if ('Action' === substr($method->getName(), -6)) {
                $this->{$method->getName()}();
            }
        }

        return $this;
    }
}

