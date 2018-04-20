<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Service;

/**
 * Provide basic functions to find, retrieve, transform and return data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @abstract
 */
abstract class AbstractService implements \Pimple\ServiceProviderInterface
{
    use \Tables4dms\Traits\ResourceNameTrait;

    /**
     * @var Silex\Application
     */
    protected $app;

    public function __construct()
    {
        $this->getResourceName(); 
    }

    /**
     * Register services with "t4dm." prefix and the lower case resource name.
     *
     * @param \Pimple\Container $container
     */
    public function register(\Pimple\Container $container)
    {
        $resourceName = strtolower($this->getResourceName());
        $container["t4dm.{$resourceName}"] = $this;
        $this->app = $container;
    }

    /**
     * Get a reference for the entity manager.
     *
     * @param string $name Entity manager name.
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager($name = 'default')
    {
        return $this->app['orm.ems'][$name];
    }

    /**
     * Return a reference for a entity repository.
     *
     * @param string $resourceName Resource name.
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository($resourceName = null)
    {
        if (is_null($resourceName)) {
            $resourceName = $this->getResourceName();
        }

        $entityName = "{$this->app['config']['app.package']}\\Entity\\{$resourceName}";

        return $this->getEntityManager()
            ->getRepository($entityName);
    }

    /**
     * Return a list of resources considering a filter.
     *
     * @param mixed[] $filter Params to use in a where clausule.
     * @return array|\Tables4dms\Entity\User
     * @todo To implement pagination.
     */
    public function find($filter = [])
    {
        if (empty($filter)) {
            return $this->getRepository()
                ->findAll();
        }

        if (key_exists('id', $filter) && 1 == count($filter)) {
            return $this->getRepository()
                ->find($filter)??[];
        }

        return $this->getRepository()
            ->findBy($filter)??[];
    }

    public function __call($method, $params)
    {
        switch ($method) {
            case 'getReference':
            case 'persist':
            case 'flush':
                return call_user_func_array(
                    [$this->getEntityManager(), $method],
                    $params
                );
                break;
            default:
                throw new \Exception(
                    get_class($this) . "::{$method}() does not exists.."
                );
        }
    }

    /**
     * General validation method. Raises and ValidationException if needed.
     *
     * @return bool
     * @throw \Tables4dms\Exception\ValidationException
     */
    protected function validate($entity)
    {
        $errors = $this->app['validator']->validate($entity);
        if (!($errors->count())) {
            return true;
        }

        $vex = new \Tables4dms\Exception\ValidationException();
        foreach ($errors as $error) {
            $vex->add(
                $error->getPropertyPath(),
                $error->getMessage()
            );
        }

        throw $vex;
    }
}

