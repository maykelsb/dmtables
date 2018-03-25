<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use League\Fractal\Resource\ResourceInterface;

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

    public function __construct()
    {
    }

    /**
     * Return reference for cc
     *
     * @return Silex\ControllerCollection
     */
    public function getCc()
    {
        return $this->cc;
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

        return $this->enableRoutes()->getCc();
    }

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

    /**
     * Get a reference for the entity manager.
     *
     * @param string $name Entity manager name.
     */
    protected function getEntityManager($name = 'default')
    {
        return $this->app['orm.ems'][$name];
    }

    /**
     * Convert a fractal resource to json and return as Response.
     *
     * @param ResourceInterface $resource
     */
    protected function response(ResourceInterface $resource)
    {
        return new Response(
            $this->app['fractal.manager']
                ->createData($resource)
                ->toJson()
        );
    }
}

