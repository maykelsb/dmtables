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

use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\ResourceInterface;

/**
 * Base controller provider to manage requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @abstract
 */
abstract class AbstractControllerProvider implements ControllerProviderInterface
{
    use \Tables4dms\Traits\ResourceNameTrait;

    /**
     * @var Silex\Application
     */
    protected $app;

    /**
     * @var Silex\ControllerCollection
     */
    protected $cc;

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
     * Receives data, create a response and return it as JSON.
     *
     * This method tries to discover the transformer to be used.
     *
     * @param mixed|object|array Data to be transformed.
     * @param string|null Name of the transformer.
     * @return Response
     */
    protected function response(
        $data,
        $transformerClassName = null,
        $statusCode = Response::HTTP_OK,
        array $headers = []
    ){
        if (is_null($transformerClassName)) {
            $transformerClassName = $this->getDefaultTransformer();
        }

        if (!$this->isTransformerClass($transformerClassName)) {
            throw new Exception("{$transformerClassName} is not a valid transformer class.");
        }

        switch (gettype($data)) {
            case 'object':
                $data = new Item($data, new $transformerClassName());
                break;
            default:
                $data = new Collection($data, new $transformerClassName());
        }

        return new Response(
            $this->app['fractal.manager']
                ->createData($data)
                ->toJson(),
            $statusCode,
            $headers
        );
    }

    /**
     * Verify if a class is a transformer.
     *
     * @param string $transformerClassName Transformer class name with namespace.
     * @return bool
     */
    protected function isTransformerClass($transformerClassName)
    {
        $rfClass = new \ReflectionClass($transformerClassName);
        return $rfClass->isSubclassOf('League\\Fractal\\TransformerAbstract');
    }

    /**
     * Retrieves the transformer class name with namespace associated to the controller.
     *
     * @return string
     */
    protected function getDefaultTransformer()
    {
        return "{$this->app['config']['app.package']}\\Transformer\\"
            . $this->getResourceName()
            . "Transformer";
    }

    public function __call($method, $params)
    {
        switch ($method) {
            case 'get':
            case 'post':
                return call_user_func_array(
                    [$this->getCc(), $method],
                    $params
                );
            default:
                throw new \Exception(
                    get_class($this) . "::{$method}() does not exists."
                );
        }
    }

    public function getService($resourceName = null)
    {
        if (empty($resourceName)) {
            $resourceName = strtolower($this->getResourceName());
        }

        return $this->app["t4dm.{$resourceName}"];
    }
}

